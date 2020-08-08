<?php
	include "conn.php";
	//session_start();
	//$namamobil=mysqli_real_escape_string($conn,$_GET["namaMobil"]);
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	$username=mysqli_real_escape_string($conn,$_SESSION["id_user"]);
	
	
    $nama = $_GET['nama'];
	$harga = $_GET['harga'];
	$tipebody = $_GET['tipe'];
	$cc = $_GET['cc'];
	$transmisi = $_GET['grouptransmisi'];
	
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	//echo $param;
	
	$q="INSERT INTO historymotorbaru (id_user,parameter,nama,id_transmisi,tipeBody,harga,cc,tanggal) VALUES 
									('$username','$param','$nama','$transmisi','$tipebody','$harga','$cc',SYSDATE())";
	echo $q;
	mysqli_query($conn,$q);
	//header('location: ./motorbaru.php?'.$param);
	$warning="History berhasil diinputkan";
	
	$url='motorbaru.php?'.$param.'&w='.urlencode($warning);
	//echo $url;
	header('location: ./'.$url);
?>