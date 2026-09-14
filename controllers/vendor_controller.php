<?php
// CONTROLLER: vendor.

function vendor_controller($conn) {
    require_role('vendor');
    $section = $_GET['section'] ?? 'dashboard';
    $allowed = ['dashboard', 'pricing', 'delivery', 'policy', 'profile'];
    if (!in_array($section, $allowed, true)) $section = 'dashboard';
    $vid = current_user_id();
    $generalErr = $successMsg = '';

    if ($section === 'dashboard') {
        $product_count = $conn ? vendor_product_count($conn, $vid) : 0;
        $pending_orders = $conn ? order_pending_count_all($conn) : 0;
        $assigned_orders = $conn ? order_assigned_count_vendor($conn, $vid) : 0;
        $notices = $conn ? notice_recent_for_role($conn, 'vendor', 3) : [];
        $page_title = 'Vendor Dashboard';
        require __DIR__ . '/../views/vendor/dashboard.php';
        return;
    }

    if ($section === 'pricing') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $action = $_POST['action'] ?? '';
            $productId = (int)($_POST['product_id'] ?? 0);
            if ($action === 'add') {
                $name = clean_input($_POST['name'] ?? '');
                $price = $_POST['price'] ?? '';
                if ($name === '') $generalErr = 'Product name is required.';
                elseif (!is_numeric($price) || (float)$price <= 0) $generalErr = 'Valid price is required (>0).';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (vendor_product_create($conn, $vid, $name, (float)$price)) $successMsg = 'Supply item added.';
                else $generalErr = 'Could not add supply item.';
            } elseif ($action === 'edit') {
                $price = $_POST['price'] ?? '';
                if ($productId <= 0 || !is_numeric($price) || (float)$price <= 0) $generalErr = 'Valid product and price are required.';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (vendor_product_update_price($conn, $vid, $productId, (float)$price)) $successMsg = "Price updated for #$productId.";
                else $generalErr = 'Could not update price.';
            } elseif ($action === 'delete') {
                if ($productId <= 0) $generalErr = 'Invalid product.';
                elseif (!$conn) $generalErr = 'Database not available.';
                elseif (vendor_product_delete($conn, $vid, $productId)) $successMsg = "Product #$productId deleted.";
                else $generalErr = 'Delete failed. The product may be referenced elsewhere.';
            }
        }
        $products = $conn ? vendor_product_list($conn, $vid) : [];
        $page_title = 'Dynamic Pricing';
        require __DIR__ . '/../views/vendor/pricing.php';
        return;
    }

    if ($section === 'delivery') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $orderId = (int)($_POST['order_id'] ?? 0);
            $status = clean_input($_POST['delivery_status'] ?? 'pending');
            $assign = isset($_POST['assign_to_me']);
            if ($orderId <= 0) $generalErr = 'Invalid order.';
            elseif (!in_array($status, ['pending', 'shipped', 'delivered', 'cancelled'], true)) $generalErr = 'Invalid status.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif ($assign) {
                if (order_assign_and_update($conn, $orderId, $vid, $status)) $successMsg = "Order #$orderId assigned to you and updated.";
                else $generalErr = 'Could not update order.';
            } else {
                $assignment = order_get_assignment($conn, $orderId);
                $allowedUpdate = $assignment && ($assignment['assigned_vendor_id'] === null || (int)$assignment['assigned_vendor_id'] === $vid);
                if (!$allowedUpdate) $generalErr = 'You can only update an order assigned to you or an unassigned order.';
                elseif (order_update_status_vendor($conn, $orderId, $vid, $status)) $successMsg = "Order #$orderId status changed to $status.";
                else $generalErr = 'Could not update order.';
            }
        }
        $orders = $conn ? order_list_for_delivery($conn) : [];
        $page_title = 'Delivery Assign & Status';
        require __DIR__ . '/../views/vendor/delivery.php';
        return;
    }

    if ($section === 'policy') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $productId = (int)($_POST['product_id'] ?? 0);
            $policy = clean_input($_POST['return_policy'] ?? '');
            if ($productId <= 0) $generalErr = 'Invalid product.';
            elseif (strlen($policy) < 5) $generalErr = 'Policy must be at least 5 characters.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (vendor_product_update_policy($conn, $vid, $productId, $policy)) $successMsg = "Policy updated for #$productId.";
            else $generalErr = 'Could not update policy.';
        }
        $products = $conn ? vendor_product_list($conn, $vid) : [];
        $page_title = 'Damage / Return Policy';
        require __DIR__ . '/../views/vendor/policy.php';
        return;
    }

    profile_controller_section($conn, 'vendor', __DIR__ . '/../views/vendor/profile.php');
}
