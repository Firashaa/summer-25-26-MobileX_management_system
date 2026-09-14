<?php
// MODEL: wishlist.

function wishlist_count_seller($conn, $sellerId) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM wishlist WHERE seller_id = ?");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function wishlist_add($conn, $sellerId, $vendorProductId) {
    $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO wishlist (seller_id, vendor_product_id) VALUES (?, ?)");
    if (!$stmt) return ['ok' => false, 'added' => false];
    mysqli_stmt_bind_param($stmt, 'ii', $sellerId, $vendorProductId);
    $ok = mysqli_stmt_execute($stmt);
    $added = mysqli_stmt_affected_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return ['ok' => $ok, 'added' => $added];
}

function wishlist_remove($conn, $sellerId, $wishlistId) {
    $stmt = mysqli_prepare($conn, "DELETE FROM wishlist WHERE id = ? AND seller_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ii', $wishlistId, $sellerId);
    $ok = mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $ok && $affected > 0;
}

function wishlist_list_seller($conn, $sellerId) {
    $sql = "SELECT w.id AS wid, vp.id AS vpid, vp.name, vp.price, vp.return_policy, u.name AS vendor_name
            FROM wishlist w
            JOIN vendor_products vp ON w.vendor_product_id = vp.id
            JOIN users u ON vp.vendor_id = u.id
            WHERE w.seller_id = ? ORDER BY w.id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
