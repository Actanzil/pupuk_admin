<?php
    include '../dbconnect.php';
    //membuat koneksi ke database
    

    //variabel nim yang dikirimkan form.php
    $id_barang = $_GET['idx'];

    //mengambil data
    $query = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang='$id_barang'");
    $barang = mysqli_fetch_array($query);
    $data = array('nama'     =>  @$barang['nama'],);
            
    //tampil data
    echo json_encode($data);
?>