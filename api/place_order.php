<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

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
// 開啟錯誤顯示以除錯（上線後記得關掉）
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 抓取 JSON
    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input || !isset($input['name'], $input['phone'], $input['address'], $input['items'])) {
        echo json_encode(['error' => 'Missing order data']);
        exit;
    }

    // 1. 插入 orders
    $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$input['name'], $input['phone'], $input['address']]);
    $orderId = $pdo->lastInsertId();

    // 2. 插入 order_items
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, name, size, color, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($input['items'] as $item) {
        $stmt->execute([
            $orderId,
            $item['id'],
            $item['name'],
            $item['selectedSize'],
            $item['selectedColor'],
            $item['quantity'],
            $item['price']
        ]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
