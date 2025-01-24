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

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = input($_POST["nama"]);
            $universitas = input($_POST["universitas"]);
            $jurusan = input($_POST["jurusan"]);
            $no_hp = input($_POST["no_hp"]);
            $alamat = input($_POST["alamat"]);
            $semester = "1";
        
            // Query untuk menginput data ke tabel mahasiswa
            $sql = "INSERT INTO mahasiswa (nama, universitas, jurusan, no_hp, alamat, semester) VALUES ('$nama', '$universitas', '$jurusan', '$no_hp', '$alamat', '$semester')";
        
            // Mengeksekusi query di atas
            $hasil = mysqli_query($skon, $sql);
        
            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                header("Location: mahasiswa.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal disimpan.</div>";
            }
        }
        ?>        

        <h2>Input Data</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Universitas</label>
                <input type="text" name="universitas" class="form-control" placeholder="Masukan Nama Universitas" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan</label>
                <select name="jurusan" class="form-select" required>
                    <option value="">Pilih Jurusan</option>
                    <?php foreach ($enumValues as $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">No Hp</label>
                <input type="number" name="no_hp" class="form-control" placeholder="Masukan No Hp" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php include 'assets/resource/footer.php'; ?>