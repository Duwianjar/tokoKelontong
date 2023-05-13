<?php

//Koneksi ke Database
$db = mysqli_connect("localhost", "root", "", "db_toko");


// function query
function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function queryy($queryy)
{
    global $db;
    $resultt = mysqli_query($db, $queryy);
    $rowss = [];
    while ($roww = mysqli_fetch_assoc($resultt)) {
        $rowss[] = $roww;
    }
    return $rowss;
}


// tambah data keranjang
function add($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_barang"];
    $nama = $data["nama_barang"];
    $harga = $data["harga_barang"];
    $jumlah = $data["jumlah"];
    $stok = $data["stok_barang"];

    $ambil = $db->query("SELECT * FROM keranjang WHERE id_barang =$id");
    while($pecah = $ambil->fetch_assoc()) {
        $jumlahlama = $pecah['jumlah_barang'];
    }
    $get = $ambil->num_rows;
    if($get>=1){
                //query insert data
                $query = "UPDATE keranjang SET jumlah_barang = $jumlahlama+$jumlah WHERE id_barang = $id ";
    }
    else{
        //query insert data
        $query = "INSERT INTO keranjang 
        VALUES ('',$id,'$nama',$harga, $jumlah, $stok)";
    }
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// hapus data keranjang
function del($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_keranjang"];
    
    //query insert data
    $query = "DELETE FROM keranjang WHERE id=$id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Update data keranjang
function update($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_keranjang"];
    $jumlah = $data["jumlah_barang"];
    
    //query insert data
    $query = "UPDATE keranjang SET jumlah_barang = $jumlah WHERE id = $id ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// Buy
function buy($data)
{
    global $db;
    $id_karyawan=$_SESSION['admin']['id'];
    //ambil dari data dari tiap elemen dalam form
    $ambil=$db->query("SELECT * FROM transaksi");
    $idnew = 1;
    while ($pecah = $ambil->fetch_assoc()) {
        $idnew++;
    }


   
        //query insert daata to transaksi
        $query = "INSERT INTO transaksi VALUES ($idnew,0,NOW(),$id_karyawan)";
        mysqli_query($db, $query);


        //query insert daata to detail transaksi
        $ambilkeranjang=$db->query("SELECT * FROM keranjang");
        while ($cut = $ambilkeranjang->fetch_assoc()) {
        $id=$cut['id_barang'];
        $jumlah = $cut['jumlah_barang'];
        $sub = $cut['harga_barang'] * $jumlah;

        $query = "INSERT INTO detail_transaksi VALUES ($idnew,$id,$sub,$jumlah)";
        mysqli_query($db, $query);

        }
        $query = "DELETE FROM keranjang";
        mysqli_query($db, $query);


    return mysqli_affected_rows($db);
}


// hapus data keranjang
function restok($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_barang"];
    $tambah = $data["stok_tambahan"];
    
    //query insert data
    $query = "INSERT INTO tambah_stok VALUES ('',$id,$tambah,'NOW()')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Change barang
function change($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_barang"];
    $nama = $data["nama_barang"];
    $harga = $data["harga_barang"];
    $kadaluarsa = $data["kadaluarsa"];
    
    //query insert data
    $query = "UPDATE barang SET 
    nama_barang='$nama', 
    harga_barang=$harga,
    kadaluarsa='$kadaluarsa'
    WHERE id_barang=$id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delbarang($data)
{
    global $db;
    //ambil dari data dari tiap elemen dalam form
    $id = $data["id_barang"];
    $nama = $data["nama_barang"];
    $harga = $data["harga_barang"];
    $stok = $data["stok"];
    $kadaluarsa = $data["kadaluarsa"];
    
    $query = "INSERT INTO barangterhapus VALUES($id,'$nama',$harga,$stok,'$kadaluarsa')";
    mysqli_query($db, $query);
    
    
       

    return mysqli_affected_rows($db);
}
function balik($data)
{
    global $db;
    
       

    return mysqli_affected_rows($db);
}




?>