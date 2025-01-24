<?php include 'assets/resource/header.php'; ?>

    <div class="container mt-4">
        <h2 class="pb-3">Data Mahasiswa</h2>
        <a href="create.php" class="btn btn-primary">Tambah Mahasiswa</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Mahasiswa</th>
                    <th>Nama</th>
                    <th>Universitas</th>
                    <th>Jurusan</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk menampilkan data peserta
                $sql = "SELECT * FROM mahasiswa";
                $hasil = mysqli_query($skon, $sql);

                while ($data = mysqli_fetch_assoc($hasil)) {
                    echo "<tr>
                        <td class='text-center'>" . htmlspecialchars($data['id_mahasiswa']) . "</td>
                        <td>" . htmlspecialchars($data['nama']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($data['universitas']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($data['jurusan']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($data['no_hp']) . "</td>
                        <td>" . htmlspecialchars($data['alamat']) . "</td>
                        <td class='text-center'>" . htmlspecialchars($data['semester']) . "</td>
                        <td>
                            <a href='update.php?id_mahasiswa=" . htmlspecialchars($data['id_mahasiswa']) . "' class='btn btn-warning btn-sm text-white'>Edit</a>
                            <a href='delete.php?id_mahasiswa=" . htmlspecialchars($data['id_mahasiswa']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php include 'assets/resource/footer.php'; ?>