<?php
// CONTROLLER: admin.

function admin_controller($conn) {
    require_role('admin');
    $section = $_GET['section'] ?? 'dashboard';
    $allowed = ['dashboard', 'users', 'complaints', 'notices', 'profile'];
    if (!in_array($section, $allowed, true)) $section = 'dashboard';
    $generalErr = $successMsg = '';

    if ($section === 'dashboard') {
        $summary = $conn ? order_admin_summary($conn) : ['order_count' => 0, 'revenue' => 0];
        $order_count = $summary['order_count'];
        $total_sales = $order_count;
        $total_revenue = $summary['revenue'];
        $vendor_count = $conn ? user_count_active_by_role($conn, 'vendor') : 0;
        $seller_count = $conn ? user_count_active_by_role($conn, 'seller') : 0;
        $customer_count = $conn ? user_count_active_by_role($conn, 'customer') : 0;
        $open_complaints = $conn ? complaint_count_open($conn) : 0;
        $notice_count = $conn ? notice_count($conn) : 0;
        $recent_orders = $conn ? order_recent($conn, 5) : [];
        $page_title = 'Admin Dashboard';
        require __DIR__ . '/../views/admin/dashboard.php';
        return;
    }

    if ($section === 'users') {
        $filter_role = sanitize_role($_GET['role'] ?? '') ?: '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $uid = (int)($_POST['user_id'] ?? 0);
            $status = clean_input($_POST['new_status'] ?? '');
            if (!in_array($status, ['active', 'inactive'], true)) $generalErr = 'Invalid status.';
            elseif ($uid === current_user_id()) $generalErr = 'Cannot change your own status.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (user_update_status($conn, $uid, $status)) $successMsg = "User #$uid status changed to $status.";
            else $generalErr = 'Could not update user status.';
        }
        $users = $conn ? user_list($conn, $filter_role) : [];
        $page_title = 'Manage Users';
        require __DIR__ . '/../views/admin/users.php';
        return;
    }

    if ($section === 'complaints') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            $id = (int)($_POST['complaint_id'] ?? 0);
            $reply = clean_input($_POST['reply'] ?? '');
            if ($id <= 0) $generalErr = 'Invalid complaint.';
            elseif ($reply === '') $generalErr = 'Reply cannot be empty.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (complaint_resolve($conn, $id, $reply)) $successMsg = "Complaint #$id resolved.";
            else $generalErr = 'Could not resolve complaint.';
        }
        $complaints = $conn ? complaint_list_all($conn) : [];
        $page_title = 'Customer Complaints';
        require __DIR__ . '/../views/admin/complaints.php';
        return;
    }

    if ($section === 'notices') {
        $message = clean_input($_POST['message'] ?? '');
        $target_role = clean_input($_POST['target_role'] ?? 'all');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_check();
            if ($message === '') $generalErr = 'Notice message cannot be empty.';
            elseif (!in_array($target_role, ['seller', 'vendor', 'all'], true)) $generalErr = 'Invalid target role.';
            elseif (!$conn) $generalErr = 'Database not available.';
            elseif (notice_create($conn, current_user_id(), $message, $target_role)) {
                $successMsg = 'Notice posted.';
                $message = '';
                $target_role = 'all';
            } else $generalErr = 'Could not post notice.';
        }
        $notices = $conn ? notice_list_all($conn) : [];
        $page_title = 'Post Notice';
        require __DIR__ . '/../views/admin/notices.php';
        return;
    }

    profile_controller_section($conn, 'admin', __DIR__ . '/../views/admin/profile.php');
}
