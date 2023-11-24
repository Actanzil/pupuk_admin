<?php
  include '../dbconnect.php';
  $id_barang = $_POST['id_barang']; // ini ID barang nya
  $qty = $_POST['qty'];
  $tanggal = (new \DateTime())->format('Y-m-d');
  $ket = $_POST['ket'];

  $dt = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang = '$id_barang'");
  $data = mysqli_fetch_array($dt);
  $sisa = $data['stock'] + $qty;

  $query1 = mysqli_query($conn, "UPDATE tb_barang SET stock='$sisa' WHERE id_barang = '$id_barang'");
  $query2 = mysqli_query($conn, "INSERT INTO tb_barang_masuk (id_barang, tanggal, jumlah, keterangan) VALUES('$id_barang','$tanggal','$qty','$ket')");

  if ($query1 && $query2) {
    echo " <div class='alert alert-success'>
      <strong>Success!</strong> Redirecting you back in 1 seconds.
    </div>
  <meta http-equiv='refresh' content='1; url= data_masuk.php'/>  ";
  } else {
    echo "<div class='alert alert-warning'>
      <strong>Failed!</strong> Redirecting you back in 1 seconds.
    </div>
  <meta http-equiv='refresh' content='1; url= data_masuk.php'/> ";
  }


?>

<html>

<head>
  <title>Barang Masuk</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>