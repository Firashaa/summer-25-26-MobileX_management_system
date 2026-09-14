<?php
// CONTROLLER: customer.

function customer_controller($conn) {
    require_role('customer');
    $section = $_GET['section'] ?? 'browse';
    $allowed = ['browse', 'cart', 'checkout', 'orders', 'reviews', 'visit', 'complaints', 'profile'];
    if (!in_array($section, $allowed, true)) $section = 'browse';
    $cid = current_user_id();
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $generalErr = $successMsg = '';

    if ($section === 'browse') {
        $q = clean_input($_GET['q'] ?? '');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $productId = (int)($_POST['product_id'] ?? 0);
            $qty = max(1, (int)($_POST['qty'] ?? 1));
            if ($productId <= 0) $generalErr = 'Invalid product.';
            elseif (!$conn) $generalErr = 'Database not available.';
            else {
                $product = product_get($conn, $productId);
                if (!$product) $generalErr = 'Product not found.';
                elseif ((int)$product['stock_qty'] < $qty) $generalErr = 'Only ' . (int)$product['stock_qty'] . ' in stock.';
                else {
                    $found = false;
                    foreach ($_SESSION['cart'] as &$item) {
                        if ((int)$item['product_id'] === $productId) {
                            $newQty = (int)$item['qty'] + $qty;
                            if ($newQty > (int)$product['stock_qty']) $generalErr = 'Cart quantity would exceed available stock.';
                            else { $item['qty'] = $newQty; $successMsg = 'Cart updated.'; }
                            $found = true;
                            break;
                        }
                    }
                    unset($item);
                    if (!$found && !$generalErr) {
                        $_SESSION['cart'][] = ['product_id' => $productId, 'name' => $product['name'], 'price' => (float)$product['selling_price'], 'qty' => $qty];
                        $successMsg = "Added '" . $product['name'] . "' to cart.";
                    }
                }
            }
        }
        $products = $conn ? product_browse($conn, $q) : [];
        $page_title = 'Browse Products';
        require __DIR__ . '/../views/customer/browse.php';
        return;
    }

    if ($section === 'cart') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $action = $_POST['action'] ?? '';
            $index = (int)($_POST['idx'] ?? -1);
            if ($action === 'update' && isset($_SESSION['cart'][$index])) {
                $qty = max(1, (int)($_POST['qty'] ?? 1));
                $productId = (int)$_SESSION['cart'][$index]['product_id'];
                $stock = $conn ? product_stock_quantity($conn, $productId) : null;
                if ($stock !== null && $qty > $stock) $generalErr = "Only $stock in stock for that item.";
                else $_SESSION['cart'][$index]['qty'] = $qty;
            } elseif ($action === 'remove' && isset($_SESSION['cart'][$index])) {
                array_splice($_SESSION['cart'], $index, 1);
            } elseif ($action === 'clear') {
                $_SESSION['cart'] = [];
            }
        }
        $total = 0.0;
        foreach ($_SESSION['cart'] as $item) $total += (float)$item['price'] * (int)$item['qty'];
        $page_title = 'Your Cart';
        require __DIR__ . '/../views/customer/cart.php';
        return;
    }

    if ($section === 'checkout') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            if (!$conn) $generalErr = 'Database not available.';
            else {
                $result = order_create_from_cart($conn, $cid, $_SESSION['cart']);
                if ($result['ok']) {
                    $_SESSION['cart'] = [];
                    $successMsg = 'Order #' . $result['order_id'] . ' placed! Total TK ' . number_format($result['total'], 2) . '. Delivery pending.';
                } else $generalErr = $result['error'];
            }
        }
        $total = 0.0;
        foreach ($_SESSION['cart'] as $item) $total += (float)$item['price'] * (int)$item['qty'];
        $has_cart = !empty($_SESSION['cart']);
        $orders = $conn ? order_customer_recent($conn, $cid, 5) : [];
        $page_title = 'Checkout';
        require __DIR__ . '/../views/customer/checkout.php';
        return;
    }

    if ($section === 'orders') {
        $orders = $conn ? order_customer_history($conn, $cid) : [];
        $page_title = 'My Orders';
        require __DIR__ . '/../views/customer/orders.php';
        return;
    }

    if ($section === 'reviews') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $productId = (int)($_POST['product_id'] ?? 0);
            $rating = (int)($_POST['rating'] ?? 0);
            $comment = clean_input($_POST['comment'] ?? '');
            if ($productId <= 0) $generalErr = 'Invalid product.';
            elseif ($rating < 1 || $rating > 5) $generalErr = 'Rating must be 1-5.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (!order_customer_has_purchased($conn, $cid, $productId)) $generalErr = 'You can only review products you purchased.';
            elseif (review_create($conn, $cid, $productId, $rating, $comment)) $successMsg = 'Review posted.';
            else $generalErr = 'Could not post review.';
        }
        $purchased_products = $conn ? order_customer_purchased_products($conn, $cid) : [];
        $my_reviews = $conn ? review_list_customer($conn, $cid, 10) : [];
        $page_title = 'Reviews';
        require __DIR__ . '/../views/customer/reviews.php';
        return;
    }

    if ($section === 'visit') {
        $seller_id = clean_input($_POST['seller_id'] ?? '');
        $visit_date = clean_input($_POST['visit_date'] ?? '');
        $message = clean_input($_POST['message'] ?? '');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            if ($seller_id === '' || !ctype_digit($seller_id)) $generalErr = 'Select a seller.';
            elseif ($visit_date === '') $generalErr = 'Visit date is required.';
            else {
                $date = DateTime::createFromFormat('Y-m-d', $visit_date);
                if (!$date || $date->format('Y-m-d') !== $visit_date) $generalErr = 'Invalid date.';
                elseif ($date < new DateTime('today')) $generalErr = 'Date cannot be in the past.';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (!user_is_seller($conn, (int)$seller_id)) $generalErr = 'Invalid seller.';
                elseif (visit_create($conn, $cid, (int)$seller_id, $visit_date, $message)) {
                    $successMsg = 'Visit request sent.';
                    $seller_id = $visit_date = $message = '';
                } else $generalErr = 'Could not send visit request.';
            }
        }
        $sellers = $conn ? user_active_sellers($conn) : [];
        $my_visits = $conn ? visit_list_customer($conn, $cid, 10) : [];
        $page_title = 'Store Visit Request';
        require __DIR__ . '/../views/customer/visit.php';
        return;
    }

    if ($section === 'complaints') {
        $message = clean_input($_POST['message'] ?? '');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            if (strlen($message) < 5) $generalErr = 'Message must be at least 5 characters.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (complaint_create($conn, $cid, $message)) { $successMsg = 'Complaint submitted. Admin will reply.'; $message = ''; }
            else $generalErr = 'Could not submit complaint.';
        }
        $my = $conn ? complaint_list_customer($conn, $cid) : [];
        $page_title = 'Your Complaints';
        require __DIR__ . '/../views/customer/complaints.php';
        return;
    }

    profile_controller_section($conn, 'customer', __DIR__ . '/../views/customer/profile.php');
}
