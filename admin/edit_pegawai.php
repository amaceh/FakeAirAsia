<?php 
	if (!isset($_GET['id'])) {//jika id kosong
		header('location: admin.php');
	}else{


	require_once('koneksi.php');//connect DB
	$id=$_GET['id'];

	$q="SELECT *FROM pegawai where username='$id'";
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
<html>
<head>
	<!-- Tampilan HALAMAN BERANDA -->
	<meta charset="utf-8">
	<meta http-equiv="" tp-equiv="X-UA-Compatible" content="IE-edge">
	<title>Edit Jadwal</title>
	<!-- seikit css untuk merapihkan -->
	<style type="text/css" media="screen">
		width: 90%;
		margin: auto;
	</style>
</head>
<body>
	<!-- form untuk menambah film -->
	<center>
		
	<div id="wrapper">
		<h1>Mengedit data : <?php echo $hasil['USERNAME']; ?></h1>
	<form action="pro_edit_pegawai.php" method="POST" accept-charset="utf-8">
	<!-- data pada form diproses di file tambah_film.php -->
	<table>
		<tr>
			<td>
			Username : 
			</td>
			<td>
			<input type="text" name="username" value="<?php echo $hasil['USERNAME']; ?>" placeholder="jadwal" readonly="">
			</td>
		</tr>
		<tr>
			<td>
			Nama : 
			</td>
			<td>
			<input type="text" name="nama" value="<?php echo $hasil['NAMA']; ?>"" placeholder="Tujuan" required>	
				
			</td>
		</tr>
		<tr>
			<td>
			Password: 
				
			</td>
			<td>
			<input type="text" name="pass" value="<?php echo $hasil['PASSWORD']; ?>"" placeholder="Jadwal Berangkat" required>
				
			</td>
		</tr>
	</table>






			<input type="submit" name="submit" value="Simpan">

	</form>
	</div>
	</center>
</body>

<?php
 }
?>