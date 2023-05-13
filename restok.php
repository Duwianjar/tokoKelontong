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
$id=$_GET['id']; 




if (isset($_POST["restok"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (restok($_POST) > 0) {
        echo "
            <script>
                alert('Stok Added Successfully!');
                document.location.href = 'barangrestok.php';
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
    <title>Restok Barang</title>

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
                            <h3>Restok </h3>
                            <p class="text-subtitle text-muted">Menambah Stok Barang</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <thead>
                                        <tr>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Lama</th>
                                            <th>Stok Tambahan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $ambil=$db->query("SELECT * FROM barang WHERE id_barang =$id");
                                    $tot = 0;
                                     while($pecah = $ambil->fetch_assoc()) {?>
                                        <tr>
                                            <td><input type="text" id="id_barang" class="form-control"
                                                    placeholder="<?php echo $pecah['id_barang'];?>" readonly
                                                    name="id_barang" value="<?php echo $pecah['id_barang'];?>">
                                            </td>
                                            <td><?php echo $pecah['nama_barang'];?></td>
                                            <td><?php echo $pecah['stok_barang'];?></td>
                                            <td><input type="number" min="1" id="stok_tambahan" class="form-control"
                                                    placeholder="1" name="stok_tambahan" data-parsley-required="true"
                                                    value="1"></td>

                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><button type="submit" class="bg-success" name="restok">
                                                    <span class="badge bg-primary">Tambah Stok</span>
                                                </button></td>
                                        </tr>
                                    </tbody>

                                </form>

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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="#">Duwi
                                Anjar Ariwibowo</a></p>
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