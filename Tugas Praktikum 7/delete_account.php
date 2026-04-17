<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];

try {
    $stmt = $conn->prepare("DELETE FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    session_unset();
    session_destroy();

    session_start();
    $_SESSION['success_msg'] = "Akun Anda telah berhasil dihapus.";
    header("location: login.php");
    exit;
} catch (PDOException $e) {
    $_SESSION["error_msg"] = "Gagal menghapus akun: " . $e->getMessage();
    header("location: dashboard.php");
    exit;
}
?>