<?php
	$localhost = "localhost";
	$user = "root";
	$password = "";
	$namedb = "midtransphpaka91";
	$mysqli = new mysqli($localhost,$user,$password,$namedb);
	$conn = mysqli_connect($localhost, $user, $password, $namedb);
	
	if (!$conn)
	{
		die("KONEKSI GAGAL" . mysqli_connect_error());
	}

?>