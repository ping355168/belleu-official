<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$db = 'belleu';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();

    foreach ($products as &$product) {
        $id = $product['id'];

        // 取得圖片
        $imgStmt = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? ORDER BY is_main DESC, id ASC LIMIT 2");
        $imgStmt->execute([$id]);
        $images = $imgStmt->fetchAll();

        $product['image'] = $images[0]['image_url'] ?? '';
        $product['hoverImage'] = $images[1]['image_url'] ?? $product['image'];

        // ✅ 取得尺寸
        $sizeStmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
        $sizeStmt->execute([$id]);
        $product['sizes'] = array_column($sizeStmt->fetchAll(), 'size');

        // ✅ 取得顏色
        $colorStmt = $pdo->prepare("SELECT color_name, color_code FROM product_colors WHERE product_id = ?");
        $colorStmt->execute([$id]);
        $product['colors'] = $colorStmt->fetchAll();
    }


    echo json_encode($products);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
