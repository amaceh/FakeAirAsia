<!DOCTYPE html>
<html>
<head>
	<title>AirAsia</title>
	<center><h1>Tiket Pesawat</h1></center>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<center>
		
	<form action="search.php" method="POST">
		<div id="wrapper">
		<center>
			
		<table>
			<tr>
				<td>
				<input type="text" tabindex="4" placeholder="Asal" name="berangkat" required>
				</td>
			</tr>
			<tr>
				<td>
				<input type="text" tabindex="4" placeholder="Tujuan" name="tujuan" required>
				</td>
			</tr>
			<tr>
				<td>
				</td>
			</tr>
		</table>
				<input type="submit" name="search" value="Cari">
		
		</center>
	</form>
		Cek <a href="cek.php">Status &amp; Cetak</a> Tiket Anda
	</center>
	</div>



</body>
</html>