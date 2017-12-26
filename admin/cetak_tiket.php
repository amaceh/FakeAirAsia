<?php  
	//default value
	$exist=false;
	$result=NULL;
	$direktori="../tiket";//simpan direktori
	$id=$_GET['id'];//simpan id
	
	if(is_dir($direktori)){//jika direktori ada
		if($handle=opendir($direktori)){
			//tampilkan semua file dalam folder
			while(($file=readdir($handle))!==false){
				if($file==$id.'.xml'){
					//menggunakan simplexml_load_file function untuk load file xml
					if($xml=simplexml_load_file($direktori.'/'.$file)){
						foreach ($xml as $record){//parse the xml file into object
							$id_tiket=$record->id_tiket;
							$id_jadwal=$record->id_jadwal;
							$no_kursi=$record->no_kursi;
							$ktp=$record->ktp;
							$tanggal=$record->tanggal;
							$berangkat=$record->jam_berangkat;
							$tiba=$record->jam_tiba;
							$kota_awal=$record->kota_awal;
							$kota_tujuan=$record->kota_tujuan;
							$bandara_awal=$record->bandara_awal;
							$bandara_tujuan=$record->bandara_tujuan;

							// var_dump($xml->$value->{'id_tiket'});
							$exist=true;
							//menyimpan ke database
							// $q="update transaksi set status='$status' where id_tiket=$id_tiket";//query
							// $result=oci_parse($koneksi, $q);//compiler
							// oci_execute($result);//execute
						}
					}
				}
			}
			closedir($handle);//tutup
		}
	}
	// var_dump($xml);
	if ($exist==true) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>tiket <?php echo $id_tiket; ?></title>
			<style type="text/css">
				*{
					font-family: 'Calibry';
				}
				.wrapper{
					border-style: solid;
					width: 400px;
					height: 500px;
				}
				.header{
					background-color: red;
					color: white;
					height: 80px;
					text-align: center;
					line-height: 80px;
					vertical-align: middle;
				}
				.body{
					/*position: relative;*/
					font-size: 14pt;
					/*background-color: lime;*/
					/*color: white;*/
					padding-top: 20px;
					padding-left: 20px;
				}
			</style>
		</head>
		<body>
			<div class="wrapper">
				<div class="header">
					<h2>AirAsia Boarding Pass</h2>
				</div>
				<div class="body">
					NO TIKET : <?php echo $id_tiket;  ?><br>
					KODE JADWAL : <?php echo $id_jadwal;  ?><br>
					NO KURSI : <?php echo $no_kursi;  ?><br>
					NO IDENTITAS : <?php echo $ktp;  ?><br>
					Tanggal : <?php echo $tanggal; ?> <br>
					Waktu Perjalanan <?php echo $berangkat."-".$tiba; ?><br>
					Awal : <br>
					Bandara <?php echo $bandara_awal; ?><br>
					<?php echo $kota_awal; ?><br>
					Tujuan : <br>
					Bandara <?php echo $bandara_tujuan; ?><br>
					<?php echo $kota_tujuan; ?><br>

				</div>
			</div>
		</body>
		</html>
		<?php
	}else{
		echo "<h2>Mohon maaf, Tiket baru bisa dicetak setelah pelanggan membayar.</h2>";
		echo "<br><a href='loket.php'>Kembali....</a>";
	}
?>