<?php
// CONTROLLER: seller.

function seller_controller($conn) {
    require_role('seller');
    $section = $_GET['section'] ?? 'dashboard';
    $allowed = ['dashboard', 'stock', 'margin', 'wishlist', 'profile'];
    if (!in_array($section, $allowed, true)) $section = 'dashboard';
    $sid = current_user_id();
    $generalErr = $successMsg = '';

    if ($section === 'dashboard') {
        $product_count = $conn ? product_count_by_seller($conn, $sid) : 0;
        $low_stock = $conn ? product_count_low_stock($conn, $sid, 5) : 0;
        $pending_orders = $conn ? order_pending_count_seller($conn, $sid) : 0;
        $wishlist_count = $conn ? wishlist_count_seller($conn, $sid) : 0;
        $notices = $conn ? notice_recent_for_role($conn, 'seller', 3) : [];
        $page_title = 'Seller Dashboard';
        require __DIR__ . '/../views/seller/dashboard.php';
        return;
    }

    if ($section === 'stock') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $productId = (int)($_POST['product_id'] ?? 0);
            $qty = $_POST['stock_qty'] ?? '';
            if ($productId <= 0) $generalErr = 'Invalid product.';
            elseif ($qty === '' || !ctype_digit((string)$qty)) $generalErr = 'Stock must be an integer >= 0.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (product_update_stock($conn, $productId, $sid, (int)$qty)) $successMsg = "Stock updated for #$productId.";
            else $generalErr = 'Could not update stock.';
        }
        $products = $conn ? product_list_by_seller($conn, $sid) : [];
        $pending = $conn ? order_pending_items_seller($conn, $sid, 20) : [];
        $page_title = 'Stock Levels';
        require __DIR__ . '/../views/seller/stock.php';
        return;
    }

    if ($section === 'margin') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $action = $_POST['action'] ?? '';
            if ($action === 'add') {
                $name = clean_input($_POST['name'] ?? '');
                $cost = $_POST['cost_price'] ?? '';
                $sell = $_POST['selling_price'] ?? '';
                $stock = $_POST['stock_qty'] ?? '';
                $desc = clean_input($_POST['description'] ?? '');
                if ($name === '') $generalErr = 'Name is required.';
                elseif (!is_numeric($cost) || (float)$cost <= 0) $generalErr = 'Valid cost price is required.';
                elseif (!is_numeric($sell) || (float)$sell <= 0) $generalErr = 'Valid selling price is required.';
                elseif ((float)$sell < (float)$cost) $generalErr = 'Selling price should be at least cost price.';
                elseif ($stock === '' || !ctype_digit((string)$stock)) $generalErr = 'Stock must be an integer >= 0.';
                elseif (!$conn) $generalErr = 'Database not available.';
                else {
                    $costF = (float)$cost; $sellF = (float)$sell;
                    $margin = round((($sellF - $costF) / $sellF) * 100, 2);
                    if (product_create($conn, $sid, $name, $sellF, $costF, $margin, (int)$stock, $desc)) $successMsg = "Product added with margin " . number_format($margin, 2) . "%";
                    else $generalErr = 'Could not add product.';
                }
            } elseif ($action === 'delete') {
                $productId = (int)($_POST['product_id'] ?? 0);
                if ($productId <= 0) $generalErr = 'Invalid product.';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (product_delete($conn, $productId, $sid)) $successMsg = "Product #$productId deleted.";
                else $generalErr = 'Delete failed. The product may be referenced by orders/reviews.';
            }
        }
        $products = $conn ? product_list_by_seller($conn, $sid) : [];
        $page_title = 'Profit Margin Calculator';
        require __DIR__ . '/../views/seller/margin.php';
        return;
    }

    if ($section === 'wishlist') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $action = $_POST['action'] ?? '';
            if ($action === 'add') {
                $vendorProductId = (int)($_POST['vendor_product_id'] ?? 0);
                if ($vendorProductId <= 0) $generalErr = 'Invalid vendor product.';
                elseif (!$conn) $generalErr = 'Database not available.';
                else {
                    $result = wishlist_add($conn, $sid, $vendorProductId);
                    if (!$result['ok']) $generalErr = 'Could not save wishlist item.';
                    elseif (!$result['added']) $generalErr = 'Already in wishlist.';
                    else $successMsg = 'Added to wishlist.';
                }
            } elseif ($action === 'remove') {
                $wishlistId = (int)($_POST['wishlist_id'] ?? 0);
                if ($wishlistId <= 0) $generalErr = 'Invalid wishlist item.';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (wishlist_remove($conn, $sid, $wishlistId)) $successMsg = 'Removed from wishlist.';
                else $generalErr = 'Could not remove wishlist item.';
            }
        }
        $wishlist = $conn ? wishlist_list_seller($conn, $sid) : [];
        $vendor_products = $conn ? vendor_product_recent_all($conn, 20) : [];
        $page_title = 'Wishlist';
        require __DIR__ . '/../views/seller/wishlist.php';
        return;
    }

    profile_controller_section($conn, 'seller', __DIR__ . '/../views/seller/profile.php');
}
