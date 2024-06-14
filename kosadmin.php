<?php
session_start();
include 'config.php'; // Pastikan path ke file config.php sudah benar

// Pastikan variabel $conn sudah terdefinisi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query untuk mendapatkan data dari tabel kategori
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

$errors = [];
if (isset($_POST['Simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $pemilik = htmlspecialchars($_POST['pemilik']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $harga = htmlspecialchars($_POST['harga']);
    $detail = htmlspecialchars($_POST['detail']);
    $nomor_whatsapp = htmlspecialchars($_POST['nomor_whatsapp']);
    $google_maps_link = htmlspecialchars($_POST['google_maps_link']);
    $status = htmlspecialchars($_POST['status']);
    
    $target_dir = "uploads/";
    $nama_file = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $nama_file;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_size = $_FILES["foto"]["size"];

    // Validasi input
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }
    if (empty($kategori)) {
        $errors[] = "Kategori harus dipilih.";
    }
    if (empty($pemilik)) {
        $errors[] = "Pemilik harus diisi.";
    }
    if (empty($alamat)) {
        $errors[] = "Alamat harus diisi.";
    }
    if (empty($harga)) {
        $errors[] = "Harga harus diisi.";
    }
    if (empty($nama_file)) {
        $errors[] = "Foto harus diupload.";
    }
    if (empty($nomor_whatsapp)) {
        $errors[] = "Nomor WhatsApp harus diisi.";
    }
    if (empty($google_maps_link)) {
        $errors[] = "Link Google Maps harus diisi.";
    }
    if (empty($status)) {
        $errors[] = "Status harus dipilih.";
    }

    // Jika tidak ada error, lakukan penyimpanan data ke database
    if (count($errors) == 0) {
        // Pindahkan file yang diupload ke folder uploads
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO kost (nama_kost, kategori, pemilik, alamat, harga, gambar, detail, nomor_whatsapp, google_maps_link, status) VALUES ('$nama', '$kategori', '$pemilik', '$alamat', '$harga', '$nama_file', '$detail', '$nomor_whatsapp', '$google_maps_link', '$status')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Data berhasil disimpan.";
                header("Location: daftarkos.php"); // Redirect to daftar kos page
                exit();
            } else {
                $errors[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="" href="Logoikost.php">
    <title>Tambah Kost</title>
    <link rel="stylesheet" type="text/css" href="kosadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../fontawesome/css/fontawesome.min.css" rel="stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        <?php if (isset($_SESSION['success'])) { ?>
            alert('<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>');
        <?php } ?>
    </script>
    
    <!-- HEADER -->
    <header>
        <div class="main-nav">
            <div class="logo">
                <a href="#"><img src="Logoikost.png" alt="Logo"></a>
            </div>
            
            <div class="nav-links">
                <a href="daftarkos.php">Kost</a>
                <a href="index.php">Kembali</a>
            </div>
        </div>
    </header>

    <div class="container my-5 col-12 col-md-8">
        <h2>Tambah Kost</h2>
        <?php if (count($errors) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) {
                    echo $error . "<br>";
                } ?>
            </div>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php while($data = mysqli_fetch_array($queryKategori)) { ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pemilik" class="form-label">Pemilik</label>
                <input type="text" id="pemilik" name="pemilik" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" id="foto" name="foto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="nomor_whatsapp" class="form-label">Nomor WhatsApp</label>
                <input type="text" id="nomor_whatsapp" name="nomor_whatsapp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="google_maps_link" class="form-label">Link Google Maps</label>
                <input type="text" id="google_maps_link" name="google_maps_link" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Pilih Status</option>
                    <option value="Penuh">Penuh</option>
                    <option value="Tersedia">Tersedia</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="Simpan">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

