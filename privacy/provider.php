<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__.'/../../config.php';

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['token'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Token required']);
    exit;
}

$token = sanitizeInput($input['token']);

// Implementasi validasi token sesuai kebutuhan sistem
// Contoh validasi sederhana:
try {
    // Rate limiting
    session_start();
    $ip = $_SERVER['REMOTE_ADDR'];
    $requestCount = $_SESSION[$ip] ?? 0;

    if ($requestCount > 10) {
        http_response_code(429);
        echo json_encode(['error' => 'Too many requests']);
        exit;
    }

    $_SESSION[$ip] = $requestCount + 1;

    // Validasi token
    $validation = validateToken($token);

    if (!$validation['valid']) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid token', 'detail' => $validation['error']]);
        exit;
    }

    // Database interaction dengan prepared statement
    $conn = secureDBConnection();
    $stmt = $conn->prepare('SELECT * FROM tokens WHERE token = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Token tidak terdaftar');
    }

    echo json_encode(['status' => 'success', 'message' => 'Token valid']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: '.$e->getMessage()]);
} finally {
    $conn->close();
}
