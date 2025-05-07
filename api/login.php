<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

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

// 取得前端傳來的資料
$data = json_decode(file_get_contents('php://input'), true);
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

// 基本檢查
if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => '請填寫帳號與密碼']);
    exit;
}

// 查詢使用者
$stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => '帳號或密碼錯誤']);
    exit;
}

// 登入成功，回傳 user 資料（可擴充 nickname、role 等）
echo json_encode([
    'success' => true,
    'user' => [
        'id' => $user['id'],
        'email' => $user['email']
    ]
]);
