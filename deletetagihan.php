<?php
include "koneksi.php"; // Include your database connection file

if (isset($_GET['id_tagihan'])) {
    $id_tagihan = htmlspecialchars($_GET["id_tagihan"]);

    // SQL query to delete the record
    $sql = "DELETE FROM tagihan WHERE id_tagihan='$id_tagihan'";
    $hasil = mysqli_query($skon, $sql);

    // Check if the deletion was successful
    if ($hasil) {
        header("Location: tagihan.php");
    } else {
        echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
    }
}
?>
