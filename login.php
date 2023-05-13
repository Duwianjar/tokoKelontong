<?php

session_start();

// koneksi
require 'functions.php';

if (isset($_SESSION['admin']))   
        {
            header("Location: logout.php");
        exit;    
        }

// cek form login
if (isset($_POST["loginadmin"])) {
    $nama= mysqli_real_escape_string($db, $_POST['username'] );
    $pass= mysqli_real_escape_string($db, $_POST['password'] );
    $verif=hash('sha256', $pass);
    $ambil = $db->query("SELECT * FROM karyawan WHERE username ='$nama' AND password ='$verif'");
    $get = $ambil->num_rows;
    if($get==1){
        $_SESSION['admin']=$ambil->fetch_assoc();
        header("Location: index.php");
        exit;
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Login Admin</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Main CSS-->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png?<?php echo time(); ?>" type="image/png" />
    <link href="login.css?<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading lg:chd sm:chd"></div>
                <div class="card-body">
                    <h2 class="title text-2xl"><b>Masuk</b></h2>
                    <?php if (isset($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Try Again!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="text" id="username" name="username"
                                placeholder="Username" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="password" id="password" name="password"
                                placeholder="Password" requrired>
                        </div>
                        <div class="p-t-20">
                            <button type="submit" name="loginadmin" class="btn btn--radius btn--green">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->