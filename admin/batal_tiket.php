<?php 
	session_start();//mulai sesi
		if ($_SESSION['log']!=TRUE) {//jika belum login
			header('location: index.php');
		}else if (!isset($_GET['id'])) {//jika id kosong
			header('location: loket.php');
		}else{
			require_once('koneksi.php');//connect DB

			$id=$_GET['id'];//simpan id
			$q="delete from tiket where id_tiket=$id";//query

			$data=oci_parse($koneksi, $q);//compile
			oci_execute($data);//execute

			if (oci_num_rows($data)>0) {//jika ada data yang terhapus
				//make some trigger then
				?>

				<h3>Reservasi Telah Dibatalkan</h3>
				Ingatkan Pelanggan Jika Tiket sudah dibayar maka refund memerlukan waktu 45 hari kerja dan refund hanya sebesar 75 Persen.
				<?php
				// header('location: index.php');//kembali ke beranda
				echo "<br><a href='loket.php'>Kembali</a>";
			}else{
?>

			Data tidak terhapus. Silahkan <a href="loket.php">coba lagi</a>
			<!-- error message -->
<?php 
			}
		}
?>