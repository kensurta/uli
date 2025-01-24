<?php include 'assets/resource/header.php'; ?>

    <div class="container mt-4">
        <?php
        // Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Fetch ENUM values for metode and via
        $metodeEnumValues = [];
        $viaEnumValues = [];

        $resultMetode = mysqli_query($skon, "SHOW COLUMNS FROM tagihan LIKE 'metode'");
        $rowMetode = mysqli_fetch_array($resultMetode, MYSQLI_ASSOC);
        if (preg_match('/^enum\((.*)\)$/', $rowMetode['Type'], $matches)) {
            $metodeEnumValues = explode(',', str_replace("'", "", $matches[1]));
        }

        $resultVia = mysqli_query($skon, "SHOW COLUMNS FROM tagihan LIKE 'via'");
        $rowVia = mysqli_fetch_array($resultVia, MYSQLI_ASSOC);
        if (preg_match('/^enum\((.*)\)$/', $rowVia['Type'], $matches)) {
            $viaEnumValues = explode(',', str_replace("'", "", $matches[1]));
        }

        // Fetch data for dropdowns from mahasiswa table
        $nama_options = mysqli_query($skon, "SELECT DISTINCT nama FROM mahasiswa");
        $jurusan_options = mysqli_query($skon, "SELECT DISTINCT jurusan FROM mahasiswa");
        $semester_options = mysqli_query($skon, "SELECT DISTINCT semester FROM mahasiswa UNION SELECT DISTINCT semester FROM tagihan");

        // Fetch data to be updated based on ID
        if (isset($_GET['id_tagihan'])) {
            $id_tagihan = input($_GET['id_tagihan']);
            $result = mysqli_query($skon, "SELECT * FROM tagihan WHERE id_tagihan='$id_tagihan'");
            $row = mysqli_fetch_assoc($result);
        }

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_tagihan = input($_POST["id_tagihan"]);
            $nama = input($_POST["nama"]);
            $jurusan = input($_POST["jurusan"]);
            $semester = input($_POST["semester"]);
            $jumlah_tagihan = input($_POST["jumlah_tagihan"]);
            $metode = input($_POST["metode"]);
            $via = input($_POST["via"]);

            // Query untuk mengupdate data ke tabel tagihan
            $sql = "UPDATE tagihan SET nama='$nama', jurusan='$jurusan', semester='$semester', jumlah_tagihan='$jumlah_tagihan', metode='$metode', via='$via' WHERE id_tagihan='$id_tagihan'";

            // Mengeksekusi query di atas
            $hasil = mysqli_query($skon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                header("Location:tagihan.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal diupdate.</div>";
            }
        }
        ?>

        <h2>Update Tagihan</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_tagihan" value="<?php echo $row['id_tagihan']; ?>" />
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <select name="nama" class="form-select" required>
                    <option value="">Pilih Nama</option>
                    <?php while ($option = mysqli_fetch_assoc($nama_options)) { ?>
                        <option value="<?php echo htmlspecialchars($option['nama']); ?>" <?php if ($option['nama'] == $row['nama']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['nama']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan:</label>
                <select name="jurusan" class="form-select" required>
                    <option value="">Pilih Jurusan</option>
                    <?php while ($option = mysqli_fetch_assoc($jurusan_options)) { ?>
                        <option value="<?php echo htmlspecialchars($option['jurusan']); ?>" <?php if ($option['jurusan'] == $row['jurusan']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['jurusan']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Semester:</label>
                <select name="semester" class="form-select" required>
                    <option value="">Pilih Semester</option>
                    <?php while ($option = mysqli_fetch_assoc($semester_options)) { ?>
                        <option value="<?php echo htmlspecialchars($option['semester']); ?>" <?php if ($option['semester'] == $row['semester']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['semester']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Tagihan:</label>
                <input type="number" step="0.01" name="jumlah_tagihan" class="form-control" value="<?php echo $row['jumlah_tagihan']; ?>" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Metode:</label>
                <select name="metode" class="form-select" required>
                    <option value="">Pilih Metode</option>
                    <?php foreach ($metodeEnumValues as $value) { ?>
                        <option value="<?php echo $value; ?>" <?php if ($value == $row['metode']) echo 'selected'; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Via:</label>
                <select name="via" class="form-select" required>
                    <option value="">Pilih Via</option>
                    <?php foreach ($viaEnumValues as $value) { ?>
                        <option value="<?php echo $value; ?>" <?php if ($value == $row['via']) echo 'selected'; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

<?php include 'assets/resource/footer.php'; ?>
