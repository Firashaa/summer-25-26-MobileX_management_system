<?php
// MODEL: vendor_products.

function vendor_product_count($conn, $vendorId) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS c FROM vendor_products WHERE vendor_id = ?");
    if (!$stmt) return 0;
    mysqli_stmt_bind_param($stmt, 'i', $vendorId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return (int)($row['c'] ?? 0);
}

function vendor_product_list($conn, $vendorId) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, price, return_policy, created_at FROM vendor_products WHERE vendor_id = ? ORDER BY id DESC");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $vendorId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function vendor_product_create($conn, $vendorId, $name, $price) {
    $stmt = mysqli_prepare($conn, "INSERT INTO vendor_products (vendor_id, name, price) VALUES (?, ?, ?)");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'isd', $vendorId, $name, $price);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function vendor_product_update_price($conn, $vendorId, $productId, $price) {
    $stmt = mysqli_prepare($conn, "UPDATE vendor_products SET price = ? WHERE id = ? AND vendor_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'dii', $price, $productId, $vendorId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function vendor_product_delete($conn, $vendorId, $productId) {
    $stmt = mysqli_prepare($conn, "DELETE FROM vendor_products WHERE id = ? AND vendor_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ii', $productId, $vendorId);
    $ok = mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $ok && $affected > 0;
}

function vendor_product_update_policy($conn, $vendorId, $productId, $policy) {
    $stmt = mysqli_prepare($conn, "UPDATE vendor_products SET return_policy = ? WHERE id = ? AND vendor_id = ?");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'sii', $policy, $productId, $vendorId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function vendor_product_recent_all($conn, $limit = 20) {
    $limit = max(1, min(100, (int)$limit));
    $stmt = mysqli_prepare($conn, "SELECT vp.id, vp.name, vp.price, vp.return_policy, u.name AS vendor_name FROM vendor_products vp JOIN users u ON vp.vendor_id = u.id ORDER BY vp.id DESC LIMIT $limit");
    if (!$stmt) return [];
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
