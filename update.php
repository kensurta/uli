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

        // Fetch ENUM values for jurusan
        $enumValues = [];
        $result = mysqli_query($skon, "SHOW COLUMNS FROM mahasiswa LIKE 'jurusan'");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (preg_match('/^enum\((.*)\)$/', $row['Type'], $matches)) {
            $enumValues = explode(',', str_replace("'", "", $matches[1]));
        }

        // Cek apakah ada nilai yang dikirim menggunakan metode GET dengan nama id_mahasiswa
        if (isset($_GET["id_mahasiswa"])) {
            $id_mahasiswa = input($_GET["id_mahasiswa"]);

            $sql = "SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";
            $hasil = mysqli_query($skon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_mahasiswa = input($_POST["id_mahasiswa"]);
            $nama = input($_POST["nama"]);
            $universitas = input($_POST["universitas"]);
            $jurusan = input($_POST["jurusan"]);
            $no_hp = input($_POST["no_hp"]);
            $alamat = input($_POST["alamat"]);

            // Query update data pada tabel anggota
            $sql = "UPDATE mahasiswa SET
                    nama='$nama',
                    universitas='$universitas',
                    jurusan='$jurusan',
                    no_hp='$no_hp',
                    alamat='$alamat'
                    WHERE id_mahasiswa=$id_mahasiswa";

            // Mengeksekusi atau menjalankan query diatas
            $hasil = mysqli_query($skon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:mahasiswa.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Update Data</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Universitas</label>
                <input type="text" name="universitas" class="form-control" placeholder="Masukan Nama Universitas" required value="<?php echo isset($data['universitas']) ? $data['universitas'] : ''; ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan</label>
                <select name="jurusan" class="form-select" required>
                    <option value="<?php echo isset($data['jurusan']) ? $data['jurusan'] : ''; ?>"><?php echo isset($data['jurusan']) ? $data['jurusan'] : ''; ?></option>
                    <?php foreach ($enumValues as $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="number" name="no_hp" class="form-control" placeholder="Masukan No HP" required value="<?php echo isset($data['no_hp']) ? $data['no_hp'] : ''; ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?></textarea>
            </div>
            <input type="hidden" name="id_mahasiswa" value="<?php echo isset($data['id_mahasiswa']) ? $data['id_mahasiswa'] : ''; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

<?php include 'assets/resource/footer.php'; ?>
