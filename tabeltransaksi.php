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

$awal = "kosong";
$hingga = "kosong";
$awal=$_GET['a'];
$hingga = $_GET['b'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>

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
                            <h3>Table Data Transaksi</h3>
                            <p class="text-subtitle text-muted">Data-data Transaksi</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table Transaksi</li>
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
                            <?php $total = 0;
                            $jumlah = 0; ?>
                            <table class="table" id="table1">

                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Total Pembelian</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama karyawan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($awal == 'kosong') { ?>
                                    <?php $ambil = $db->query("SELECT * FROM transaksi "); ?>
                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $pecah['id_transaksi']; ?></td>
                                        <td>Rp. <?php echo $pecah['Total_Pembelian']; ?></td>
                                        <?php $total = $total + $pecah['Total_Pembelian'];
                                        $jumlah++;
                                        ?>
                                        <td><?php echo $pecah['Tanggal_Transaksi']; ?></td>
                                        <?php
                                        $id = $pecah['id_karyawan'];
                                        $ambilnama = $db->query("SELECT * FROM karyawan WHERE id=$id"); ?>
                                        <?php while ($pecahnama = $ambilnama->fetch_assoc()) { ?>
                                        <td><?= $pecahnama['username'] ?> </td>
                                        <?php } ?>

                                        <td>
                                            <a href="detailtransaksi.php?&id=<?php echo $pecah['id_transaksi']; ?>"><span
                                                    class="badge bg-success">detail</span></a>

                                        </td>
                                    </tr>
                                    <?php }

                                    }
                                    else
                                    {?>

                                    <?php $ambil = $db->query("SELECT * FROM transaksi WHERE Tanggal_Transaksi BETWEEN CAST('$awal' AS DATE) AND CAST('$hingga' AS DATE)"); ?>
                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $pecah['id_transaksi']; ?></td>
                                        <td>Rp. <?php echo $pecah['Total_Pembelian']; ?></td>
                                        <?php $total = $total + $pecah['Total_Pembelian'];
                                        $jumlah++;
                                        ?>
                                        <td><?php echo $pecah['Tanggal_Transaksi']; ?></td>
                                        <?php
                                        $id = $pecah['id_karyawan'];
                                        $ambilnama = $db->query("SELECT * FROM karyawan WHERE id=$id"); ?>
                                        <?php while ($pecahnama = $ambilnama->fetch_assoc()) { ?>
                                        <td><?= $pecahnama['username'] ?> </td>
                                        <?php } ?>

                                        <td>
                                            <a href="detailtransaksi.php?&id=<?php echo $pecah['id_transaksi']; ?>"><span
                                                    class="badge bg-success">detail</span></a>

                                        </td>
                                    </tr>
                                    <?php }


                                    }?>


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if($awal!="kosong"){?>
                    <p> Total Transaksi dari <?= $awal?> sampai <?=$hingga ?><br> : <b>Rp. <?=$total?></b></p>
                    <?php } ?>



                </section>
                <p>Hitung Total Transaksi</p>

                <form action="" method="post" enctype="multipart/form-data">
                    <p>Dari Tanggal</p>
                    <input type="date" id="awal" class="form-control" placeholder="" name="awal" required>
                    <br>
                    <p>Hingga</p>
                    <?php $sekarang=date("m-d-Y"); ?>
                    <input type="date" id="awal" class="form-control" placeholder="" max="" name="hingga" required>
                    <br>
                    <button type="submit" class="bg-success" name="lihat">
                        <span class="badge bg-success">Lihat</span>
                    </button>
                    </td>
                </form>
                <?php 
                if (isset($_POST["lihat"])) {
                    $awal=$_POST['awal'];
                    $hingga = $_POST['hingga'];

                    echo "
                        <script>
                            document.location.href = 'tabeltransaksi.php?&a=$awal&b=$hingga';
                        </script>
                   ";
                
            }?>
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