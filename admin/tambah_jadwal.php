<?php 
	 //cek jika tombol submit ditekan 
if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Simpan') {
			require_once('koneksi.php');//connect DB
			//simpan semua input
			$id_jadwal = $_POST['jadwal']; 
			$id_argo = $_POST['perjalanan'];
			$berangkat = $_POST['awal'];
			$tiba = $_POST['akhir'];
			$tanggal = $_POST['tanggal'];
			////////////////////////
			
			$query="insert into jadwal values('$id_jadwal', '$id_argo', '$berangkat', '$tiba', '$tanggal', 1)";//query

			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);//eksekusi

			$baris=oci_fetch_assoc($hasil);//simpan hasil eksekusi
			

			if (oci_num_rows($hasil)>0) {//jika ada data yang ditambah
				header('location: admin.php');//kembali ke beranda
			}else{//jika tidak
				echo "Data tidak tersimpan. silahkan <a href=\"admin.php\">coba lagi</a>";//error message
			}
		}else{
			header('location: admin.php');
		}
	}else{
		header('location: admin.php');
	}
	?>