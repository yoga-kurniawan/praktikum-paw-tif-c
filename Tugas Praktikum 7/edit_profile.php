<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$success_msg = "";
$err_msg = "";
$current_username = $_SESSION["username"];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $current_username]);
$user = $stmt->fetch();

if (!$user) {
    die("User tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST["username"]);
    $new_email    = trim($_POST["email"]);

    if (empty($new_username) || empty($new_email)) {
        $err_msg = "Semua kolom harus diisi!";
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE (username = :new_user OR email = :new_email) AND username != :current_user");
            $stmt->execute(['new_user' => $new_username, 'new_email' => $new_email,'current_user' => $current_username]);

            if ($stmt->rowCount() > 0) {
                $err_msg = "Username atau Email sudah digunakan orang lain!";
            } else {
                $stmt = $conn->prepare("UPDATE users SET username = :username, email = :email WHERE username = :old_username");
                $stmt->execute(['username' => $new_username, 'email' => $new_email, 'old_username' => $current_username]);

                $_SESSION["username"] = $new_username;
                
                $success_msg = "Profil berhasil diperbarui!";
                $user['username'] = $new_username;
                $user['email'] = $new_email;
            }
        } catch (PDOException $e) {
            $err_msg = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Akun</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .edit-card { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        .edit-card h2 { text-align: center; color: #555; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 14px; margin-bottom: 8px; color: #666; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-save { width: 100%; padding: 12px; background: #555; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .message { padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; text-align: center; }
        .error { background: #fdecea; color: #d9534f; border: 1px solid #f5c6cb; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .back-link { display: block; text-align: center; margin-top: 20px; font-size: 14px; color: #777; text-decoration: none; }
    </style>
</head>
<body>
    <div class="edit-card">
        <h2>EDIT PROFIL</h2>
        <?php if ($err_msg): ?>
            <div class="message error"><?php echo $err_msg; ?></div>
        <?php endif; ?>
        <?php if ($success_msg): ?>
            <div class="message success"><?php echo $success_msg; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
        <a href="dashboard.php" class="back-link"> Kembali ke Dashboard</a>
    </div>
</body>
</html>