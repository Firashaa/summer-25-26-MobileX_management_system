<?php
$login_heading = $role ? ucfirst($role) . ' Login' : 'Login';
require __DIR__ . '/../partials/header.php';
?>
<div class="card" style="max-width:520px; margin:0 auto;">
    <div class="card-header"><h1 style="font-size:28px;"><?php echo e($login_heading); ?></h1><p>Enter your credentials.</p></div>
    <?php if ($generalErr): ?><div class="alert alert-error"><?php echo e($generalErr); ?></div><?php endif; ?>
    <?php if ($successMsg): ?><div class="alert alert-success"><?php echo e($successMsg); ?></div><?php endif; ?>
    <?php if ($loginErr): ?><div class="alert alert-error"><?php echo e($loginErr); ?></div><?php endif; ?>
    <form method="post" action="<?php echo e(auth_url('login',$role)); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <div class="field"><label for="email">Email Address</label><input type="email" id="email" name="email" placeholder="you@example.com" value="<?php echo e($email); ?>"><?php if ($emailErr): ?><span class="error"><?php echo e($emailErr); ?></span><?php endif; ?></div>
        <div class="field"><label for="password">Password</label><input type="password" id="password" name="password" placeholder="At least 8 characters"><?php if ($passwordErr): ?><span class="error"><?php echo e($passwordErr); ?></span><?php endif; ?></div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <?php if ($role && $role !== 'admin'): ?><p class="small muted text-center mt">No account? <a href="<?php echo e(auth_url('register',$role)); ?>">Create <?php echo e($role); ?> account</a></p><?php endif; ?>
        <p class="small muted text-center" style="margin-top:8px;"><a href="<?php echo e(url_for('home')); ?>">Back to home</a></p>
    </form>
</div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
