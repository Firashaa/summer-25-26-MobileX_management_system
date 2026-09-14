<?php require __DIR__ . '/../partials/header.php'; ?>
<div class="card" style="max-width:520px; margin:0 auto;">
    <div class="card-header"><h1 style="font-size:28px;"><?php echo e(ucfirst($role)); ?> Register</h1><p>Create a new <?php echo e($role); ?> account.</p></div>
    <?php if ($generalErr): ?><div class="alert alert-error"><?php echo e($generalErr); ?></div><?php endif; ?>
    <form method="post" action="<?php echo e(auth_url('register',$role)); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <div class="field"><label for="name">Full Name</label><input type="text" id="name" name="name" value="<?php echo e($name); ?>"><?php if ($nameErr): ?><span class="error"><?php echo e($nameErr); ?></span><?php endif; ?></div>
        <div class="field"><label for="email">Email Address</label><input type="email" id="email" name="email" value="<?php echo e($email); ?>"><?php if ($emailErr): ?><span class="error"><?php echo e($emailErr); ?></span><?php endif; ?></div>
        <?php if ($role === 'vendor' || $role === 'seller'): ?><div class="field"><label for="shop_name">Shop / Business Name (optional)</label><input type="text" id="shop_name" name="shop_name" value="<?php echo e($shop_name); ?>"><?php if ($shopErr): ?><span class="error"><?php echo e($shopErr); ?></span><?php endif; ?></div><?php endif; ?>
        <div class="field"><label for="password">Password</label><input type="password" id="password" name="password"><?php if ($passwordErr): ?><span class="error"><?php echo e($passwordErr); ?></span><?php endif; ?></div>
        <div class="field"><label for="confirm">Confirm Password</label><input type="password" id="confirm" name="confirm"><?php if ($confirmErr): ?><span class="error"><?php echo e($confirmErr); ?></span><?php endif; ?></div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <p class="small muted text-center mt">Already have an account? <a href="<?php echo e(auth_url('login',$role)); ?>">Login</a></p>
    </form>
</div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
