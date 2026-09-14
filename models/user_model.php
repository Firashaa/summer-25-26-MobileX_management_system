<?php
// MODEL: users. All users (admin/vendor/seller/customer) live in this table.

function user_find_by_email($conn, $email) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, email, password, role, shop_name, business_name, address, status, created_at FROM users WHERE email = ? LIMIT 1");
    if (!$stmt) return null;
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ?: null;
}

function user_get_by_id($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, email, role, shop_name, business_name, address, status, created_at FROM users WHERE id = ? LIMIT 1");
    if (!$stmt) return null;
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ?: null;
}

function user_get_profile($conn, $id) {
    return user_get_by_id($conn, $id);
}

function user_email_exists($conn, $email, $excludeId = 0) {
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? AND id <> ? LIMIT 1");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'si', $email, $excludeId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return $exists;
}

function user_create($conn, $name, $email, $password, $role, $shopName = null) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, role, shop_name, status) VALUES (?, ?, ?, ?, ?, 'active')");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $hash, $role, $shopName);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function user_list($conn, $role = '') {
    if ($role === '') {
        $stmt = mysqli_prepare($conn, "SELECT id, name, email, role, shop_name, status, created_at FROM users ORDER BY id DESC");
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, name, email, role, shop_name, status, created_at FROM users WHERE role = ? ORDER BY id DESC");
        if ($stmt) mysqli_stmt_bind_param($stmt, 's', $role);
    }
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function user_update_status($conn, $id, $status) {
    $stmt = mysqli_prepare($conn, "UPDATE users SET status = ? WHERE id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function user_count_active_by_role($conn, $role) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM users WHERE role = ? AND status = 'active'");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 's', $role);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function user_update_profile($conn, $id, $name, $email, $shopName, $address) {
    $stmt = mysqli_prepare($conn, "UPDATE users SET name = ?, email = ?, shop_name = ?, address = ? WHERE id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $shopName, $address, $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function user_get_password_hash($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE id = ? LIMIT 1");
    if (!$stmt) return null;
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row['password'] ?? null;
}

function user_update_password($conn, $id, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'si', $hash, $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function user_active_sellers($conn) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, shop_name FROM users WHERE role = 'seller' AND status = 'active' ORDER BY name");
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function user_is_seller($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE id = ? AND role = 'seller' AND status = 'active' LIMIT 1");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ok = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return $ok;
}
