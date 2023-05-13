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
if (isset($_POST["deleted"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (del($_POST) > 0) {
        echo "
            <script>
                alert('Data Added Successfully!');
                document.location.href = 'keranjang.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Add!');
            document.location.href = 'keranjang.php';
        </script>
        ";
    }
}

// cek apakah tombol submit sudah di tekan atau belum 
if (isset($_POST["update"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (update($_POST) > 0) {
        echo "
            <script>
                alert('Data Update Successfully!');
                document.location.href = 'keranjang.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Update!');
            document.location.href = 'keranjang.php';
        </script>
        ";
    }
}

if (isset($_POST["beli"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (buy($_POST) > 0) {
        echo "
            <script>
                alert('Data Update Successfully!');
                document.location.href = 'keranjang.php';
            </script>
       ";
    } else {
        echo "
        <script>
            alert('Data Failed To Update!');
            document.location.href = 'keranjang.php';
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
    <title>Keranjang Belanja</title>

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
                            <h3>Isi Keranjang</h3>
                            <p class="text-subtitle text-muted">Data-data barang yang sudah masuk keranjang</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Keranjang</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table Keranjang</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="buttons">

                                <a href="jual.php">
                                    <button type="submit" class="btn btn-primary">
                                        + Tambah Barang<span class="badge bg-transparent"></span>
                                    </button>
                                </a>

                            </div>
                        </div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID_Keranjang</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Harga/pcs</th>
                                    <th>Stok</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Update</th>
                                    <th>Subtotal</th>
                                    <th>Deleted</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ambil=$db->query("SELECT * FROM keranjang");
                                $total = 0;
                                ?>
                                <?php while($pecah = $ambil->fetch_assoc()) {?>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">

                                        <td><input type="text" id="id_keranjang" class="form-control"
                                                placeholder="<?php echo $pecah['id'];?>" readonly name="id_keranjang"
                                                value="<?php echo $pecah['id'];?>">
                                        </td>
                                        <td><input type="text" id="id_barang" class="form-control"
                                                placeholder="<?php echo $pecah['id_barang'];?>" readonly
                                                name="id_barang" value="<?php echo $pecah['id_barang'];?>">
                                        </td>
                                        <td><input type="text" id="nama_barang" class="form-control text-bold"
                                                placeholder="<?php echo $pecah['nama_barang'];?>" readonly
                                                name="nama_barang" value="<?php echo $pecah['nama_barang'];?>">
                                        </td>
                                        <td><input type="text" id="harga_barang" class="form-control"
                                                placeholder="<?php echo $pecah['harga_barang'];?>" readonly
                                                name="harga_barang" value="<?php echo $pecah['harga_barang'];?>">
                                        </td>
                                        <td><input type="text" id="stok" class="form-control"
                                                placeholder="<?php echo $pecah['stok'];?>" readonly name="stok"
                                                value="<?php echo $pecah['stok'];?>">
                                        </td>
                                        <td><input type="number" min="1" Max="<?php echo $pecah['stok'];?>"
                                                id="jumlah_barang" class="form-control"
                                                placeholder="<?php echo $pecah['jumlah_barang'];?>" name="jumlah_barang"
                                                data-parsley-required="true"
                                                value="<?php echo $pecah['jumlah_barang'];?>">

                                        </td>
                                        <td><button type="submit" class="bg-success" name="update">
                                                <span class="badge bg-success">Update Jumlah</span>
                                            </button></td>
                                        <?php $subtotal = $pecah['harga_barang'] * $pecah['jumlah_barang'];
                                        $total = $total + $subtotal;
                                        ?>
                                        <td><input type="text" id="subtotal" class="form-control"
                                                placeholder="<?php echo $subtotal?>" readonly name="subtotal"
                                                value="<?php echo $subtotal;?>">
                                        </td>
                                        <td>
                                            <button type="submit" class="bg-danger" name="deleted">
                                                <span class="badge bg-danger">Hapus Barang</span>
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                <?php }?>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <td colspan="7"> </td>
                                        <td colspan="2">
                                            <div class="buttons">
                                                <?php $ambil=$db->query("SELECT * FROM keranjang");
                                            $totker = 0;
                                            ?>
                                                <?php while($pecah = $ambil->fetch_assoc()) {
                                            $totker++;
                                            } ?>
                                                <button type="submit" class="btn btn-primary" name="beli">
                                                    Checkout Sekarang<span class="badge bg-transparent">Rp.
                                                        <?= $total ?></span>
                                                </button>

                                            </div>
                                        </td>
                                    </form>
                                </tr>
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