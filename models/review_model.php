<?php
// MODEL: reviews.

function review_create($conn, $customerId, $productId, $rating, $comment) {
    $stmt = mysqli_prepare($conn, "INSERT INTO reviews (customer_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'iiis', $customerId, $productId, $rating, $comment);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function review_list_customer($conn, $customerId, $limit = 10) {
    $limit = max(1, min(100, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT r.rating, r.comment, r.created_at, p.name AS product_name FROM reviews r JOIN products p ON r.product_id = p.id WHERE r.customer_id = ? ORDER BY r.id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $customerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
