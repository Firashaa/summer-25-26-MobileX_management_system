<?php
$profile_role = 'admin';
$profile_label = 'Admin';
$profile_action = url_for('admin', 'profile');
$profile_back = url_for('admin','dashboard');
require __DIR__ . '/../partials/profile_form.php';
