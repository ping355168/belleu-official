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
} catch (Exception $e) {
    die('資料庫連線錯誤：' . $e->getMessage());
}



$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'No product ID provided']);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 取得商品主資料
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if (!$product) {
        echo json_encode(['error' => 'Product not found']);
        exit;
    }

    // 取得圖片
    $stmt = $pdo->prepare("SELECT image_url, is_main FROM product_images WHERE product_id = ?");
    $stmt->execute([$id]);
    $product['images'] = $stmt->fetchAll();

    // 取得尺寸
    $stmt = $pdo->prepare("SELECT size FROM product_sizes WHERE product_id = ?");
    $stmt->execute([$id]);
    $product['sizes'] = array_column($stmt->fetchAll(), 'size');

    // 取得顏色
    $stmt = $pdo->prepare("SELECT color_name, color_code FROM product_colors WHERE product_id = ?");
    $stmt->execute([$id]);
    $product['colors'] = $stmt->fetchAll();

    echo json_encode($product);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
