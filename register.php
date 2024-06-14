<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 0; // 0 untuk user biasa

    $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$password', '$role')";

    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register i-Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginn.css">
</head>
<body>
<div class="form-container">
    <form action="register.php" method="POST">
        <div class="logo">
            <img src="logo.jpg" alt="Logo">
        </div>
        <h4>Register i-Kos</h4>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingEmail" placeholder="Email" name="email" required>
            <label for="floatingUsername">Email</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
            <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Pass  word" name="password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
