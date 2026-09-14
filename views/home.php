<?php $page_title = APP_NAME; require __DIR__ . '/partials/header.php'; ?>
<div class="hero">
    <h1>MobiTrackk</h1>
    <p style="color:#2D0000; font-size:16px; margin-top:2px; line-height:1;">A Reliable Management System</p>
</div>
<div class="role-grid">
    <div class="role-card"><h3>Admin</h3><p>View total sales, active sellers & vendors, revenue; handle complaints & post notices.</p><a class="btn btn-primary btn-block" href="<?php echo e(auth_url('login','admin')); ?>">Admin Login</a></div>
    <div class="role-card"><h3>Vendor</h3><p>Manage supply items & dynamic pricing, update delivery status, set return policy.</p><a class="btn btn-primary btn-block" href="<?php echo e(auth_url('login','vendor')); ?>">Vendor Login</a></div>
    <div class="role-card"><h3>Seller</h3><p>Track stock & pending orders, calculate profit margin, wishlist vendor products.</p><a class="btn btn-primary btn-block" href="<?php echo e(auth_url('login','seller')); ?>">Seller Login</a></div>
    <div class="role-card"><h3>Customer</h3><p>Browse & search, cart & checkout, write reviews, request store visits.</p><a class="btn btn-primary btn-block" href="<?php echo e(auth_url('login','customer')); ?>">Customer Login</a></div>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
