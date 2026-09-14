<?php require __DIR__ . '/../partials/header.php'; ?>
<div class="card"><div class="card-header"><h1>Customer Complaints</h1><p>Reply and mark complaints as resolved.</p></div>
<?php if($generalErr):?><div class="alert alert-error"><?php echo e($generalErr);?></div><?php endif;?><?php if($successMsg):?><div class="alert alert-success"><?php echo e($successMsg);?></div><?php endif;?>
<?php if(!$complaints):?><p class="muted">No complaints yet.</p><?php else:?>
<table class="data-table"><tr><th>ID</th><th>Customer</th><th>Message</th><th>Status</th><th>Reply</th><th>Date</th><th>Action</th></tr>
<?php foreach($complaints as $c):?><tr><td>#<?php echo e($c['id']);?></td><td><?php echo e($c['customer_name']);?><br><span class="small muted"><?php echo e($c['customer_email']);?></span></td><td><?php echo e($c['message']);?></td><td><?php echo e($c['status']);?></td><td><?php echo $c['reply']?e($c['reply']):'<span class="muted">—</span>';?></td><td class="small"><?php echo e($c['created_at']);?></td><td>
<?php if($c['status']==='open'):?><form method="post" action="<?php echo e(url_for('admin','complaints'));?>"><?php echo csrf_field();?><input type="hidden" name="complaint_id" value="<?php echo e($c['id']);?>"><textarea name="reply" rows="2" placeholder="Write reply..." style="min-height:60px;font-size:13px;"></textarea><br><button class="btn btn-primary btn-small">Resolve</button></form><?php else:?><span class="small muted">Resolved</span><?php endif;?></td></tr><?php endforeach;?></table><?php endif;?>
</div><?php require __DIR__ . '/../partials/footer.php'; ?>
