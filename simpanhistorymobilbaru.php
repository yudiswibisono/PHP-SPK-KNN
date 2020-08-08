<?php
	include "conn.php";
	//session_start();
	//$namamobil=mysqli_real_escape_string($conn,$_GET["namaMobil"]);
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	$username=mysqli_real_escape_string($conn,$_SESSION["id_user"]);
	
	
    $nama = $_GET['namaMobil'];
	$harga = $_GET['harga'];
	$tipebody = $_GET['tipe'];
	$bahanbakar = $_GET['groupbk'];
	$transmisi = $_GET['grouptransmisi'];
	
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	//echo $param;
	
	$q="INSERT INTO historymobilbaru (id_user,parameter,nama,tipebody,harga,id_bahanbk,id_transmisi,tanggal) VALUES 
									('$username','$param','$nama','$tipebody','$harga','$bahanbakar','$transmisi',SYSDATE())";
	echo $q;
	mysqli_query($conn,$q);
	header('location: ./mobilbaru.php?'.$param);
	
	$warning="History berhasil diinputkan";
	
	$url='mobilbaru.php?'.$param.'&w='.urlencode($warning);
	//echo $url;
	//header('location: ./'.$url);
?>
?>