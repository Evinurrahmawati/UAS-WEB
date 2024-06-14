<?php
session_start();
include 'config.php'; // Pastikan path ke file config.php sudah benar

// Pastikan variabel $conn sudah terdefinisi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query untuk mendapatkan data dari tabel kost dengan nama kategori
$query = mysqli_query($conn, "SELECT kost.*, kategori.nama AS nama_kategori FROM kost INNER JOIN kategori ON kost.kategori = kategori.id");

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
    <link rel="shortcut icon" type="image/x-icon" href="Logoikost.png">
    <title>Ikost</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="main-nav">
            <div class="logo">
                <a href="#"><img src="Logoikost.png" alt="Logo"></a>
            </div>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Masukan nama lokasi/area/alamat" class="form-control">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <div class="nav-links">
                <a href="search.php">Cari Apa?</a>
                <a href="pusatbantuan.php">Pusat Bantuan</a>
                <a href="loginn.php">Login</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="top-section">
            <div class="map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3453545010498!2d105.2403223745202!3d-5.364175853679453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c5f60802221d%3A0xac5d5819e12c9bcf!2sUniversitas%20Lampung%20(UNILA)!5e0!3m2!1sid!2sid!4v1717305231857!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="result-cards">
                <?php while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="card" style="width: 18rem; margin: 10px;">
                        <img src="uploads/<?php echo $data['gambar']; ?>" class="card-img-top" alt="<?php echo $data['nama_kost']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama_kost']; ?></h5>
                            <p class="card-text"><strong>Alamat:</strong> <?php echo $data['alamat']; ?></p>
                            <p class="card-text"><strong>Harga: Rp.</strong> <?php echo $data['harga']; ?></p>
                            <a href="detailkos.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>