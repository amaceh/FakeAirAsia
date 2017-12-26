<?php
	if (isset($_POST['login'])) {
	session_start();//mulai sesi
	require_once('koneksi.php');//hubungkan dengan DB
	
	$username=$_POST['username'];
	$pass=$_POST['password'];	

	$query="select * from pegawai where username='$username' and password='$pass'";//query
	$hasil=oci_parse($koneksi, $query);//compile
	oci_execute($hasil);//eksekusi
	$baris=oci_fetch_assoc($hasil);//simpan hasil eksekusi
	// var_dump($username);
	if(oci_num_rows($hasil)>0){
		$username=$baris['USERNAME'];
		$_SESSION['nama']=$baris['NAMA'];
		$_SESSION['log']=TRUE;
		if ($username=="admin") {
			//to admin page
			header('location: admin.php');
		}else{
			//to cashier page
			header('location: loket.php');
		}
	}else{
		echo "Username atau Password Salah";
		echo "<br><a href='index.php'>Login Kembali?</a>";

	}

	}else{
		header('location: index.php');
	}  
?>