<?php
session_start();
include 'config.php'; // Ensure the path to config.php is correct

// Ensure the $conn variable is defined
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'id' is set in $_GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer
    // echo "ID received: " . $id . "<br>"; // Debugging line

    // Fetch data for the selected kost
    $query = mysqli_query($conn, "SELECT * FROM kost WHERE id = $id");

    // Check if query was successful
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
    } else {
        die("Data not found or query failed: " . mysqli_error($conn));
    }

    // Query for category data
    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

    $errors = [];
    if (isset($_POST['Update'])) {
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

        // Validation
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
        if (empty($nomor_whatsapp)) {
            $errors[] = "Nomor WhatsApp harus diisi.";
        }
        if (empty($google_maps_link)) {
            $errors[] = "Link Google Maps harus diisi.";
        }

        // Update data
        if (count($errors) == 0) {
            $sql = "UPDATE kost SET nama_kost='$nama', kategori='$kategori', pemilik='$pemilik', alamat='$alamat', harga='$harga', detail='$detail', nomor_whatsapp='$nomor_whatsapp', google_maps_link='$google_maps_link', status='$kstatus'";

            if (!empty($nama_file)) {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $sql .= ", gambar='$nama_file'";
                } else {
                    $errors[] = "Sorry, there was an error uploading your file.";
                }
            }

            $sql .= " WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                header("Location: daftarkos.php"); // Redirect to kosadmin.php after update
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
} else {
    die("ID parameter is missing.");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="" href="Logoikost.php">
    <title>Ikost</title>
    <link rel="stylesheet" type="text/css" href="kosadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: green;
        }
        .no_decoration {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="main-nav">
            <div class="logo">
                <a href="#"><img src="Logoikost.png" alt="Logo"></a>
            </div>
            
           
        </div>
    </header>

    <div class="container my-5 col-12 col-md-8">
        <h2>Update Kost</h2>
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
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama_kost']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php while($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <option value="<?php echo htmlspecialchars($kategori['id']); ?>" <?php if ($kategori['id'] == $data['kategori']) echo 'selected'; ?>><?php echo htmlspecialchars($kategori['nama']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pemilik" class="form-label">Pemilik</label>
                <input type="text" id="pemilik" name="pemilik" class="form-control" value="<?php echo htmlspecialchars($data['pemilik']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo htmlspecialchars($data['alamat']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($data['harga']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomor_whatsapp" class="form-label">Nomor WhatsApp</label>
                <input type="text" id="nomor_whatsapp" name="nomor_whatsapp" class="form-control" value="<?php echo htmlspecialchars($data['nomor_whatsapp']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="google_maps_link" class="form-label">Link Google Maps</label>
                <input type="text" id="google_maps_link" name="google_maps_link" class="form-control" value="<?php echo htmlspecialchars($data['google_maps_link']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" id="foto" name="foto" class="form-control">
                <img src="uploads/<?php echo htmlspecialchars($data['gambar']); ?>" width="100" class="mt-2">
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo htmlspecialchars($data['detail']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="">Pilih Status</option>
                    <option value="Penuh">Penuh</option>
                    <option value="Belum Penuh">Belum Penuh</option>
                </select>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="Update">Update</button>
            </div>
        </form>
    </div>
</body>
</html>