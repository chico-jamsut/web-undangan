<?php
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if ($password !== $confirm) {
    $error = "Password tidak cocok.";
  } else {
    $check = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
      $error = "Username sudah digunakan.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
      $stmt->bind_param("ss", $username, $hashed);

      if ($stmt->execute()) {
        $success = "Pendaftaran berhasil! Silakan login.";
      } else {
        $error = "Gagal menyimpan data.";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Klub Motor</title>
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
    }

    .register-box {
      background-color: #1c1c1c;
      padding: 2rem;
      border-radius: 12px;
      width: 100%;
      max-width: 360px;
      box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
      text-align: center;
    }

    .register-box img {
      width: 80px;
      margin-bottom: 1rem;
    }

    .register-box h2 {
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

    .error-msg, .success-msg {
      padding: 0.5rem;
      border-radius: 6px;
      margin-bottom: 1rem;
      font-size: 14px;
    }

    .error-msg {
      background-color: #ffdddd;
      color: #990000;
    }

    .success-msg {
      background-color: #ddffdd;
      color: #008800;
    }

    .login-link {
      font-size: 14px;
      margin-top: 1rem;
    }

    .login-link a {
      color: #ff2d2d;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <center><img src="./public/logo.png" alt="Logo RADI"></center>
    <h2>Daftar Akun</h2>

    <?php if ($error): ?>
      <div class="error-msg"><?= $error ?></div>
    <?php elseif ($success): ?>
      <div class="success-msg"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" class="form-input" placeholder="Username" required>
      <input type="password" name="password" class="form-input" placeholder="Password" required>
      <input type="password" name="confirm" class="form-input" placeholder="Konfirmasi Password" required>
      <button type="submit" class="form-button">Daftar</button>
    </form>

    <div class="login-link">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
  </div>

</body>
</html>
