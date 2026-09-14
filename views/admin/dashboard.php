<?php require __DIR__ . '/../partials/header.php'; ?>
<div class="card"><div class="card-header"><h1>Admin Dashboard</h1><p>Overview of the shop — revenue, users and system health.</p></div></div>
<div class="card"><div class="card-header"><h2>Sales Overview</h2></div><div class="stats">
    <div class="stat-box"><span class="num"><?php echo e(number_format($total_revenue,2)); ?></span><span class="lbl">Total Revenue (TK)</span></div>
    <div class="stat-box"><span class="num"><?php echo e($order_count); ?></span><span class="lbl">Total Orders</span></div>
    <div class="stat-box"><span class="num"><?php echo e($total_sales); ?></span><span class="lbl">Total Sales</span></div>
    <div class="stat-box"><span class="num"><?php echo e($notice_count); ?></span><span class="lbl">Notices Sent</span></div>
</div></div>
<div class="card"><div class="card-header"><h2>User Overview</h2></div><div class="stats">
    <div class="stat-box"><span class="num"><?php echo e($vendor_count); ?></span><span class="lbl">Active Vendors</span></div>
    <div class="stat-box"><span class="num"><?php echo e($seller_count); ?></span><span class="lbl">Active Sellers</span></div>
    <div class="stat-box"><span class="num"><?php echo e($customer_count); ?></span><span class="lbl">Customers</span></div>
    <div class="stat-box"><span class="num"><?php echo e($open_complaints); ?></span><span class="lbl">Open Complaints</span></div>
</div></div>
<div class="card"><div class="card-header"><h2>Recent Orders</h2></div>
<?php if (!$recent_orders): ?><p class="muted">No orders yet.</p><?php else: ?>
<table class="data-table"><tr><th>ID</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr>
<?php foreach($recent_orders as $o): ?><tr><td>#<?php echo e($o['id']); ?></td><td><?php echo e($o['customer_name']); ?></td><td>TK <?php echo e(number_format((float)$o['total_amount'],2)); ?></td><td><?php echo e($o['delivery_status']); ?></td><td><?php echo e($o['created_at']); ?></td></tr><?php endforeach; ?>
</table><?php endif; ?></div>
<div class="card"><div class="card-header"><h2>Manage</h2></div><p class="text-center">
<a class="btn btn-primary btn-small" href="<?php echo e(url_for('admin','users')); ?>">Manage Users</a>
<a class="btn btn-primary btn-small" href="<?php echo e(url_for('admin','complaints')); ?>">Complaints</a>
<a class="btn btn-primary btn-small" href="<?php echo e(url_for('admin','notices')); ?>">Notices</a>
<a class="btn btn-secondary btn-small" href="<?php echo e(url_for('admin','profile')); ?>">My Profile</a>
</p></div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
