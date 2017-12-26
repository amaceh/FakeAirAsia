<?php 
	 //cek jika tombol submit ditekan 
if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Simpan') {
			require_once('koneksi.php');//connect DB
			//simpan semua input
			$username=$_POST['username'];
			$nama=$_POST['nama'];
			$password=$_POST['password'];
			////////////////////////
			
			$query="insert into pegawai values('$username', '$nama', '$password')";//query

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