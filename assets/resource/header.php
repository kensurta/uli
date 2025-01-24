<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uli | Cepat, Simpel dan</title>
    <link rel="icon" href="assets/images/uli.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a class="navbar-brand" href="/index.php">
                    <img src="assets/images/uli.png" alt="Uli" width="15%">
                </a>
            </div>
            <div class="col-6 text-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="mahasiswa.php">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="tagihan.php">Tagihan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </nav>
    <?php 
        // Include file koneksi, untuk koneksikan ke database
        include "koneksi.php";
    ?>