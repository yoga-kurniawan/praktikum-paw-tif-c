<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$error="";
$username = $_SESSION["username"];

if (isset($_SESSION["error_msg"])) {
    $error = $_SESSION["error_msg"];
    unset($_SESSION["error_msg"]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 400px;
            text-align: center;
        }
        h2 { color: #333; margin-bottom: 5px; }
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn {
            text-decoration: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: block;
            font-size: 15px;
        }
        .btn-edit { 
            background-color: #555; 
            color: white; 
        }
        .btn-delete { 
            border: 2px solid #d9534f; 
            color: #d9534f; 
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-edit:hover { background-color: #333; }
        .btn-delete:hover { background-color: #d9534f; color: white; }

        .logout-link {
            display: inline-block;
            margin-top: 25px;
            color: #888;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-link:hover { color: #333; text-decoration: underline; }
        
        .error-message {
            background-color: #fdecea; 
            color: #d9534f;          
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <h2>Halo, <?php echo htmlspecialchars($username); ?>!</h2>
        <?php if ($error): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <div class="button-group">
            <a href="edit_profile.php" class="btn btn-edit">Edit Profil Akun</a>
            <form action="delete_account.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak bisa dibatalkan.')">
                <button type="submit" class="btn btn-delete" style="width: 100%; cursor: pointer;">Hapus Akun Saya</button>
            </form>
        </div>
        <a href="logout.php" class="logout-link">Keluar Sistem</a>
    </div>
</body>
</html>