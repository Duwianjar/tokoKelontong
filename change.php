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
$id = 0;
$id=$_GET['id']; 


if (isset($_POST["change"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (change($_POST) > 0) {
        echo "
            <script>
                alert('Change Data Successfully!');
                document.location.href = 'tabelbarang.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Add!');
            document.location.href = 'change.php?&id=$id';
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
    <title>Change</title>

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
                            <h3>Ubah Barang</h3>
                            <p class="text-subtitle text-muted">Ubah Detail Barang</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
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
                                            <th>Ubah id=[ <?=$id?> ]</th>
                                            <th> </th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $ambil=$db->query("SELECT * FROM barang WHERE id_barang =$id");
                                    $tot = 0;
                                     while($pecah = $ambil->fetch_assoc()) {?>
                                        <tr>
                                            <input type="hidden" id="id_barang" class="form-control"
                                                placeholder="<?php echo $id;?>" readonly name="id_barang"
                                                value="<?php echo $id?>">
                                            <input type="hidden" id="stok" class="form-control"
                                                placeholder="<?php echo $id;?>" readonly name="stok"
                                                value="<?php echo $pecah['stok_barang']?>">
                                            <td>Nama </td>

                                            <td><input type="text" id="nama_barang" class="form-control"
                                                    placeholder="<?php echo $pecah['nama_barang'];?>" name="nama_barang"
                                                    value="<?php echo $pecah['nama_barang'];?>"></td>


                                        </tr>
                                        <tr>
                                            <script>
                                            function hanyaAngka(event) {
                                                var angka = (event.which) ? event.which : event.keyCode
                                                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                                                    return false;
                                                return true;
                                            }
                                            </script>
                                            <td>Harga </td>
                                            <td><input type="text" id="harga_barang" min="1" class="form-control"
                                                    value="<?php echo $pecah['harga_barang'];?>" name=" harga_barang"
                                                    placeholder="<?php echo $pecah['harga_barang'];?>"
                                                    onkeypress="return hanyaAngka(event)">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kadaluarsa
                                            </td>
                                            <td>
                                                <input type="date" id="kadaluarsa" class="form-control"
                                                    min="date('m-d-Y')" placeholder="<?php echo $pecah['kadaluarsa'];?>"
                                                    name="kadaluarsa" value="<?php echo $pecah['kadaluarsa'];?>">
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="2"><button type="submit" class="bg-primary" name="change">
                                                    <span class="badge bg-primary">Ubah Data</span>
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