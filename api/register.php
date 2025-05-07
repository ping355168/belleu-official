<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 引入資料庫連線設定（PostgreSQL）
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

// 驗證 email 格式
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email 格式錯誤']);
    exit;
}

// 驗證密碼強度（可自定義更嚴格）
if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => '密碼至少需要 6 個字元']);
    exit;
}

try {
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
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '註冊失敗：' . $e->getMessage()]);
}
