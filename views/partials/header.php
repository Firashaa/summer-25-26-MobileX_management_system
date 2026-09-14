<?php
$currentPage = $_GET['page'] ?? 'home';
$hideTopbar = !is_logged_in() && $currentPage === 'home';
$role = current_role();
$page_title = $page_title ?? APP_NAME;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($page_title); ?> - <?php echo e(APP_NAME); ?></title>
    <link rel="preload" href="<?php echo e(base_url('assets/fonts/DebugFreeTrial-MVdYB.otf')); ?>" as="font" type="font/otf" crossorigin>
    <link rel="preload" href="<?php echo e(base_url('assets/fonts/Robus-BWqOd.otf')); ?>" as="font" type="font/otf" crossorigin>
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/style.css')); ?>">
    <script src="<?php echo e(base_url('assets/js/app.js')); ?>" defer></script>
</head>
<body>
<?php if (!$hideTopbar): ?>
<div class="topbar">
    <div class="topbar-inner">
        <a class="brand" href="<?php echo e($role ? role_home_url($role) : url_for('home')); ?>">MobiTrackk<span>A Reliable Management System</span></a>
        <div class="nav">
            <?php if ($role): ?>
                <span class="nav-user"><?php echo e(strtoupper($role)); ?></span>
                <?php if ($role === 'admin'): ?>
                    <a href="<?php echo e(url_for('admin','dashboard')); ?>">Dashboard</a>
                    <a href="<?php echo e(url_for('admin','users')); ?>">Users</a>
                    <a href="<?php echo e(url_for('admin','complaints')); ?>">Complaints</a>
                    <a href="<?php echo e(url_for('admin','notices')); ?>">Notices</a>
                    <a href="<?php echo e(url_for('admin','profile')); ?>">Profile</a>
                <?php elseif ($role === 'vendor'): ?>
                    <a href="<?php echo e(url_for('vendor','dashboard')); ?>">Dashboard</a>
                    <a href="<?php echo e(url_for('vendor','pricing')); ?>">Pricing</a>
                    <a href="<?php echo e(url_for('vendor','delivery')); ?>">Delivery</a>
                    <a href="<?php echo e(url_for('vendor','policy')); ?>">Policy</a>
                    <a href="<?php echo e(url_for('vendor','profile')); ?>">Profile</a>
                <?php elseif ($role === 'seller'): ?>
                    <a href="<?php echo e(url_for('seller','dashboard')); ?>">Dashboard</a>
                    <a href="<?php echo e(url_for('seller','stock')); ?>">Stock</a>
                    <a href="<?php echo e(url_for('seller','margin')); ?>">Margin</a>
                    <a href="<?php echo e(url_for('seller','wishlist')); ?>">Wishlist</a>
                    <a href="<?php echo e(url_for('seller','profile')); ?>">Profile</a>
                <?php elseif ($role === 'customer'): ?>
                    <a href="<?php echo e(url_for('customer','browse')); ?>">Browse</a>
                    <a href="<?php echo e(url_for('customer','cart')); ?>">Cart</a>
                    <a href="<?php echo e(url_for('customer','orders')); ?>">Orders</a>
                    <a href="<?php echo e(url_for('customer','reviews')); ?>">Reviews</a>
                    <a href="<?php echo e(url_for('customer','visit')); ?>">Visit</a>
                    <a href="<?php echo e(url_for('customer','complaints')); ?>">Complaints</a>
                    <a href="<?php echo e(url_for('customer','profile')); ?>">Profile</a>
                <?php endif; ?>
                <a class="nav-logout" href="<?php echo e(url_for('logout')); ?>">Logout</a>
            <?php else: ?>
                <a href="<?php echo e(auth_url('login','admin')); ?>">Admin</a>
                <a href="<?php echo e(auth_url('login','vendor')); ?>">Vendor</a>
                <a href="<?php echo e(auth_url('login','seller')); ?>">Seller</a>
                <a href="<?php echo e(auth_url('login','customer')); ?>">Customer</a>
            <?php endif; ?>
        </div><div class="clear"></div>
    </div>
</div>
<?php endif; ?>
<div class="container">
<?php if (!empty($db_error)): ?>
    <div class="alert alert-error"><strong>Database warning:</strong> <?php echo e($db_error); ?></div>
<?php endif; ?>
