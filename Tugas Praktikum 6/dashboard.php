<?php
session_start();

$error = "";

if (isset($_SESSION["error_msg"])) {
    $error = $_SESSION["error_msg"];
    unset($_SESSION["error_msg"]);
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
$role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        h2 { color: #333; margin-bottom: 5px; }
        .role-badge {
            display: inline-block;
            padding: 5px 12px;
            background-color: #e9ecef;
            color: #555;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .btn {
            text-decoration: none;
            padding: 15px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: block;
        }
        .btn-a { background-color: #555; color: white; }
        .btn-b { background-color: #888; color: white; } 
        .btn-c { border: 2px solid #ddd; color: #555; }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            opacity: 0.9;
        }
        .logout-link {
            display: inline-block;
            margin-top: 25px;
            color: #d9534f;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-link:hover { text-decoration: underline; }
        .error-message {
            background-color: #fdecea; 
            color: #d9534f;          
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
    <h2>Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h2>
    <div class="role-badge">Role: <?php echo $role; ?></div>
    <?php if ($error): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <div class="button-group">
        <a href="halaman_a.php" class="btn btn-a">Ke Halaman A (Khusus Admin)</a>
        <a href="halaman_b.php" class="btn btn-b">Ke Halaman B (Admin & Member)</a>
        <a href="halaman_c.php" class="btn btn-c">Ke Halaman C (Umum)</a>
    </div>
    <a href="logout.php" class="logout-link">Keluar dari Sistem</a>
    </div>
</body>
</html>