<?php
	//php konfirmasi
	if(isset($_POST['search'])){//jika ada input
		session_start();//mulai sesi
		include "koneksi.php";//connect DB

		//simpan nama
		$berangkat=$_POST['berangkat'];
		$tujuan=$_POST['tujuan'];
		$query="select *from list_tarif where kota_awal='$berangkat' and kota_tujuan='$tujuan'";//query

		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi

		$baris=oci_fetch_assoc($hasil);//simpan hasil eksekusi
		if(oci_num_rows($hasil)>0){

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pencarian Jurusan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="wrapper">
		<div id="cari">
	<h2>Tiket untuk tujuan yang anda pilih tersedia!</h2>
	<br>
	Tujuan : <?php echo $baris['KOTA_AWAL']." - ".$baris['KOTA_TUJUAN'];?>
	<br>
	Harga : RP. <?php  echo number_format($baris['HARGA'], 2);?>
	<br>
	<?php  
		$cek=$baris['ID_LIST_TARIF'];
		$query="select * from jadwal where id_list_tarif='$cek'";//query

		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi

		$baris2=oci_fetch_assoc($hasil);//simpan hasil
		// echo $cek;
		if (oci_num_rows($hasil)>0) {
			echo "Waktu Perjalanan : ".$baris2['JADWAL_BERANGKAT']."-".$baris2['JADWAL_TIBA'];
			echo "<br>";
		}else{
			echo "<h2>Tidak ada jadwal</h2>";
			echo "Mau Mencoba Mencari <a href='index.php'>Tujuan lain</a>";
		}
	?>
	<form  action="bio_penumpang.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $baris['ID_LIST_TARIF']; ?>">
		<input type="hidden" name="berangkat" value="<?php echo $baris2['JADWAL_BERANGKAT']; ?>">
		<input type="hidden" name="harga" value="<?php echo $baris['HARGA']; ?>">
		<input type="hidden" name="tiba" value="<?php echo $baris2['JADWAL_TIBA']; ?>">
		<input type="hidden" name="awal" value="<?php echo $baris['KOTA_AWAL']; ?>">
		<input type="hidden" name="akhir" value="<?php echo $baris['KOTA_TUJUAN']; ?>">
		<input type="hidden" name="harga" value="<?php echo $baris['HARGA']; ?>">

		<h3>Mau Memesan?</h3>
		<input type="submit" name="ord1" value="Lanjut">
	</form>
	<!-- <button>Lanjut</button> -->
	</div>	
	</div>
</body>
</html>

<?php  
	}else{
		echo "<h2>Mohon Maaf, Tidak ada penerbangan dengan tujuan yang anda maksud</h2>";
		echo "Mau Mencoba Mencari <a href='index.php'>Tujuan lain</a>";
		// header('location: index.php');
	}
}else{
		header('location: index.php');
}
?>