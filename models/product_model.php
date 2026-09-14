<?php
// MODEL: seller products.

function product_get($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT id, seller_id, name, selling_price, cost_price, profit_margin, image, stock_qty, description, created_at FROM products WHERE id = ? LIMIT 1");
    if (!$stmt) return null;
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ?: null;
}

function product_browse($conn, $term = '') {
    if ($term !== '') {
        $like = '%' . $term . '%';
        $sql = "SELECT p.id, p.name, p.selling_price, p.stock_qty, p.image, u.name AS seller_name
                FROM products p
                JOIN users u ON p.seller_id = u.id
                WHERE p.name LIKE ? OR p.description LIKE ?
                ORDER BY p.id ASC";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return [];
        mysqli_stmt_bind_param($stmt, 'ss', $like, $like);
    } else {
        $sql = "SELECT p.id, p.name, p.selling_price, p.stock_qty, p.image, u.name AS seller_name
                FROM products p
                JOIN users u ON p.seller_id = u.id
                ORDER BY p.id ASC";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return [];
    }

    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function product_count_by_seller($conn, $sellerId) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM products WHERE seller_id = ?");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function product_count_low_stock($conn, $sellerId, $threshold = 5) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM products WHERE seller_id = ? AND stock_qty <= ?");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'ii', $sellerId, $threshold);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function product_list_by_seller($conn, $sellerId) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, selling_price, cost_price, stock_qty, profit_margin, description, created_at FROM products WHERE seller_id = ? ORDER BY id ASC");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function product_update_stock($conn, $productId, $sellerId, $qty) {
    $stmt = mysqli_prepare($conn, "UPDATE products SET stock_qty = ? WHERE id = ? AND seller_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'iii', $qty, $productId, $sellerId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function product_create($conn, $sellerId, $name, $sellingPrice, $costPrice, $margin, $stockQty, $description) {
    $stmt = mysqli_prepare($conn, "INSERT INTO products (seller_id, name, selling_price, cost_price, profit_margin, stock_qty, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'isdddis', $sellerId, $name, $sellingPrice, $costPrice, $margin, $stockQty, $description);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function product_delete($conn, $productId, $sellerId) {
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ? AND seller_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ii', $productId, $sellerId);
    $ok = mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $ok && $affected > 0;
}

function product_stock_quantity($conn, $productId) {
    $stmt = mysqli_prepare($conn, "SELECT stock_qty FROM products WHERE id = ? LIMIT 1");
    if (!$stmt) return null;
    mysqli_stmt_bind_param($stmt, 'i', $productId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ? (int)$row['stock_qty'] : null;
}
