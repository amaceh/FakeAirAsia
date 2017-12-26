<?php 
	if(isset($_POST['pesan'])){
		include "koneksi.php";//connect DB
		$id_jadwal=$_POST['id']; 
		$nama=$_POST['nama'];
		$ktp=$_POST['ktp'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];
		$harga=$_POST['harga'];


		$query="select kursi from jadwal where id_list_tarif='$id_jadwal'";//query
		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi
		$baris=oci_fetch_assoc($hasil);//simpan hasil
		$no_kursi=$baris['KURSI'];
		if ($no_kursi<=180) {
		$query = "insert into penumpang values('$ktp', '$nama', '$alamat', '$telepon')";
		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi
			
		$query = "insert into tiket values(seq_id_tiket.nextval, '$id_jadwal', '$no_kursi', '$ktp', '0', $harga)";//not yet pay
		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi
			if (oci_num_rows($hasil)>0) {
			// $no_kursi=$no_kursi+1;
			// $query = "UPDATE jadwal SET kursi='$no_kursi' WHERE id_list_tarif='$id_jadwal'";
			// $hasil=oci_parse($koneksi, $query);//compile
			// oci_execute($hasil);
						
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Tiket</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="wrapper">
<?php
		$query="select id_tiket from tiket where no_ktp='$ktp'";//query
		$hasil=oci_parse($koneksi, $query);//compile
		oci_execute($hasil);//eksekusi
		$baris=oci_fetch_assoc($hasil);//simpan hasil

		echo "Proses Pesan Berhasil !";
		echo "Berikut Data Reservasi Anda, Harap dicatat agar proses pembayaran lebih mudah";
		echo "<br>";
		echo "<br>KODE TIKET : ".$baris['ID_TIKET'];
		echo "<br>";
		echo "<br>KODE JADWAL : ".$id_jadwal;
		echo "<br>";
		echo "<br>NO KURSI : ".$no_kursi;
		echo "<br>";
		echo "<br>NO IDENTITAS : ".$ktp;
		echo "<br>";
		echo "<br>STATUS PEMBAYARAN :"." Belum Bayar";
		echo "<br>";
		echo "<br>";

		/*
			$sql = 'BEGIN procedureName(:param1, :param2); END;';
			$stmt_id = oci_parse($connection, $sql);
			oci_bind_by_name($stmt_id, ':param1', $value1);
			oci_bind_by_name($stmt_id, ':param2', $value2);
			oci_execute($stmt_id);

			exec harga({$baris['ID_TIKET']},'Reguler')
		*/
		$query="begin harga(:param1,:param2); end;";//query
		$hasil=oci_parse($koneksi, $query);//compile
		oci_bind_by_name($hasil, ':param1', $baris['ID_TIKET']);
		if ($_POST['pesan']=="Paket Reguler") {
			$tarif='Reguler';
		}else{
			$tarif='Max';
			
		}
		oci_bind_by_name($hasil, ':param2', $tarif);
		// var_dump($query);
		oci_execute($hasil);

		echo "<br><a href='index.php'>Kembali Ke Beranda</a>";
		}else{
			echo "<h2>Mohon Maaf, Terjadi Kesalahan Pada Proses Reservasi</h2>";
			echo "<br><a href='index.php'>Kembali Ke Beranda</a>";
		}
	}else{
		echo "<h2>Mohon Maaf, Tidak ada Kursi Tersisa</h2>";
		echo "<br><a href='index.php'>Kembali Ke Beranda</a>";
	} 
 ?>
</div>
</body>
</html>

<?php 
	}else{
		header('location: index.php');
	}
?>