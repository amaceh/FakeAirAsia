<?php
	//php connect 
	$username="tubes";
	$password="tubes";
	$database="localhost/XE";
	$koneksi=oci_connect($username, $password, $database);
	if(!$koneksi){//if error
		$err=oci_error();
		echo "Gagal tersambung ke ORACLE". $err['text'];
	}
?>