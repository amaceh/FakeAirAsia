<?php 
	session_start();//mulai sesi
	require_once('koneksi.php');//connect DB
	
	$id_jadwal=$_POST['jadwal'];
	$id_jalan=$_POST['perjalanan'];
	$berangkat=$_POST['awal'];
	$sampai=$_POST['akhir'];
	$harga=$_POST['harga'];

	$query = "UPDATE jadwal SET id_list_argo='$id_jalan', jadwal_berangkat='$berangkat', jadwal_tiba='$sampai', harga='$harga' WHERE id_jadwal='$id_jadwal'";
	$hasil=oci_parse($koneksi, $query);//compile
	oci_execute($hasil);

	if (oci_num_rows($hasil)>0) {//jika ada teredit
		header('location: admin.php');//kembali ke beranda
	}else{
?>

	Edit Gagal <a href="admin.php">coba lagi</a>
	<!-- error message -->
<?php 
			
		}
?>