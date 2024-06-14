<?php
session_start();
include 'config.php'; // Ensure the path to config.php is correct

// Ensure the $conn variable is defined
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the ID from the query string
$id = $_GET['id'];

// Delete the kost from the database
$sql = "DELETE FROM kost WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "Kost berhasil dihapus.";
    header("Location: daftarkos.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
