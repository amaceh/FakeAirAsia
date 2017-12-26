<?php  
	if ($_POST['ord1']) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Penumpang</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form  action="tiket.php" method="POST" >
	
<ul>

<div id ="wrapper" style="height: 600px">
	<h2>Biodata Penumpang</h2>
	Isilah Biodata dibawah ini sebagai salah satu syarat pemesanan tiket.
	<center>	
	<table>	
	<tr>	
			<td>
	Nama Lengkap : 
			</td> 
			<td>	
	<input type="text" name="nama" placeholder="nama" required></li>
			</td>
	</tr>

	<tr>	
			<td>
	No KTP : 
			</td> 
			<td>
	<input type="text" name="ktp" placeholder="NO KTP" required></li>
			</td>
	</tr>
	<tr>	
			<td>
	Alamat : 
			</td> 
			<td>
	<input type="textbox" name="alamat" placeholder="Alamat" required></li>
			</td>
	</tr>
	<tr>	
			<td>
	No Telp : 
			</td> 
			<td>
	<input type="textbox" name="telepon" placeholder="No Telepon" required>
			</td>
	</tr>
	<tr>
	<td>	</td>	
	<td>	
	<input type="submit" name="ord2" value="lanjut">
	</td>	
	</tr>

	<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
	<input type="hidden" name="berangkat" value="<?php echo $_POST['berangkat']; ?>">
	<input type="hidden" name="harga" value="<?php echo $_POST['harga']; ?>">
	<input type="hidden" name="tiba" value="<?php echo $_POST['tiba']; ?>">
	<input type="hidden" name="awal" value="<?php echo $_POST['awal']; ?>">
	<input type="hidden" name="akhir" value="<?php echo $_POST['akhir']; ?>">
	<input type="hidden" name="harga" value="<?php echo $_POST['harga']; ?>">

	</table>
	</center>
</div>
	

</ul>
</form>

</body>
</html>
<?php  
	}else{
		header('location: index.php');
	}
?>