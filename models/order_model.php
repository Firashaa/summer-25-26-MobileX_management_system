<?php
// MODEL: orders + order_items.

function order_admin_summary($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS order_count, COALESCE(SUM(total_amount), 0) AS revenue FROM orders");
    if (!$stmt) return ['order_count' => 0, 'revenue' => 0.0];
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return ['order_count' => (int)($row['order_count'] ?? 0), 'revenue' => (float)($row['revenue'] ?? 0)];
}

function order_recent($conn, $limit = 5) {
    $limit = max(1, min(50, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT o.id, o.total_amount, o.delivery_status, o.created_at, u.name AS customer_name FROM orders o JOIN users u ON o.customer_id = u.id ORDER BY o.id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_pending_count_all($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM orders WHERE delivery_status = 'pending'");
    if (!$stmt) return 0;
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function order_assigned_count_vendor($conn, $vendorId) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM orders WHERE assigned_vendor_id = ?");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'i', $vendorId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function order_pending_count_seller($conn, $sellerId) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(DISTINCT o.id) AS c FROM orders o JOIN order_items oi ON oi.order_id = o.id WHERE oi.seller_id = ? AND o.delivery_status = 'pending'");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function order_pending_items_seller($conn, $sellerId, $limit = 20) {
    $limit = max(1, min(100, (int)$limit));
    $sql = "SELECT o.id AS order_id, o.total_amount, o.delivery_status, o.created_at,
                   u.name AS customer_name, oi.qty, oi.price, p.name AS product_name
            FROM orders o
            JOIN order_items oi ON oi.order_id = o.id
            JOIN products p ON oi.product_id = p.id
            JOIN users u ON o.customer_id = u.id
            WHERE oi.seller_id = ? AND o.delivery_status = 'pending'
            ORDER BY o.id DESC LIMIT $limit";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_list_for_delivery($conn) {
    $sql = "SELECT o.id, o.total_amount, o.delivery_status, o.assigned_vendor_id, o.created_at,
                   u.name AS customer_name, v.name AS vendor_name
            FROM orders o
            JOIN users u ON o.customer_id = u.id
            LEFT JOIN users v ON o.assigned_vendor_id = v.id
            ORDER BY o.id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_get_assignment($conn, $orderId) {
    $stmt = mysqli_prepare($conn, "SELECT assigned_vendor_id FROM orders WHERE id = ? LIMIT 1");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'i', $orderId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ?: false;
}

function order_assign_and_update($conn, $orderId, $vendorId, $status) {
    $stmt = mysqli_prepare($conn, "UPDATE orders SET delivery_status = ?, assigned_vendor_id = ? WHERE id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'sii', $status, $vendorId, $orderId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function order_update_status_vendor($conn, $orderId, $vendorId, $status) {
    $stmt = mysqli_prepare($conn, "UPDATE orders SET delivery_status = ? WHERE id = ? AND (assigned_vendor_id = ? OR assigned_vendor_id IS NULL)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'sii', $status, $orderId, $vendorId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function order_customer_recent($conn, $customerId, $limit = 5) {
    $limit = max(1, min(100, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT id, total_amount, delivery_status, created_at FROM orders WHERE customer_id = ? ORDER BY id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_items($conn, $orderId) {
    $stmt = mysqli_prepare($conn, "SELECT oi.qty, oi.price, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $orderId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_customer_history($conn, $customerId) {
    $stmt = mysqli_prepare($conn, "SELECT id, total_amount, delivery_status, created_at FROM orders WHERE customer_id = ? ORDER BY id DESC");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $orders = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    foreach ($orders as &$order) {
        $order['items'] = order_items($conn, (int)$order['id']);
    }
    unset($order);
    return $orders;
}

function order_customer_has_purchased($conn, $customerId, $productId) {
    $stmt = mysqli_prepare($conn, "SELECT 1 FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE o.customer_id = ? AND oi.product_id = ? LIMIT 1");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ii', $customerId, $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ok = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return $ok;
}

function order_customer_purchased_products($conn, $customerId) {
    $stmt = mysqli_prepare($conn, "SELECT DISTINCT p.id, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id JOIN orders o ON oi.order_id = o.id WHERE o.customer_id = ? ORDER BY p.name");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function order_create_from_cart($conn, $customerId, $cart) {
    if (empty($cart)) return ['ok' => false, 'error' => 'Cart is empty.'];
    mysqli_begin_transaction($conn);
    try {
        $items = [];
        $total = 0.0;
        foreach ($cart as $cartItem) {
            $productId = (int)($cartItem['product_id'] ?? 0);
            $qty = max(1, (int)($cartItem['qty'] ?? 1));
            $stmt = mysqli_prepare($conn, "SELECT id, seller_id, name, selling_price, stock_qty FROM products WHERE id = ? FOR UPDATE");
            if (!$stmt) throw new Exception('Could not read product.');
            mysqli_stmt_bind_param($stmt, 'i', $productId);
            mysqli_stmt_execute($stmt);
            $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);
            if (!$row) throw new Exception('Product #' . $productId . ' not found.');
            if ((int)$row['stock_qty'] < $qty) throw new Exception('Only ' . (int)$row['stock_qty'] . ' in stock for ' . $row['name'] . '.');
            $price = (float)$row['selling_price'];
            $total += $price * $qty;
            $items[] = [
                'product_id' => $productId,
                'seller_id' => (int)$row['seller_id'],
                'qty' => $qty,
                'price' => $price,
            ];
        }

        $stmt = mysqli_prepare($conn, "INSERT INTO orders (customer_id, total_amount, delivery_status) VALUES (?, ?, 'pending')");
        if (!$stmt) throw new Exception('Could not create order.');
        mysqli_stmt_bind_param($stmt, 'id', $customerId, $total);
        if (!mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            throw new Exception('Could not create order.');
        }
        $orderId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

        foreach ($items as $item) {
            $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, seller_id, qty, price) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) throw new Exception('Could not create order item.');
            mysqli_stmt_bind_param($stmt, 'iiiid', $orderId, $item['product_id'], $item['seller_id'], $item['qty'], $item['price']);
            if (!mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                throw new Exception('Could not create order item.');
            }
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($conn, "UPDATE products SET stock_qty = stock_qty - ? WHERE id = ? AND stock_qty >= ?");
            if (!$stmt) throw new Exception('Could not update stock.');
            mysqli_stmt_bind_param($stmt, 'iii', $item['qty'], $item['product_id'], $item['qty']);
            mysqli_stmt_execute($stmt);
            $affected = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            if ($affected !== 1) throw new Exception('Stock changed before checkout. Please review your cart.');
        }

        mysqli_commit($conn);
        return ['ok' => true, 'order_id' => $orderId, 'total' => $total];
    } catch (Throwable $e) {
        mysqli_rollback($conn);
        return ['ok' => false, 'error' => $e->getMessage()];
    }
}
