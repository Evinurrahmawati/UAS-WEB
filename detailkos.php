<?php
session_start();
include 'config.php'; // Pastikan path ke file config.php sudah benar

// Pastikan variabel $conn sudah terdefinisi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mendapatkan ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan data detail kos berdasarkan ID
$query = mysqli_query($conn, "SELECT kost.*, kategori.nama AS nama_kategori FROM kost INNER JOIN kategori ON kost.kategori = kategori.id WHERE kost.id = $id");
$data = mysqli_fetch_array($query);

if (!$data) {
    die("Data tidak ditemukan!");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="" href="Logoikost.php">
    <title>Ikost</title>
    <link rel="stylesheet" type="text/css" href="detailkos.css">
</head>
<body>
<!-- HEADER -->
<header>
    <div class="main-nav">
        <div class="logo">
            <a href="#"><img src="Logoikost.png" alt="Logo"></a>
        </div>
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Masukan nama lokasi/area/alamat">
            <button type="submit">Cari</button>
        </form>
        <div class="nav-links">
            <a href="index.php">Cari Kost</a>
            <a href="login.php">Logout</a>
        </div>
    </div>
</header>

<div class="container my-5">
    <div class="center-tampilan">
        <img src="uploads/<?php echo htmlspecialchars($data['gambar']); ?>" alt="<?php echo htmlspecialchars($data['nama_kost']); ?>">
        <div class="deskripsi">
            <h3><?php echo htmlspecialchars($data['nama_kost']); ?></h3>
            <p><strong>Harga:</strong> <?php echo htmlspecialchars($data['harga']); ?></p>
            <p><strong>Kategori:</strong> <?php echo htmlspecialchars($data['nama_kategori']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat']); ?></p>
            <p><strong>Pemilik:</strong> <?php echo htmlspecialchars($data['pemilik']); ?></p>
            <p><strong>Detail:</strong> <?php echo htmlspecialchars($data['detail']); ?></p>
            <p><strong>Lokasi:</strong> <a href="<?php echo htmlspecialchars($data['google_maps_link']); ?>" target="_blank">Lihat di Google Maps</a></p>

            <div class="btn-group">
                <a href="index.php" class="button">Kembali</a>
                <a href="https://wa.me/<?php echo htmlspecialchars($data['nomor_whatsapp']); ?>" target="_blank" class="button2">Pesan</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
