<?php
// ================================================================
// FRONT CONTROLLER / ROUTER
// Every request enters here: index.php?page=<role>&section=<screen>
// ================================================================

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/helpers/helpers.php';

// Models
require_once __DIR__ . '/models/user_model.php';
require_once __DIR__ . '/models/product_model.php';
require_once __DIR__ . '/models/order_model.php';
require_once __DIR__ . '/models/vendor_product_model.php';
require_once __DIR__ . '/models/complaint_model.php';
require_once __DIR__ . '/models/notice_model.php';
require_once __DIR__ . '/models/review_model.php';
require_once __DIR__ . '/models/visit_model.php';
require_once __DIR__ . '/models/wishlist_model.php';
require_once __DIR__ . '/models/seller_stock_model.php';

// Controllers
require_once __DIR__ . '/controllers/auth_controller.php';
require_once __DIR__ . '/controllers/profile_controller.php';
require_once __DIR__ . '/controllers/admin_controller.php';
require_once __DIR__ . '/controllers/vendor_controller.php';
require_once __DIR__ . '/controllers/seller_controller.php';
require_once __DIR__ . '/controllers/customer_controller.php';

check_session_timeout();

// If a logged-in user opens the bare project root, redirect to the
// canonical role route so page/section navigation is always available.
if (!isset($_GET['page']) && is_logged_in()) {
    redirect(role_home_url(current_role()));
}

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        if (is_logged_in()) redirect(role_home_url(current_role()));
        $page_title = APP_NAME;
        require __DIR__ . '/views/home.php';
        break;
    case 'login': login_controller($conn); break;
    case 'register': register_controller($conn); break;
    case 'logout': logout_controller(); break;
    case 'admin': admin_controller($conn); break;
    case 'vendor': vendor_controller($conn); break;
    case 'seller': seller_controller($conn); break;
    case 'customer': customer_controller($conn); break;
    default: redirect(url_for('home'));
}

if ($conn) mysqli_close($conn);
