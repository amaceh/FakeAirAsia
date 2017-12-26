<?php 
	session_start();//mulai sesi
	require_once('koneksi.php');//hubungkan dengan DB
	// var_dump($_SESSION['nama']);
	if ($_SESSION['log']==TRUE) {
		if ($_SESSION['nama']=="Super Admin") {
			$nama = $_SESSION['nama'];//simpan nama

	//ambil semua data
	$data = oci_parse($koneksi, 'SELECT *FROM jadwal');//compile
	oci_execute($data);//execute
	$row = oci_fetch_all($data, $hasil);//simpan jumlah data
	$jadwal = array();//buat array kosong

	if ($row > 0) {//jika tabel tidak kosong
		oci_execute($data);//eksekusi lagi
		while ($r = oci_fetch_array($data)) {//loop hingga false
			$jadwal[] = $r;
		}//simpan semua data
	}
	$data = oci_parse($koneksi, 'SELECT *FROM pegawai');//compile
	oci_execute($data);//execute
	$row = oci_fetch_all($data, $hasil);//simpan jumlah data
	$pegawai = array();//buat array kosong

	if ($row > 0) {//jika tabel tidak kosong
		oci_execute($data);//eksekusi lagi
		while ($r = oci_fetch_array($data)) {//loop hingga false
			$pegawai[] = $r;
		}//simpan semua data
	}
?>

<!DOCTYPE html>
	
<html>
<head>
	<!-- Tampilan HALAMAN BERANDA -->
	<link rel="stylesheet" type="text/css" href="admin.css">
	<meta charset="utf-8">
	<meta http-equiv="" tp-equiv="X-UA-Compatible" content="IE-edge">
	<title>Administrator Tool</title>
	<!-- seikit css untuk merapihkan -->
	<style type="text/css" media="screen">
		width: 90%;
		margin: auto;
	</style>
</head>
<body>
	<!-- tampilan nama dan link logout -->
	<p align="right">
		Hai <?php echo $nama; ?> | <a href="loket.php">Mengecek Loket?</a> | <a href="logout.php" title="">Logout</a> 
	</p>
	<!-- judul -->
	<h1 align="center">Selamat Datang, Selamat Bertugas</h1>
	<!-- form untuk menambah film -->
		
	
	<br>
	<!-- tampilan data film yang sudah ada -->
<div id="basket">
	<h1>Jadwal</h1>
	<div id="papan">
		
	<h3>Jadwal Yang Tersedia</h3>
	<table border="3">
		<thead>
			<tr>
				<!-- kolom atas -->
				<th>Kode Jadwal</th>
				<th>Kode Perjalanan</th>
				<th>Jam Berangkat</th>
				<th>Jam Tiba</th>
				<th>Tanggal</th>
				<th>Jumlah Kursi Tersedia</th>
				<th>Perintah</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				//tampilkan tiap data didalam tabel
				foreach ($jadwal as $value) {
					echo "<tr>";
					echo "<td>" .$value['ID_JADWAL']." </td>";
					echo "<td>" .$value['ID_LIST_TARIF']. "</td>";
					echo "<td>" .$value['JADWAL_BERANGKAT']." </td>";
					echo "<td>" .$value['JADWAL_TIBA']." </td>";
					echo "<td>" .$value['TANGGAL']." </td>";
					$sisa_kursi=181-$value['KURSI'];
					echo "<td>" .$sisa_kursi." </td>";
			?>
					<!-- tampilan link edit dan link hapus -->
					<td><a href="edit_jadwal.php?id=<?php echo $value['ID_JADWAL']; ?>" >Edit</a> | <a href="hapus_jadwal.php?id=<?php echo $value['ID_JADWAL']; ?>">Cancel</a>
			<?php 	
					echo "<tr>";
				}
			?>
		</tbody>
	</table>
	</div>

	<div id="wrapper">
	<h2>Tambah Jadwal</h2>
	 <form action="tambah_jadwal.php" method="POST" accept-charset="utf-8">
	<!-- data pada form diproses di file tambah_film.php -->	
		<table>
		<tr><td>
			Kode Jadwal : 
		</td> 
		<td>
			<input type="text" name="jadwal" value="" placeholder="jadwal" required>		
		</td>
		</tr>
		<tr>
			<td>
				Kode Perjalanan : 
			</td> 
			<td>
				<input type="text" name="perjalanan" value="" placeholder="Tujuan" required>	
			</td>
		</tr>
		<tr>
			<td>
			Jadwal Berangkat: 
			</td> 
			<td>
			<input type="text" name="awal" value="" placeholder="Jadwal Berangkat" required>	
			</td>
		</tr>
		<tr>
			<td>
			Jadwal Tiba : 
			</td> 
			<td>
			<input type="text" name="akhir" value="" placeholder="Jadwal Tiba" required>
				
			</td>
		</tr>
		<tr>
			<td>
			Tanggal : 
			</td> 
			<td>
			<input type="text" name="tanggal" value="" placeholder="tanggal" required>
				
			</td>
		</tr>
		<tr>
			<td>
				
			</td> 
			<td>
				
			<input type="submit" name="submit" value="Simpan">
			</td>
		</tr>
		</table>
	 </form>
	</div>

</div>
	<!-- form untuk menambah film -->
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
<div id="basket">
	<h1>PEGAWAI</h1>
	
	<div id ="papan">
		
	<h3>Daftar Pegawai</h3>
	<table border="1">
		<thead>
			<tr>
				<!-- kolom atas -->
				<th>Username</th>
				<th>Nama</th>
				<th>Password</th>
				<th>Perintah</th>

			</tr>
		</thead>
		<tbody>
			<?php 
				//tampilkan tiap data didalam tabel
				foreach ($pegawai as $value) {
					echo "<tr>";
					echo "<td>" .$value['USERNAME']." </td>";
					echo "<td>" .$value['NAMA']. "</td>";

					if ($value['USERNAME']!="admin") {	
					echo "<td>" .$value['PASSWORD']." </td>";
					
			?>
					<!-- tampilan link edit dan link hapus -->
					<td><a href="edit_pegawai.php?id=<?php echo $value['USERNAME']; ?>" >Edit</a> | <a href="hapus_pegawai.php?id=<?php echo $value['USERNAME']; ?>">Hapus</a>
			<?php 	
					}else{
						echo "<td style='text-align: center'>----</td>";
						echo "<td style='text-align: center'>----</td>";
					}
					echo "<tr>";
				}
			?>
		</tbody>
	</table>
	</div>

	<div id="wrapper">
	<h2>Tambah Pegawai</h2>
		
	<form action="tambah_pegawai.php" method="POST" accept-charset="utf-8">
	<!-- data pada form diproses di file tambah_film.php -->
		<p>
	  <table>
	  	
		<tr>
			<td>
			Username : 
			</td> 
			<td>
			<input type="text" name="username" value="" placeholder="username" required>
			</td>
		</tr>

		<tr>
			<td>
			Nama : 
			</td> 
			<td>
			<input type="text" name="nama" value="" placeholder="nama" required>
			</td>
		</tr>

		<tr>
			<td>
			Password: 
			</td> 
			<td>
			<input type="text" name="password" value="" placeholder="password" required>
			</td>
		</tr>

		<tr>
			<td>
			</td> 
			<td>
			<input type="submit" name="submit" value="Simpan">
			</td>
		</tr>

	  </table>
	</form>
	</div>
</div>
</body>
</html>


<?php
		}else{
			// header('location: index.php');
		}
	}else{
		// header('location: index.php');
	}
?>