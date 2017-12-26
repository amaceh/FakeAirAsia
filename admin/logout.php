<?php 
	session_start();//mulai sesi
	session_destroy();//hapus data sesi(untuk legin kembali/logout)
?>

<!-- tampilan logout -->
<style type="text/css" media="screen">
	/*sedikit css, class logout*/
	.logout{
		width: 90%;
		margin: auto auto;
	}
</style>
<div class="logout">
<!-- tulisan logout, dan link untuk login kembali -->
	Anda telah logout. Sampai jumpa :)<br>
	<a href="index.php">Login</a>
</div>