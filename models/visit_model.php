<?php
// MODEL: store_visits.

function visit_create($conn, $customerId, $sellerId, $visitDate, $message) {
    $stmt = mysqli_prepare($conn, "INSERT INTO store_visits (customer_id, seller_id, visit_date, message) VALUES (?, ?, ?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'iiss', $customerId, $sellerId, $visitDate, $message);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function visit_list_customer($conn, $customerId, $limit = 10) {
    $limit = max(1, min(100, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT sv.id, sv.visit_date, sv.message, sv.status, sv.created_at, u.name AS seller_name, u.shop_name FROM store_visits sv JOIN users u ON sv.seller_id = u.id WHERE sv.customer_id = ? ORDER BY sv.id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
