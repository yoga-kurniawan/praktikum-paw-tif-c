<?php
session_start();

if (!isset($_SESSION["loggedin"]) || ($_SESSION["role"] !== "admin" && $_SESSION["role"] !== "member")) {
    $_SESSION["error_msg"] = "Akses Ditolak! Halaman B hanya untuk Admin & Member.";
    header("location: dashboard.php");
    exit;
} 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman B - Admin & Member</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 { color: #333; }
        p { color: #666; margin-bottom: 25px; }
        .btn-back {
            text-decoration: none;
            color: #555;
            font-size: 14px;
            border: 1px solid #ccc;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-back:hover { background: #eee; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman B</h1>
        <p>Selamat datang, <b>Admin & Member</b>. Ini adalah halaman bisa diakses oleh level Admin dan Member.</p>
        <a href="dashboard.php" class="btn-back"> Kembali ke Dashboard</a>
    </div>
</body>
</html>