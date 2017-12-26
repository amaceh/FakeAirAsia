<?php
	//php konfirmasi
	if(isset($_POST['ord2'])){//jika ada input
		// include "koneksi.php";//connect DB

		//simpan nama
		$id_jadwal=$_POST['id']; 
		$jam_berangkat=$_POST['berangkat']; 
		$jam_tiba=$_POST['tiba'];
		$harga=$_POST['harga']; 
		$kota_awal=$_POST['awal']; 
		$kota_akhir=$_POST['akhir']; 
		$nama=$_POST['nama'];
		$ktp=$_POST['ktp'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];


?>

<!DOCTYPE html>
<html>
<head>
	<title>Tiket Anda</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<div id="wrapper" style="width: 700px">
		<div id="tiket">
	<h3>Berikut Data Tiket Anda</h3>
	Harap Periksa Data yang tercantum agar sesuai dengan data diri anda maupun tiket yang anda pesan.
	<br>	
<center>	
  <table border="0">
  		<tr>	
  				<td>
					Nama  
  				</td>
  				<td>	
					: <?php echo $nama; ?>
  				</td>
  		</tr>
  		<tr>	
  				<td>
	No KTP 
				</td>
  				<td>	
	: <?php echo $ktp; ?>
				</td>
  		</tr>
  		<tr>	
  				<td>
	Jadwal  
				</td>
  				<td>	
	: <?php echo $jam_berangkat; ?> - <?php echo $jam_tiba; ?> 
				</td>
  		</tr>
  		<tr>	
  				<td>
	Kota Awal  
				</td>
  				<td>	
	: <?php echo $kota_awal; ?> 
				</td>
  		</tr>
  		<tr>	
  				<td>
	Kota Tujuan 
				</td>
  				<td>	
	: <?php echo $kota_akhir; ?>
				</td>
  		</tr>
  		<tr>	
  				<td>
	<?php  
		$hargaint=(int)$harga;//casting, somehow harga dianggap string, need a casting
	?>
	Harga 
				</td>
  				<td>	
	: RP. <?php echo number_format($hargaint, 2); ?>
				</td>
  		</tr>
	<!-- buat cek aja -->
</center>
</table>
	<?php //echo $id_jadwal; ?>

	<form action="pilih_paket.php" method="POST">
		<h2>Lanjutkan Pemesanan?</h2>
		<input type="hidden" name="id" value="<?php echo $id_jadwal; ?>">
		<input type="hidden" name="ktp" value="<?php echo $ktp; ?>">
		<input type="hidden" name="nama" value="<?php echo $nama; ?>">
		<input type="hidden" name="alamat" value="<?php echo $alamat; ?>">
		<input type="hidden" name="telepon" value="<?php echo $telepon; ?>">
		<input type="hidden" name="harga" value="<?php echo $harga; ?>">		
		<input type="submit" name="pesan" value="Pesan Tiket">
	</form>
	</div>
	</div>
</body>
</html>

<?php }else{
	header('location: index.php');
	} ?>
