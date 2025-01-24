<?php
include "koneksi.php"; // Include your database connection file

if (isset($_GET['id_mahasiswa'])) {
    $id_mahasiswa = htmlspecialchars($_GET["id_mahasiswa"]);

    // SQL query to delete the record
    $sql = "DELETE FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'";
    $hasil = mysqli_query($skon, $sql);

    // Check if the deletion was successful
    if ($hasil) {
        header("Location: mahasiswa.php");
    } else {
        echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
    }
}
?>
