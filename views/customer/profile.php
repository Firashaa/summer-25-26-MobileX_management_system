<?php
$profile_role = 'customer';
$profile_label = 'Customer';
$profile_action = url_for('customer', 'profile');
$profile_back = url_for('customer','browse');
require __DIR__ . '/../partials/profile_form.php';
