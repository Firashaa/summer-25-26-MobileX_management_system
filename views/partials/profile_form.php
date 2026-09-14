<?php require __DIR__ . '/header.php'; ?>
<div class="card" style="max-width:650px; margin:0 auto;">
    <div class="card-header"><h1><?php echo e($profile_label); ?> Profile</h1><p>Update your basic information.</p></div>
    <?php if ($generalErr): ?><div class="alert alert-error"><?php echo e($generalErr); ?></div><?php endif; ?>
    <?php if ($successMsg): ?><div class="alert alert-success"><?php echo e($successMsg); ?></div><?php endif; ?>
    <form method="post" action="<?php echo e($profile_action); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="profile">
        <div class="field"><label for="name">Full Name</label><input type="text" id="name" name="name" value="<?php echo e($name); ?>"></div>
        <div class="field"><label for="email">Email Address</label><input type="email" id="email" name="email" value="<?php echo e($email); ?>"></div>
        <?php if ($profile_role !== 'customer'): ?>
        <div class="field"><label for="shop_name">Shop / Business Name (optional)</label><input type="text" id="shop_name" name="shop_name" value="<?php echo e($shop_name); ?>"></div>
        <?php endif; ?>
        <div class="field"><label for="address">Address (optional)</label><textarea id="address" name="address" rows="2"><?php echo e($address); ?></textarea></div>
        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
</div>
<div class="card" style="max-width:650px; margin:0 auto;">
    <div class="card-header"><h2>Change Password</h2></div>
    <form method="post" action="<?php echo e($profile_action); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="password">
        <div class="field"><label for="cur">Current Password</label><input type="password" id="cur" name="current_password"></div>
        <div class="field"><label for="new">New Password (min 8)</label><input type="password" id="new" name="new_password"></div>
        <div class="field"><label for="confirm">Confirm New Password</label><input type="password" id="confirm" name="confirm_password"></div>
        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
    </form>
    <p class="mt"><a class="btn btn-secondary btn-small" href="<?php echo e($profile_back); ?>">Back</a></p>
</div>
<?php require __DIR__ . '/footer.php'; ?>
