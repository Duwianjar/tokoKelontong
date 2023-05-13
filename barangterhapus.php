<?php

session_start();
// koneksi
require 'functions.php';

// cek user login

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$item = 2;


if (isset($_POST["balik"])) {

    

    // cek apakah data berhasil ditambahkan atau tidak
    if (balik($_POST) > 0) {
        echo "
            <script>
                alert('Deleted Successfully!');
                document.location.href = 'barangterhapus.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Add!');
            document.location.href = 'restok.php';
        </script>
        ";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Terhapus</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/pages/datatables.css">

</head>

<body>
    <div id="app">
        <?php require 'sidebar.php';?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Cahce</h3>
                            <p class="text-subtitle text-muted">Data-data barang yang sudah terhapus</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table Terhapu</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <!-- <div class="card-header">
                            Data-data barang yang tersedia
                        </div> -->
                        <div class="card-body">
                            <table class="table" id="table1">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Harga/pcs</th>
                                        <th>Stok</th>
                                        <th>Expired</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $ambil=$db->query("SELECT * FROM barangterhapus");?>
                                    <?php while($pecah = $ambil->fetch_assoc()) {?>

                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" id="id_barang" class="form-control" readonly
                                                name="id_barang" value="<?php echo $pecah['id_barang']?>">
                                            <input type="hidden" id="stok" class="form-control" readonly name="stok"
                                                value="<?php echo $pecah['stok']?>">
                                            <input type="hidden" id="nama_barang" class="form-control" readonly
                                                name="nama_barang" value="<?php echo $pecah['nama_barang']?>">
                                            <input type="hidden" id="harga_barang" class="form-control" readonly
                                                name="harga_barang" value="<?php echo $pecah['harga_barang']?>">
                                            <input type="hidden" id="kadaluarsa" class="form-control" readonly
                                                name="kadaluarsa" value="<?php echo $pecah['kadaluarsa']?>">
                                            <td><?php echo $pecah['id_barang'];?></td>
                                            <td><?php echo $pecah['nama_barang'];?></td>
                                            <td>Rp. <?php echo $pecah['harga_barang'];?></td>
                                            <td><?php echo $pecah['stok'];?></td>
                                            <td><?php echo $pecah['kadaluarsa'];?></td>

                                            <td>


                                                <button type="submit" class="bg-primary" name="balik">
                                                    <span class="badge bg-primary">Kembalikan</span>
                                                </button>


                                            </td>
                                        </form>
                                    </tr>

                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
                <!-- Basic Tables end -->
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; DAAW</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://saugi.me">Duwi Anjar Ariwibowo</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>

</body>

</html>