<?php
include '../dbconnect.php';
$id_barang = $_POST['id_barang']; //id barang
$qty = $_POST['qty'];
$tanggal = (new \DateTime())->format('Y-m-d');
$penerima = $_POST['penerima'];
$ket = $_POST['ket'];

$dt = mysqli_query($conn, "SELECT * FROM barang WHERE idx='$id_barang'");
$data = mysqli_fetch_array($dt);
$sisa = $data['stock'] - $qty;

$query1 = mysqli_query($conn, "UPDATE barang SET stock='$sisa' WHERE idx='$id_barang'");
$query2 = mysqli_query($conn, "INSERT INTO sbrg_keluar(idx,tgl,jumlah,penerima,keterangan) VALUES('$id_barang','$tanggal','$qty','$penerima','$ket')");

if ($query1 && $query2) {
  echo " <div class='alert alert-success'>
    <strong>Success!</strong> Redirecting you back in 1 seconds.
  </div>
<meta http-equiv='refresh' content='1; url= keluar.php'/>  ";
} else {
  echo "<div class='alert alert-warning'>
    <strong>Failed!</strong> Redirecting you back in 1 seconds.
  </div>
 <meta http-equiv='refresh' content='1; url= keluar.php'/> ";
}

?>

<html>

<head>
  <title>Barang Keluar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>