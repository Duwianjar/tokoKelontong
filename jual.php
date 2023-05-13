<?php

session_start();
// koneksi
require 'functions.php';

// cek user login

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$item = 3;

// cek apakah tombol submit sudah di tekan atau belum 
if (isset($_POST["upload"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (add($_POST) > 0) {
        echo "
            <script>
                alert('Data Added Successfully!');
                document.location.href = 'jual.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Add!');
            document.location.href = 'jual.php';
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
    <title>Transaksi Baru</title>

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
                            <h3>Transaksi Baru</h3>
                            <p class="text-subtitle text-muted">Data-data barang yang tersedia</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Keranjang</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table Keranjang</li>
                                </ol>
                                <div class="buttons">
                                    <?php $ambil=$db->query("SELECT * FROM keranjang");
                                $totker = 0;
                                ?>
                                    <?php while($pecah = $ambil->fetch_assoc()) {
                                    $totker++;
                                     } ?>
                                    <a href="keranjang.php">
                                        <button type="button" class="btn btn-primary">
                                            Checkout <span class="badge bg-transparent"><?= $totker ?></span>
                                        </button>
                                    </a>

                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                        </div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Harga/pcs</th>
                                    <th>Stok</th>
                                    <th>Expired</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ambil=$db->query("SELECT * FROM barang");?>
                                <?php while($pecah = $ambil->fetch_assoc()) {?>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <td><input type="text" id="id_barang" class="form-control"
                                                placeholder="<?php echo $pecah['id_barang'];?>" readonly
                                                name="id_barang" value="<?php echo $pecah['id_barang'];?>">

                                        </td>
                                        <td><input type="text" id="nama_barang" class="form-control"
                                                placeholder="<?php echo $pecah['nama_barang'];?>" readonly
                                                name="nama_barang" value="<?php echo $pecah['nama_barang'];?>">
                                        </td>
                                        <td><input type="text" id="harga_barang" class="form-control"
                                                placeholder="<?php echo $pecah['harga_barang'];?>" readonly
                                                name="harga_barang" value="<?php echo $pecah['harga_barang'];?>">
                                        </td>
                                        <td><input type="text" id="stok_barang" class="form-control"
                                                placeholder="<?php echo $pecah['stok_barang'];?>" readonly
                                                name="stok_barang" value="<?php echo $pecah['stok_barang'];?>">
                                        </td>
                                        <td><?php echo $pecah['kadaluarsa'];?></td>
                                        <td><input type="number" min="1" Max="<?php echo $pecah['stok_barang'];?>"
                                                id="jumlah" class="form-control" placeholder="1" name="jumlah"
                                                data-parsley-required="true" value="1">
                                        </td>

                                        <td>
                                            <button type="submit" class="bg-success" name="upload">
                                                <span class="badge bg-success">Tambah Keranjang</span>
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