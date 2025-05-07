<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 引入資料庫連線設定
require_once __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();

    foreach ($products as &$product) {
        $id = $product['id'];

        // 取得主圖與 hover 圖（最多兩張）
        $imgStmt = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? ORDER BY is_main DESC, id ASC LIMIT 2");
        $imgStmt->execute([$id]);
        $images = $imgStmt->fetchAll();

        $product['image'] = $images[0]['image_url'] ?? '';
        $product['hoverImage'] = $images[1]['image_url'] ?? $product['image'];

        // 取得尺寸
        $sizeStmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
        $sizeStmt->execute([$id]);
        $product['sizes'] = array_column($sizeStmt->fetchAll(), 'size');

        // 取得顏色
        $colorStmt = $pdo->prepare("SELECT color_name, color_code FROM product_colors WHERE product_id = ?");
        $colorStmt->execute([$id]);
        $product['colors'] = $colorStmt->fetchAll();
    }

    echo json_encode($products);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
