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

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = input($_POST["nama"]);
            $jurusan = input($_POST["jurusan"]);
            $semester = input($_POST["semester"]);
            $jumlah_tagihan = input($_POST["jumlah_tagihan"]);
            $metode = input($_POST["metode"]);
            $via = input($_POST["via"]);

            // Query untuk menginput data ke tabel tagihan
            $sql = "INSERT INTO tagihan (nama, jurusan, semester, jumlah_tagihan, metode, via) VALUES ('$nama', '$jurusan', '$semester', '$jumlah_tagihan', '$metode', '$via')";

            // Mengeksekusi query di atas
            $hasil = mysqli_query($skon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger'>Data gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Input Tagihan</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <select name="nama" class="form-select" required>
                    <option value="">Pilih Nama</option>
                    <?php while ($row = mysqli_fetch_assoc($nama_options)) { ?>
                        <option value="<?php echo htmlspecialchars($row['nama']); ?>"><?php echo htmlspecialchars($row['nama']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan:</label>
                <select name="jurusan" class="form-select" required>
                    <option value="">Pilih Jurusan</option>
                    <?php while ($row = mysqli_fetch_assoc($jurusan_options)) { ?>
                        <option value="<?php echo htmlspecialchars($row['jurusan']); ?>"><?php echo htmlspecialchars($row['jurusan']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Semester:</label>
                <select name="semester" class="form-select" required>
                    <option value="">Pilih Semester</option>
                    <?php while ($row = mysqli_fetch_assoc($semester_options)) { ?>
                        <option value="<?php echo htmlspecialchars($row['semester']); ?>"><?php echo htmlspecialchars($row['semester']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Tagihan:</label>
                <input type="number" step="0.01" name="jumlah_tagihan" class="form-control" placeholder="Masukan Jumlah Tagihan" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Metode:</label>
                <select name="metode" class="form-select" required>
                    <option value="">Pilih Metode</option>
                    <?php foreach ($metodeEnumValues as $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Via:</label>
                <select name="via" class="form-select" required>
                    <option value="">Pilih Via</option>
                    <?php foreach ($viaEnumValues as $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-4">
        <h2>Data Tagihan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Tagihan</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Semester</th>
                    <th>Jumlah Tagihan</th>
                    <th>Metode</th>
                    <th>Via</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk menampilkan data tagihan
                $sql = "SELECT * FROM tagihan";
                $hasil = mysqli_query($skon, $sql);

                while ($data = mysqli_fetch_assoc($hasil)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($data['id_tagihan']) . "</td>
                        <td>" . htmlspecialchars($data['nama']) . "</td>
                        <td>" . htmlspecialchars($data['jurusan']) . "</td>
                        <td>" . htmlspecialchars($data['semester']) . "</td>
                        <td>" . htmlspecialchars($data['jumlah_tagihan']) . "</td>
                        <td>" . htmlspecialchars($data['metode']) . "</td>
                        <td>" . htmlspecialchars($data['via']) . "</td>
                        <td>
                            <a href='updatetagihan.php?id_tagihan=" . htmlspecialchars($data['id_tagihan']) . "' class='btn btn-warning btn-sm text-white'>Edit</a>
                            <a href='deletetagihan.php?id_tagihan=" . htmlspecialchars($data['id_tagihan']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php include 'assets/resource/footer.php'; ?>
