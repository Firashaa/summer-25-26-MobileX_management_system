<?php require __DIR__ . '/../partials/header.php'; ?>
<div class="card"><div class="card-header"><h1>Manage Users</h1><p>View all users and toggle active/inactive status.</p></div>
<?php if($generalErr):?><div class="alert alert-error"><?php echo e($generalErr);?></div><?php endif;?><?php if($successMsg):?><div class="alert alert-success"><?php echo e($successMsg);?></div><?php endif;?>
<p class="small">Filter: <a class="btn btn-secondary btn-small" href="<?php echo e(url_for('admin','users')); ?>">All</a>
<?php foreach(['vendor'=>'Vendors','seller'=>'Sellers','customer'=>'Customers','admin'=>'Admins'] as $r=>$label): ?><a class="btn btn-secondary btn-small" href="<?php echo e(url_for('admin','users',['role'=>$r])); ?>"><?php echo e($label); ?></a><?php endforeach; ?></p>
<?php if(!$users):?><p class="muted">No users found.</p><?php else:?>
<table class="data-table"><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Shop</th><th>Status</th><th>Joined</th><th>Action</th></tr>
<?php foreach($users as $u):?><tr><td>#<?php echo e($u['id']);?></td><td><?php echo e($u['name']);?></td><td class="small"><?php echo e($u['email']);?></td><td><?php echo e($u['role']);?></td><td><?php echo $u['shop_name']?e($u['shop_name']):'<span class="muted">—</span>';?></td><td><?php echo e($u['status']);?></td><td class="small"><?php echo e($u['created_at']);?></td><td>
<?php if((int)$u['id']===current_user_id()):?><span class="small muted">you</span><?php else:?>
<form method="post" class="inline-form" action="<?php echo e(url_for('admin','users',['role'=>$filter_role]));?>"><?php echo csrf_field();?><input type="hidden" name="user_id" value="<?php echo e($u['id']);?>"><input type="hidden" name="new_status" value="<?php echo $u['status']==='active'?'inactive':'active';?>"><button class="btn <?php echo $u['status']==='active'?'btn-secondary':'btn-primary';?> btn-small" data-confirm="Change status for user #<?php echo e($u['id']);?>?"><?php echo $u['status']==='active'?'Deactivate':'Activate';?></button></form>
<?php endif;?></td></tr><?php endforeach;?></table><?php endif;?>
<p class="mt"><a class="btn btn-secondary btn-small" href="<?php echo e(url_for('admin','dashboard'));?>">Back to Dashboard</a></p></div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
