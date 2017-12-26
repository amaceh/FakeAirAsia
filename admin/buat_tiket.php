<?php
	//php untuk membuat file xml
	$k=0;//counter
	$dir="../tiket";//simpan dir
	if(is_dir($dir)){//apakah ada direktorinya?
		$open=opendir($dir);//buka dir
			while (($file=readdir($open))!==false){//jika memang ada
				if($file===$id_tiket.".xml")//jika file sudah ada
					unlink('../tiket'.$id_tiket.'xml');//hapus saja
				$k++;//tambah counter
			}
			closedir($open);//tutup
	}
	//isi file xml
	$xml_text ="<?xml version='1.0'?>\n<tiket>\n";
	$xml_text .="\t<penumpang>\n";
	$xml_text .="\t\t<id_tiket>".$id_tiket."</id_tiket>\n";
	$xml_text .="\t\t<id_jadwal>".$id_jadwal."</id_jadwal>\n";
	$xml_text .="\t\t<no_kursi>".$no_kursi."</no_kursi>\n";
	$xml_text .="\t\t<ktp>".$ktp."</ktp>\n";
	$xml_text .="\t\t<tanggal>".$tanggal."</tanggal>\n";
	$xml_text .="\t\t<jam_berangkat>".$berangkat."</jam_berangkat>\n";
	$xml_text .="\t\t<jam_tiba>".$tiba."</jam_tiba>\n";
	$xml_text .="\t\t<kota_awal>".$kota_awal."</kota_awal>\n";
	$xml_text .="\t\t<kota_tujuan>".$kota_tujuan."</kota_tujuan>\n";
	$xml_text .="\t\t<bandara_awal>".$bandara_awal."</bandara_awal>\n";
	$xml_text .="\t\t<bandara_tujuan>".$bandara_tujuan."</bandara_tujuan>\n";
	$xml_text .="\t</penumpang>\n";
	$xml_text .="</tiket>\n";


	//open, a for create
	$file=fopen('../tiket/'.$id_tiket.'.xml', 'a');
	//menulis di XML
	fwrite($file, $xml_text);
	//close the file handler
	fclose($file);
?>


