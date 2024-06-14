<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 1) { // 1 indicates admin
            header("Location: daftarkos.php");
        } else { // 0 or any other value indicates user
            header("Location: indexuser.php");
        }
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login i-Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="loginn.css">
</head>
<body>
<div class="form-container">
    <form method="POST">
        <div class="logo">
            <img src="logo.jpg" alt="Logo">
        </div>
        <h4>Login i-Kos</h4>
        <p class="subtitle">Sistem Informasi Kost<br>Penyedia Jasa Layanan Kost Online</p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
            <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
        <p class="mt-3"><a href="register.php">Daftar / Buat Akun ?</a></p>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+47DJ3Gz8nY3HTSO+nv0ks7a3GoII" crossorigin="anonymous"></script>
</body>
</html>
