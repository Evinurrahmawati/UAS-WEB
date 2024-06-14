<?php
session_start();
include 'config.php'; // Pastikan path ke file config.php sudah benar

// Pastikan variabel $conn sudah terdefinisi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query untuk mendapatkan data dari tabel kost dengan nama kategori
$query = mysqli_query($conn, "SELECT kost.*, kategori.nama AS nama_kategori FROM kost INNER JOIN kategori ON kost.kategori = kategori.id");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="" href="Logoikost.php">
    <title>Daftar Kost</title>
    <link rel="stylesheet" type="text/css" href="kosadmin.css">
    <link rel="stylesheet" type="text/css" href="kostadmin.css"> <!-- Tambahkan baris ini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../fontawesome/css/fontawesome.min.css" rel="stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- HEADER -->
    <header>
        <div class="main-nav">
            <div class="logo">
                <a href="#"><img src="Logoikost.png" alt="Logo"></a>
            </div>
            
            <div class="nav-links">
                <a href="kosadmin.php">Tambah Kost</a>
                <a href="index.php">Kembali</a>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <h2>Daftar Kost</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Pemilik</th>
                    <th>Alamat</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Detail</th>
                    <th>Nomor WhatsApp</th>
                    <th>Google Maps</th>
                    <th>Aksi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_kost']; ?></td>
                        <td><?php echo $data['nama_kategori']; ?></td>
                        <td><?php echo $data['pemilik']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['harga']; ?></td>
                        <td><img src="uploads/<?php echo $data['gambar']; ?>" alt="Gambar Kost" class="kost-image"></td>
                        <td><?php echo $data['detail']; ?></td>
                        <td><?php echo $data['nomor_whatsapp']; ?></td>
                        <td><a href="<?php echo $data['google_maps_link']; ?>" target="_blank">Lihat di Google Maps</a></td>
                        <td>
                            <a href="update_kost.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_kost.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                        <td><?php echo $data['status']; ?></td> <!-- Display the status -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
