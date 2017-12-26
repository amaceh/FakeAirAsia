<?php
	//php konfirmasi
	if(isset($_POST['pesan'])){//jika ada input
		// include "koneksi.php";//connect DB

		//simpan nama
		$id_jadwal=$_POST['id']; 
		$nama=$_POST['nama'];
		$ktp=$_POST['ktp'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];
		$harga=$_POST['harga']; 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Pilih Paket</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<div id="wrapper" style="width: 700px">
		<div id="tiket">
	<h3>Tinggal Sedikit Lagi</h3>
	Pilih Paket Yang Anda Inginkan<br>
	(1)Paket Reguler<br>
	1x makan<br>
	bagasi 15kg<br>
	RP. 200.000,00<br>
<br>
	(2) Paket Maximal<br>
	2x makan<br>
	1x coffe break<br>
	bagasi 20kg<br>
	RP. 400.000,00<br>

	<form action="proses_pesan.php" method="POST">
		<h2>Pilih Sesuai Kebutuhan Anda</h2>
		<input type="hidden" name="id" value="<?php echo $id_jadwal; ?>">
		<input type="hidden" name="ktp" value="<?php echo $ktp; ?>">
		<input type="hidden" name="nama" value="<?php echo $nama; ?>">
		<input type="hidden" name="alamat" value="<?php echo $alamat; ?>">
		<input type="hidden" name="telepon" value="<?php echo $telepon; ?>">
		<input type="hidden" name="harga" value="<?php echo $harga; ?>">

		<input type="submit" name="pesan" value="Paket Reguler">
		<input type="submit" name="pesan" value="Paket Maximal">
	</form>
	</div>
	</div>
</body>
</html>

<?php }else{
	header('location: index.php');
	} ?>
