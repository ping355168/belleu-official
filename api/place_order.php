<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 引入 PostgreSQL 的資料庫設定
require_once __DIR__ . '/../config/database.php';

// 顯示錯誤除錯（上線前記得關掉）
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // 抓取 JSON
    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input || !isset($input['name'], $input['phone'], $input['address'], $input['items'])) {
        echo json_encode(['error' => 'Missing order data']);
        exit;
    }

    // 1. 插入 orders（注意 total 欄位預設為 NULL 或後續補計算）
    $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$input['name'], $input['phone'], $input['address']]);

    // PostgreSQL 的 lastInsertId 要加序列名稱
    $orderId = $pdo->lastInsertId('orders_id_seq');

    // 2. 插入 order_items（欄位名稱請對應 PostgreSQL 的設計）
    $stmt = $pdo->prepare("
        INSERT INTO order_items 
        (order_id, product_id, product_name, selected_size, selected_color, quantity, price) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

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
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
