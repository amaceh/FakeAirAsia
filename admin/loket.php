<?php  
	session_start();//mulai session
	require_once('koneksi.php');//hubungkan dengan DB
	//login atau belum
	if (isset($_SESSION['log'])) {
		if ($_SESSION['log'] != TRUE) {//jika belum login
			header('location: index.php');//lempar ke halaman login
		}
	}else header('location: index.php');//lempar ke halaman login

	$nama = $_SESSION['nama'];//simpan nama

	//ambil data film
	// $q = "SELECT *FROM FILM";//somehow didnt work
	//ambil semua data
	$data = oci_parse($koneksi, 'SELECT *FROM tiket');//compile
	oci_execute($data);//execute
	$row = oci_fetch_all($data, $hasil);//simpan jumlah data
	$tiket = array();//buat array kosong

	if ($row > 0) {//jika tabel tidak kosong
		oci_execute($data);//eksekusi lagi
		while ($r = oci_fetch_array($data)) {//loop hingga false
			$tiket[] = $r;
		}//simpan semua data
	}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Tampilan HALAMAN BERANDA -->
	<link rel="stylesheet" type="text/css" href="admin.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<title>Menu Loket</title>
	<!-- seikit css untuk merapihkan -->
	<style type="text/css" media="screen">
		width: 90%;
		margin: auto;
	</style>
</head>


<body>
	<!-- tampilan nama dan link logout -->
	<p align="right">
		Hai <?php echo $nama; ?> | <a href="logout.php" title="">Logout</a> 
	</p>
	<!-- judul -->
	<h1>Selamat Datang, Selamat Bertugas</h1>
	<center>
	<!-- data pada form diproses di file tambah_film.php -->
	<div id="papan">
		<h3>Tiket Yang sudah Direservasi</h3>
	<table border="1">
		<thead>
			<tr>
				<!-- kolom atas -->
				<th>No Tiket</th>
				<th>ID Jadwal</th>
				<th>No Kursi</th>
				<th>No KTP</th>
				<th>Status Pembayaran</th>
				<th>Total-Harga</th>
				<th>Perintah</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				//tampilkan tiap data didalam tabel
				foreach ($tiket as $value) {
					echo "<tr>";
					echo "<td>" .$value['ID_TIKET']." </td>";
					echo "<td>" .$value['ID_JADWAL']. "</td>";
					echo "<td>" .$value['NO_KURSI']." </td>";
					echo "<td>" .$value['NO_KTP']." </td>";
					// echo "<td>" .$value[STATUS]." </td>";
					if ($value['STATUS']=='0') {
						echo "<td>Belum Bayar</td>";
					}else{
						echo "<td>Lunas</td>";
					}
					echo "<td>" .$value['TOTAL_BAYAR']." </td>";
			?>
					<!-- tampilan link edit dan link hapus -->
					<td><a href="bayar_tiket.php?id=<?php echo$value['ID_TIKET']; ?>&ktp=<?php echo$value['NO_KTP']; ?>">Bayar</a> | <a href="batal_tiket.php?id=<?php echo$value['ID_TIKET']; ?>">Cancel</a> | <a href="cetak_tiket.php?id=<?php echo$value['ID_TIKET']; ?>">Cetak</a></td>
			<?php 	
					echo "<tr>";
				}
			?>
		</tbody>
	</table>

	*Hanya Tiket yang sudah Lunas yang bisa dicetak
	</div>
	<div id="wrapper">
	<h3>Tambah reservasi Tiket</h3>
	<form action="tambah_tiket.php" method="POST" accept-charset="utf-8">

		<table>
			<tr>
				<td>
					Asal : 
				</td> 
				<td>
					<input type="text" name="awal" value="" placeholder="Asal" required>
				</td>
			</tr>
			
			<tr>
				<td>
					Tujuan : 
				</td> 
				<td>
					<input type="text" name="tujuan" value="" placeholder="Tujuan" required>	
				</td>
			</tr>
			
			<tr>
				<td>
				Nama Lengkap  : 
					
				</td> 
				<td>
					<input type="text" name="nama" value="" placeholder="Nama Lengkap" required>
				</td>
			</tr>
			<tr>
				<td>
			No KTP : 
					
				</td> 
				<td>
			<input type="text" name="ktp" value="" placeholder="No KTP" required>
					
				</td>
			</tr>
			<tr>
				<td>
			Alamat : 
					
				</td> 
				<td>
			<input type="text" name="alamat" value="" placeholder="Alamat" required>
					
				</td>
			</tr>
			<tr>
				<td>
			NO. Telp : 
					
				</td> 
				<td>
			<input type="text" name="telepon" value="" placeholder="No Telepon" required>
					
				</td>
			</tr>
			<tr>
				<td>
			Pilihan Paket : 
					
				</td> 
				<td>
			<select name="paket">
				<option value="Reguler" selected>Reguler</option>
				<option value="Max">Maximal</option>
			</select>
					
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
				<input type="submit" name="submit" value="Simpan">
				</td>
			</tr>
			
		</table>
		
	</form>
	</div>
	</center>
	<!-- form untuk menambah film -->
	<br>
	<!-- tampilan data film yang sudah ada -->
	<center>
		
	
  </center>
</body>
</html>

