<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    'user_name' => $_SESSION['user_name'] ?? null,
]);
?>
