<?php
	include "conn.php";
	if (!isset($_SESSION["id_admin"]))
	{
		header("location:loginadmin.php");
	}
	
	
	$idTransmisi="";
	$fkIdTransmisi="";
	if (($_POST["fkIdTransmisi"]) && isset($_POST["idTransmisi"]))
	{
		$idTransmisi=mysqli_real_escape_string($conn,$_POST["idTransmisi"]);
		$fkIdTransmisi=mysqli_real_escape_string($conn,$_POST["fkIdTransmisi"]);
	}
	
	$q="UPDATE Transmisi_crawling SET id_transmisi=$fkIdTransmisi WHERE id=$idTransmisi";
	$res=mysqli_query($conn,$q);
	
	echo "Berhasil Update Data!";
?>
<?php
//<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
?>