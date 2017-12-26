<?php 
	session_start();//mulai sesi
		if ($_SESSION['log']!=TRUE) {//jika belum login
			header('location: index.php');
		}else if (!isset($_GET['id'])) {//jika id kosong
			header('location: loket.php');
		}else{
			require_once('koneksi.php');//connect DB

			$id=$_GET['id'];//simpan id
			$ktp=$_GET['ktp'];//simpan ktp

			// var_dump($id);
			$query = "insert into bayar values(seq_id_bayar.nextval, '$ktp', '$id', sysdate)";
			$hasilx=oci_parse($koneksi, $query);//compile
			oci_execute($hasilx);

			$query = "select *from tiket WHERE id_tiket='$id'";
			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);

			$baris=oci_fetch_assoc($hasil);//simpan hasil
			$id_tiket=$baris['ID_TIKET'];
			$id_jadwal=$baris['ID_JADWAL'];
			$no_kursi=$baris['NO_KURSI'];
			$ktp=$baris['NO_KTP'];

			//////////////////////////
			$query = "select *from jadwal WHERE id_list_tarif='$id_jadwal'";
			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);
			
			$baris=oci_fetch_assoc($hasil);//simpan hasil
			$berangkat=$baris['JADWAL_BERANGKAT'];
			$tiba=$baris['JADWAL_TIBA'];
			$tanggal=$baris['TANGGAL'];

			$query = "select *from list_tarif WHERE id_list_tarif='$id_jadwal'";
			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);
			
			$baris=oci_fetch_assoc($hasil);//simpan hasil
			$kota_awal=$baris['KOTA_AWAL'];
			$kota_tujuan=$baris['KOTA_TUJUAN'];

			$query = "select nama_bandara from bandara WHERE kota='$kota_awal'";
			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);
			
			$baris=oci_fetch_assoc($hasil);//simpan hasil
			$bandara_awal=$baris['NAMA_BANDARA'];

			$query = "select nama_bandara from bandara WHERE kota='$kota_tujuan'";
			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);
			
			$baris=oci_fetch_assoc($hasil);//simpan hasil
			$bandara_tujuan=$baris['NAMA_BANDARA'];

			include "buat_tiket.php";

			if (oci_num_rows($hasilx)>0) {//jika ada data yang terhapus
				header('location: loket.php');//kembali ke beranda
			}else{
?>

			Pembayaran Gagal. Silahkan <a href="loket.php">coba lagi</a>
			<!-- error message -->
<?php 
			}
		}
?>