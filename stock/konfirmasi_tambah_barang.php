<?php

  include '../dbconnect.php';
  $nama = $_POST['nama'];
  $jenis=$_POST['jenis'];
  $ukuran=$_POST['ukuran'];
  $merk=$_POST['merk'];
  $satuan=$_POST['satuan'];
  $lokasi=$_POST['lokasi'];
  $stock=$_POST['stock'];
      
  $query = mysqli_query($conn,"INSERT INTO tb_barang (nama, jenis, merk, ukuran, satuan, lokasi, stock)VALUES('$nama','$jenis','$merk','$ukuran','$satuan','$lokasi','$stock')");
  
  if ($query){
    $_SESSION["notification"] = [
      'type' => 'success',
      'message' => 'Data successfully added!'
    ];
  } else { 
    $_SESSION["notification"] = [
      'type' => 'warning',
      'message' => 'Failed to add data!'
    ];
    
  }

  header("Location: page_barang.php");
  exit();
?>