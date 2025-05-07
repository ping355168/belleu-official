<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// 資料庫連線
require_once __DIR__ . '/../config/database.php';

// 接收 JSON 請求
$data = json_decode(file_get_contents('php://input'), true);
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

// 基本驗證
if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => '請填寫所有欄位']);
    exit;
}

// 檢查 email 是否已存在
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Email 已被註冊']);
    exit;
}

// 儲存加密密碼
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$insert = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$success = $insert->execute([$email, $hashedPassword]);

echo json_encode(['success' => $success]);
