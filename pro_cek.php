<?php
	//php konfirmasi
	if(isset($_POST['cek'])){//jika ada input
		session_start();//mulai sesi
		include "koneksi.php";//connect DB

		//simpan nama
		$kode=$_POST['kode'];
		$query="select *from tiket where id_tiket='$kode'";//query

		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi

		$baris=oci_fetch_assoc($hasil);//simpan hasil eksekusi
		if(oci_num_rows($hasil)>0){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasil Cek</title>
</head>
<body>
	<h2>Tiket anda sudah direservasi, berikut data tiket anda</h2>
	NO TIKET : <?php echo $baris['ID_TIKET']; ?> <br>
	KODE JADWAL : <?php echo $baris['ID_JADWAL']; ?> <br>
	NO KURSI : <?php echo $baris['NO_KURSI']; ?> <br>
	NO IDENTITAS : <?php echo $baris['NO_KTP']; ?> <br>
	STATUS PEMBAYARAN : <?php 
		if ($baris['STATUS']==0) {
			echo "Belum Bayar<br>";
			echo "Kembali <a href='index.php'>Ke Beranda</a>";

		}else{
			echo "Sudah Bayar";
			echo " | <a href='admin/cetak_tiket.php?id=".$baris['ID_TIKET']."'>Cetak TIKET</a>";
			echo "<br>Kembali <a href='index.php'>Ke Beranda</a>";
		}?> <br>
</body>
</html>

<?php  
	}else{
		echo "<h2>Mohon Maaf, kode tiket anda tidak valid atau belum ada</h2>";
		echo "Mau Memesan <a href='index.php'>Tiket Lain?</a>";
		// header('location: index.php');
	}
}else{
		header('location: index.php');
}
?>