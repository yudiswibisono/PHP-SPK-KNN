<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	$idWarna="";
	$fkIdWarna="";
	if (($_POST["fkIdWarna"]) && isset($_POST["idWarna"]))
	{
		$idWarna=mysqli_real_escape_string($conn,$_POST["idWarna"]);
		$fkIdWarna=mysqli_real_escape_string($conn,$_POST["fkIdWarna"]);
	}
	
	$q="UPDATE warna_crawling SET id_warna=$fkIdWarna WHERE id=$idWarna";
	$res=mysqli_query($conn,$q);
	
	echo "Berhasil Update Data!";
?>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
?>