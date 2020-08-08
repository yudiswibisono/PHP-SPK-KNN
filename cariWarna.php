<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	$idBahanBk="";
	$fkIdBahanBk="";
	if (($_POST["fkIdBahanBk"]) && isset($_POST["idBahanBk"]))
	{
		$idBahanBk=mysqli_real_escape_string($conn,$_POST["idBahanBk"]);
		$fkIdBahanBk=mysqli_real_escape_string($conn,$_POST["fkIdBahanBk"]);
	}
	
	$q="UPDATE bahanbk_crawling SET id_bahanbk=$fkIdBahanBk WHERE id=$idBahanBk";
	$res=mysqli_query($conn,$q);
	
	echo $q;
?>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
?>