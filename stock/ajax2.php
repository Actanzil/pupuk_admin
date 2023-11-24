<?php
    include '../dbconnect.php';
    //membuat koneksi ke database
    

    //variabel nim yang dikirimkan form.php
    $idx = $_GET['idx'];

    //mengambil data
    $query = mysqli_query($conn, "SELECT * FROM barang WHERE idx='$idx'");
    $barang = mysqli_fetch_array($query);
    $data = array('nama'     =>  @$barang['nama'],);
            
    //tampil data
    echo json_encode($data);
?>