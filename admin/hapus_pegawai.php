<?php 
	session_start();//mulai sesi
		if ($_SESSION['log']!=TRUE) {//jika belum login
			header('location: index.php');
		}else if (!isset($_GET['id'])) {//jika id kosong
			header('location: admin.php');
		}else{
			require_once('koneksi.php');//connect DB

			$id=$_GET['id'];//simpan id
			$q="delete from pegawai where username='$id'";//query

			$data=oci_parse($koneksi, $q);//compile
			oci_execute($data);//execute

			if (oci_num_rows($data)>0) {//jika ada data yang terhapus
				?>
				<center>
					
				<div id="wrapper">
				<h3>Pegawai Telah Dihapus</h3>
					
				</div>
				</center>
				<?php
				// header('location: index.php');//kembali ke beranda
				echo "<br><a href='admin.php'>Kembali</a>";
			}else{
?>

			Data tidak terhapus. Silahkan <a href="admin.php">coba lagi</a>
			<!-- error message -->
<?php 
			}
		}
?>