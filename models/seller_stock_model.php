<?php
// MODEL: seller_stock table from shop_db. Kept separate from products.stock_qty.

function seller_stock_list($conn, $sellerId) {
    $stmt = mysqli_prepare($conn, "SELECT ss.id, ss.vendor_product_id, ss.qty, ss.cost_price, vp.name AS vendor_product_name FROM seller_stock ss LEFT JOIN vendor_products vp ON ss.vendor_product_id = vp.id WHERE ss.seller_id = ? ORDER BY ss.id DESC");
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, 'i', $sellerId);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function seller_stock_upsert($conn, $sellerId, $vendorProductId, $qty, $costPrice) {
    $stmt = mysqli_prepare($conn, "SELECT id FROM seller_stock WHERE seller_id = ? AND vendor_product_id = ? LIMIT 1");
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, 'ii', $sellerId, $vendorProductId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    if ($row) {
        $stmt = mysqli_prepare($conn, "UPDATE seller_stock SET qty = ?, cost_price = ? WHERE id = ?");
        if (!$stmt) return false;
        $id = (int)$row['id'];
        mysqli_stmt_bind_param($stmt, 'idi', $qty, $costPrice, $id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO seller_stock (seller_id, vendor_product_id, qty, cost_price) VALUES (?, ?, ?, ?)");
        if (!$stmt) return false;
        mysqli_stmt_bind_param($stmt, 'iiid', $sellerId, $vendorProductId, $qty, $costPrice);
    }
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}
