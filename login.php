<?php
session_start();
// Kalau sudah login, langsung lempar ke halaman admin
if (isset($_SESSION['user'])) {
  header("Location: admin.php");
  exit;
}
include 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitasi input
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute(); 
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Username atau password salah.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Klub Motor</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style/output.css">
  <style>
    body {
      background-color: #0f0f0f;
      font-family: 'Bebas Neue', sans-serif;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background-color: #1c1c1c;
      padding: 2rem;
      border-radius: 12px;
      width: 100%;
      max-width: 360px;
      box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
      text-align: center;
    }

    .login-box img {
      width: 80px;
      margin-bottom: 1rem;
    }

    .login-box h2 {
      font-size: 32px;
      color: #ff2d2d;
      margin-bottom: 1.5rem;
    }

    .form-input {
      background-color: #2a2a2a;
      border: none;
      padding: 0.75rem;
      width: 100%;
      margin-bottom: 1rem;
      border-radius: 6px;
      color: #fff;
    }

    .form-button {
      width: 100%;
      padding: 0.75rem;
      background-color: #ff2d2d;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      color: white;
      cursor: pointer;
      transition: background 0.3s;
    }

    .form-button:hover {
      background-color: #e60000;
    }

    .error-msg {
      background-color: #ffdddd;
      color: #990000;
      padding: 0.5rem;
      border-radius: 6px;
      margin-bottom: 1rem;
      font-size: 14px;
    }

    .register-link {
      font-size: 14px;
      margin-top: 1rem;
    }

    .register-link a {
      color: #ff2d2d;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <center><img src="./public/logo.png" alt="Logo"></center>
    <h2>Login Admin</h2>

    <?php if ($error): ?>
      <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" class="form-input" placeholder="Username" required autofocus>
      <input type="password" name="password" class="form-input" placeholder="Password" required>
      <button type="submit" class="form-button">Masuk</button>
    </form>

    <div class="register-link">
      Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
  </div>

</body>
</html>
