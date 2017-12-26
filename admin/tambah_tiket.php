<?php 
	 //cek jika tombol submit ditekan 
if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Simpan') {
			require_once('koneksi.php');//connect DB
			//simpan semua input
			$awal = $_POST['awal']; 
			$akhir = $_POST['tujuan'];
			$nama = $_POST['nama'];
			$ktp = $_POST['ktp'];
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon']; 
			////////////////////////
			
			$query="select *from list_tarif where kota_awal='$awal' and kota_tujuan='$akhir'";//query

			$hasil=oci_parse($koneksi, $query);//compile
			oci_execute($hasil);//eksekusi

			$baris=oci_fetch_assoc($hasil);//simpan hasil eksekusi
			if(oci_num_rows($hasil)>0){
				$id_jadwal=$baris['ID_LIST_TARIF'];

				//////////////////////
				$query="select kursi from jadwal where id_list_tarif='$id_jadwal'";//query
				$hasil=oci_parse($koneksi, $query);//compile
				oci_execute($hasil);//eksekusi
				$baris=oci_fetch_assoc($hasil);//simpan hasil
				$no_kursi=$baris['KURSI'];

				$query="select harga from list_tarif where id_list_tarif='$id_jadwal'";//query
				$hasil=oci_parse($koneksi, $query);//compile
				oci_execute($hasil);//eksekusi
				$baris2=oci_fetch_assoc($hasil);//simpan hasil
				$harga=$baris2['HARGA'];
				if ($no_kursi<=180) {
					$query = "insert into penumpang values('$ktp', '$nama', '$alamat', '$telepon')";
				$hasil=oci_parse($koneksi, $query);//compile
				oci_execute($hasil);//eksekusi

				$query = "insert into tiket values(seq_id_tiket.nextval, '$id_jadwal', '$no_kursi', '$ktp', '0', '$harga')";//not yet pay
				$hasil=oci_parse($koneksi, $query);//compile
				oci_execute($hasil);//eksekusi
				if (oci_num_rows($hasil)>0) {
					
					$query="select id_tiket from tiket where no_ktp='$ktp'";//query
					$hasil=oci_parse($koneksi, $query);//compile
					oci_execute($hasil);//eksekusi
					$baris2=oci_fetch_assoc($hasil);//simpan hasil
					$id_tiket=$baris2['ID_TIKET'];

					$query="begin harga(:param1,:param2); end;";//query
					$hasil=oci_parse($koneksi, $query);//compile
					oci_bind_by_name($hasil, ':param1', $id_tiket);
					if ($_POST['paket']=="Reguler") {
						$tarif='Reguler';
					}else{
						$tarif='Max';
						
					}
					oci_bind_by_name($hasil, ':param2', $tarif);
					// var_dump($query);
					oci_execute($hasil);
					
				}
			}
		}

			if (oci_num_rows($hasil)>0) {//jika ada data yang ditambah
				header('location: loket.php');//kembali ke beranda
			}else{//jika tidak
				echo "Data tidak tersimpan. silahkan <a href=\"loket.php\">coba lagi</a>";//error message
			}
		}else{
			header('location: loket.php');
		}
	}else{
		header('location: loket.php');
	}
	?>