<!doctype html>
<html class="no-js" lang="en">

<?php 
    include '../dbconnect.php';
    include 'cek.php';

    if(isset($_POST['update'])){
        $id_barang = $_POST['id_barang'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $merk = $_POST['merk'];
        $ukuran = $_POST['ukuran'];
        $satuan = $_POST['satuan'];
        $lokasi = $_POST['lokasi'];

        $updatedata = mysqli_query($conn,"UPDATE tb_barang SET nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', satuan='$satuan', lokasi='$lokasi' WHERE id_barang='$id_barang'");
        
        //cek apakah berhasil
        if ($updatedata){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
            <meta http-equiv='refresh' content='1; url= page_barang.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= page_barang.php'/> ";
            }
    };

    if(isset($_POST['hapus'])){
        $id_barang = $_POST['id_barang'];

        $delete = mysqli_query($conn,"DELETE FROM tb_barang where id_barang='$id_barang'");
        //hapus juga semua data barang ini di tabel keluar-masuk
        $deltabelkeluar = mysqli_query($conn,"DELETE FROM sbrg_keluar WHERE id='$id_barang'");
        $deltabelmasuk = mysqli_query($conn,"DELETE FROM sbrg_masuk WHERE id='$id_barang'");
        
        //cek apakah berhasil
        if ($delete && $deltabelkeluar && $deltabelmasuk){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
            <meta http-equiv='refresh' content='1; url= page_barang.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= page_barang.php'/> ";
            }
    };
	?>

<head>
    <meta charset="utf-8">
	<link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Logistics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	    window.dataLayer = window.dataLayer || [];
	    function gtag(){
            dataLayer.push(arguments);
        }
	    gtag('js', new Date());

	    gtag('config', 'UA-144808195-1');
	</script>
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <a href="index.php"><img src="../Get.png" alt="logo" width="100%"></a>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
							<li><a href="index.php"><span>Dashboard</span></a></li>
                            <li class="active">
                                <a href="page_barang.php"><i class="ti-dashboard"></i><span>Persediaan Barang</span></a>
                            </li>
							<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="data_masuk.php">Data Masuk</a></li>
                                    <li><a href="data_keluar.php">Data Keluar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="logout.php"><span>Keluar</span></a>
                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <h2>Hi, <?=$_SESSION['user'];?>!</h2>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><h3><div class="date">
								<script type='text/javascript'>
						<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>

						</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
			<?php 
			
				$periksa_bahan=mysqli_query($conn,"SELECT * FROM tb_barang WHERE stock <1");
				while($p=mysqli_fetch_array($periksa_bahan)){	
					if($p['stock']<=1){	
						?>	
						<script>
							$(document).ready(function(){
								$('#pesan_sedia').css("color","white");
								$('#pesan_sedia').append("<i class='ti-flag'></i>");
							});
						</script>
						<?php
						echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>".$p['nama']. "</u> <u>".($p['merk'])."</u> &nbsp <u>".$p['ukuran']."</u></strong> yang tersisa sudah habis</div>";		
					}
				}
				?>
			
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Daftar Barang</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Barang</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
                                </div>
                                    <div class="data-tables datatable-dark">
										<table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Merk</th>
												<th>Jenis</th>
												<th>Ukuran</th>
												<th>Satuan</th>
												<th>Lokasi</th>
												<th>Stock</th>
												<th>Opsi</th>
											</tr></thead><tbody>
											<?php 
											$brgs = mysqli_query($conn,"SELECT * FROM tb_barang ORDER BY nama ASC");
											$no = 1;
											while($p=mysqli_fetch_array($brgs)){
                                                $idb = $p['id_barang'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['nama'] ?></td>
													<td><?php echo $p['merk'] ?></td>
													<td><?php echo $p['jenis'] ?></td>
													<td><?php echo $p['ukuran'] ?></td>
													<td><?php echo $p['satuan'] ?></td>
													<td><?php echo $p['lokasi'] ?></td>
													<td><?php echo $p['stock'] ?></td>
                                                    <td><button data-toggle="modal" data-target="#edit<?=$idb;?>" class="btn btn-warning">Edit</button> <button data-toggle="modal" data-target="#del<?=$idb;?>" class="btn btn-danger">Del</button></td>
												</tr>


                                                <!-- The Modal -->
                                                    <div class="modal fade" id="edit<?=$idb;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang <?php echo $p['nama']?></h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Barang</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $p['nama'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="merk">Merk</label>
                                                                    <input type="text" id="merk" name="merk" class="form-control" value="<?php echo $p['merk'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jenis">Jenis</label>
                                                                    <select class="custom-select form-control" id="jenis" name="jenis">
                                                                        <option value="Organik" <?php if ($p['jenis']=="Organik") { ?> selected <?php } ?>>Organik</option>
                                                                        <option value="Anorganik" <?php if ($p['jenis']=="Anorganik") { ?> selected <?php } ?>>Anorganik</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ukuran">Ukuran</label>
                                                                    <input type="text" id="ukuran" name="ukuran" class="form-control" value="<?php echo $p['ukuran'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="satuan">Satuan</label>
                                                                    <select class="custom-select form-control" id="satuan" name="satuan">
                                                                        <option value="Kilogram" <?php if ($p['satuan']=="Kilogram") { ?> selected <?php } ?>>Kilogram</option>
                                                                        <option value="Kwintal" <?php if ($p['satuan']=="Kwintal") { ?> selected <?php } ?>>Kwintal</option>
                                                                        <option value="Ton" <?php if ($p['satuan']=="Ton") { ?> selected <?php } ?>>Ton</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="lokasi">Lokasi</label>
                                                                    <select class="custom-select form-control" id="lokasi" name="lokasi">
                                                                        <option value="Gudang 1" <?php if ($p['lokasi']=="Gudang 1") { ?> selected <?php } ?>>Gudang 1</option>
                                                                        <option value="Gudang 2" <?php if ($p['lokasi']=="Gudang 2") { ?> selected <?php } ?>>Gudang 2</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stock">Stock</label>
                                                                    <input type="text" id="stock" name="stock" class="form-control" value="<?php echo $p['stock'] ?>" disabled>
                                                                    <input type="hidden" name="id_barang" value="<?= $idb; ?>">
                                                                </div>
                                                                
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success" name="update">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <!-- The Modal -->
                                                    <div class="modal fade" id="del<?=$idb;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang <?php echo $p['nama']?> - <?php echo $p['jenis']?> - <?php echo $p['ukuran']?></h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus barang ini dari daftar persediaan barang?
                                                            <input type="hidden" name="id_barang" value="<?=$idb;?>">
                                                            </div>
                                                            
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success" name="hapus">Hapus</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>


												<?php 
											}
											?>
										</tbody>
										</table>
                                    </div>
									<a href="export_barang.php" target="_blank" class="btn btn-info">Export Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>By Richard's Lab</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
	<!-- modal input -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Masukkan stok manual</h4>
						</div>
						<div class="modal-body">
							<form action="konfirmasi_tambah_barang.php" method="POST">
								<div class="form-group">
									<label>Nama</label>
									<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
								</div>
                                <div class="form-group">
									<label>Merk</label>
									<input name="merk" type="text" class="form-control" placeholder="Merk Barang">
								</div>
								<div class="form-group">
									<label>Jenis</label>
                                    <select name="jenis" class="custom-select form-control">
                                        <option selected>Pilih Jenis</option>
                                        <option value="Organik">Organik</option>
                                        <option value="Anorganik">Anorganik</option>
                                    </select>
								</div>
								<div class="form-group">
									<label>Ukuran</label>
									<input name="ukuran" type="text" class="form-control" placeholder="Ukuran">
								</div>
                                <div class="form-group">
									<label>Satuan</label>
									<select name="satuan" class="custom-select form-control">
									<option selected>Pilih Satuan</option>
									<option value="Kilogram">Kilogram</option>
									<option value="Kwintal">Kwintal</option>
									<option value="Ton">Ton</option>
									</select>
								</div>
                                <div class="form-group">
									<label>Lokasi</label>
                                    <select name="lokasi" class="custom-select form-control">
									<option selected>Pilih Lokasi</option>
									<option value="Gudang 1">Gudang 1</option>
									<option value="Gudang 2">Gudang 2</option>
                                    </select>
								</div>
								<div class="form-group">
									<label>Stock</label>
									<input name="stock" type="number" min="0" class="form-control" placeholder="Qty">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	
	<script>
		$(document).ready(function() {
		$('input').on('keydown', function(event) {
			if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
                var $t = $(this);
                event.preventDefault();
                var char = String.fromCharCode(event.keyCode);
                $t.val(char + $t.val().slice(this.selectionEnd));
                this.setSelectionRange(1,1);
			}
		});
	});
	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
	
</body>

</html>
