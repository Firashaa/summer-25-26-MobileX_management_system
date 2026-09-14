<?php
$profile_role = 'seller';
$profile_label = 'Seller';
$profile_action = url_for('seller', 'profile');
$profile_back = url_for('seller','dashboard');
require __DIR__ . '/../partials/profile_form.php';
