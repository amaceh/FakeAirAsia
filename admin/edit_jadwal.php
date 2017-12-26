<?php 
	if (!isset($_GET['id'])) {//jika id kosong
		header('location: admin.php');
	}else{


	require_once('koneksi.php');//connect DB
	$id=$_GET['id'];

	$q="SELECT *FROM jadwal where id_jadwal='$id'";
	$data = oci_parse($koneksi, $q);//compile
	oci_execute($data);//execute
	// $row = oci_fetch_all($data, $hasil);//simpan jumlah data
	$hasil=oci_fetch_assoc($data)
	// $jadwal = array();//buat array kosong

	// if ($row > 0) {//jika tabel tidak kosong
	// 	oci_execute($data);//eksekusi lagi
	// 	while ($r = oci_fetch_array($data)) {//loop hingga false
	// 		$jadwal[] = $r;
	// 	}//simpan semua data
	// }
?>

<!DOCTYPE html>
<center>
	
<html>
<head>
	<!-- Tampilan HALAMAN BERANDA -->
	<meta charset="utf-8">
	<meta http-equiv="" tp-equiv="X-UA-Compatible" content="IE-edge">
	<title>Edit Jadwal</title>
	<h1>Edit Jadwal : <?php echo $hasil['ID_JADWAL']; ?> </h1>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<!-- seikit css untuk merapihkan -->
	<style type="text/css" media="screen">
		width: 90%;
		margin: auto;
	</style>
</head>
<body>
	<!-- form untuk menambah film -->
	<form action="pros_edit_jadwal.php" method="POST" accept-charset="utf-8">
	<!-- data pada form diproses di file tambah_film.php -->
	<div id="wrapper">

	<table>
		<tr>
			<td>
		Kode Jadwal : 
			</td>
			<td>
		<input type="text" name="jadwal" value="<?php echo $hasil['ID_JADWAL']; ?>" placeholder="jadwal" readonly="">
			</td>
		</tr>
		
		<tr>
			<td>
		Kode Perjalanan :
			</td>
			<td>
		 <input type="text" name="perjalanan" value="<?php echo $hasil['ID_LIST_ARGO']; ?>"" placeholder="Tujuan" required>
			</td>
		</tr>
		
		<tr>
			<td>
		Jadwal Berangkat: 
			</td>
			<td>
		<input type="text" name="awal" value="<?php echo $hasil['JADWAL_BERANGKAT']; ?>"" placeholder="Jadwal Berangkat" required>
			</td>
		</tr>
		
		<tr>
			<td>
		Jadwal Tiba : 
			</td>
			<td>
		<input type="text" name="akhir" value="<?php echo $hasil['JADWAL_TIBA']; ?>"" placeholder="Jadwal Tiba" required>
			</td>
		</tr>
		
		<tr>
			<td>
		Harga : 
			</td>
			<td>
		<input type="text" name="harga" value="<?php echo $hasil['HARGA']; ?>"" placeholder="Harga" required>
			
			</td>
		</tr>
		<tr><td></td><td>
			<input type="submit" name="submit" value="Simpan">
		</td></tr>

		






	</table>
	</div>
	</form>
</body>
</center>

<?php
 }
?>