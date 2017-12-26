<?php 
	session_start();//mulai sesi
		if ($_SESSION['log']!=TRUE) {//jika belum login
			header('location: index.php');
		}else if (!isset($_GET['id'])) {//jika id kosong
			header('location: admin.php');
		}else{
			require_once('koneksi.php');//connect DB

			$id=$_GET['id'];//simpan id
			$q="delete from jadwal where id_jadwal='$id'";//query

			$data=oci_parse($koneksi, $q);//compile
			oci_execute($data);//execute

			if (oci_num_rows($data)>0) {//jika ada data yang terhapus
				?>

				<h3>Jadwal Telah Dihapus</h3>
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