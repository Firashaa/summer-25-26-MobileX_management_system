<?php
// MODEL: notices.

function notice_count($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM notices");
    if (!$stmt) return 0;
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function notice_create($conn, $adminId, $message, $targetRole) {
    $stmt = mysqli_prepare($conn, "INSERT INTO notices (admin_id, message, target_role) VALUES (?, ?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'iss', $adminId, $message, $targetRole);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function notice_list_all($conn) {
    $stmt = mysqli_prepare($conn, "SELECT n.id, n.message, n.target_role, n.created_at, u.name AS admin_name FROM notices n JOIN users u ON n.admin_id = u.id ORDER BY n.id DESC");
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function notice_recent_for_role($conn, $role, $limit = 3) {
    if (!in_array($role, ['seller', 'vendor'], true)) return [];
    $limit = max(1, min(20, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT message, created_at FROM notices WHERE target_role IN (?, 'all') ORDER BY id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 's', $role);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
