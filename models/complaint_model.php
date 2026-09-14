<?php
// MODEL: complaints.

function complaint_count_open($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM complaints WHERE status = 'open'");
    if (!$stmt) return 0;
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function complaint_list_all($conn) {
    $stmt = mysqli_prepare($conn, "SELECT c.id, c.customer_id, c.message, c.status, c.reply, c.created_at, u.name AS customer_name, u.email AS customer_email FROM complaints c JOIN users u ON c.customer_id = u.id ORDER BY c.id DESC");
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function complaint_resolve($conn, $complaintId, $reply) {
    $stmt = mysqli_prepare($conn, "UPDATE complaints SET reply = ?, status = 'resolved' WHERE id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'si', $reply, $complaintId);
    $ok = mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $ok && $affected > 0;
}

function complaint_create($conn, $customerId, $message) {
    $stmt = mysqli_prepare($conn, "INSERT INTO complaints (customer_id, message) VALUES (?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'is', $customerId, $message);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function complaint_list_customer($conn, $customerId) {
    $stmt = mysqli_prepare($conn, "SELECT id, message, status, reply, created_at FROM complaints WHERE customer_id = ? ORDER BY id DESC");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
