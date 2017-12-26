<?php 
	session_start();//mulai sesi
	require_once('koneksi.php');//connect DB
	
	$username=$_POST['username'];
	$nama=$_POST['nama'];
	$password=$_POST['pass'];

	$query = "UPDATE pegawai SET nama='$nama', password='$password' WHERE username='$username'";
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