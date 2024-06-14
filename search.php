<?php
session_start();
include 'config.php'; // Pastikan path ke file config.php sudah benar

// Pastikan variabel $conn sudah terdefinisi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil query pencarian dari URL jika ada
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Query untuk mencari data kost berdasarkan nama lokasi/area/alamat
$query = mysqli_query($conn, "SELECT kost.*, kategori.nama AS nama_kategori 
                              FROM kost 
                              INNER JOIN kategori ON kost.kategori = kategori.id 
                              WHERE kost.alamat LIKE '%$searchQuery%' 
                                 OR kost.nama_kost LIKE '%$searchQuery%' 
                                 OR kategori.nama LIKE '%$searchQuery%'");

// Cek apakah query berhasil
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="" href="Logoikost.php">
    <title>Hasil Pencarian - Ikost</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="main-nav">
            <div class="logo">
                <a href="index.php"><img src="Logoikost.png" alt="Logo"></a>
            </div>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Masukan nama lokasi/area/alamat" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">Cari</button>
            </form>
            <div class="nav-links">
                <a href="#">Cari Apa?</a>
                <a href="pusatbantuan.php">Pusat Bantuan</a>
                <a href="loginn.php">Tambah Kosan</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="result-cards">
            <?php if (mysqli_num_rows($query) > 0) { ?>
                <?php while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="card">
                        <img src="uploads/<?php echo $data['gambar']; ?>" alt="<?php echo $data['nama_kost']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama_kost']; ?></h5>
                            <p class="card-text"><strong>Alamat:</strong> <?php echo $data['alamat']; ?></p>
                            <p class="card-text"><strong>Harga: Rp.</strong> <?php echo $data['harga']; ?></p>
                            <a href="detailkos.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Tidak ada hasil ditemukan untuk pencarian: <strong><?php echo htmlspecialchars($searchQuery); ?></strong></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
