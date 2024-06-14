<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Admin i-Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="loginn.css">
</head>
<body>
<div class="form-container">
    <form method="POST">
        <div class="logo">
            <img src="logo.jpg" alt="Logo">
        </div>
        <h4>Chat Admin i-Kos</h4>
        <p class="subtitle">Sistem Informasi Kost<br>Penyedia Jasa Layanan Kost Online</p>
        
        <!-- Tombol WhatsApp -->
        <div class="d-grid gap-2 mb-3">
            <a href="https://wa.me/6281273466986" class="btn btn-success" target="_blank">
                Chat via WhatsApp
            </a>
        </div>

        <!-- Tombol Email -->
        <div class="d-grid gap-2 mb-3">
            <a href="mailto:akbar.baihaqi16@gmail.com?subject=Chat%20Admin%20i-Kos&body=Halo%20Admin,%0A%0ASaya%20ingin%20bertanya%20tentang%20layanan%20i-Kos." class="btn btn-primary" target="_blank">
                Chat via Email
            </a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+47DJ3Gz8nY3HTSO+nv0ks7a3GoII" crossorigin="anonymous"></script>
</body>
</html>