<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	$idKota="";
	$fkIdKota="";
	if (($_POST["fkIdKota"]) && isset($_POST["idKota"]))
	{
		$idKota=mysqli_real_escape_string($conn,$_POST["idKota"]);
		$fkIdKota=mysqli_real_escape_string($conn,$_POST["fkIdKota"]);
	}
	
	$q="UPDATE lokasi_crawling SET id_kota=$fkIdKota WHERE id=$idKota";
	$res=mysqli_query($conn,$q);
	
	echo "Berhasil Update Data!";
?>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
?>