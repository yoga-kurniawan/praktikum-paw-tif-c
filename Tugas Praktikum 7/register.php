<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin'] == true){
    header("location: dashboard.php");
    exit;
} 

require_once 'config.php';

$err_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_input = $_POST['password'];

    if (empty($username) || empty($email) || empty($password_input)){
        $err_msg = 'Semua kolom harus diisi';
    } else {
        $password = password_hash($password_input, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);

        if($stmt->rowCount() > 0){
            $err_msg = "Username atau email telah digunakan";
        } else {
            $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
            if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $password])) {
                $_SESSION['success_msg'] = "Registrasi berhasil! Silakan login.";
                header("Location: login.php"); 
                exit();
            } else {
                $err_msg = "Terjadi kesalahan sistem.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .register-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }
        .register-card h2 {
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
            color: #555;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #aaa;
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-register:hover {
            background-color: #333;
        }
        .error-message {
            background-color: #fdecea;
            color: #d9534f;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2>DAFTAR</h2>
        <?php if ($err_msg): ?>
            <div class="error-message">
                <?php echo $err_msg; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username baru" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email aktif" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>
        <a href="login.php" class="login-link">Sudah punya akun? Login</a>
    </div>
</body>
</html>