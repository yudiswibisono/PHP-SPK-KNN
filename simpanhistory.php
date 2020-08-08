<?php
	include "conn.php";
	//session_start();
	//$namamobil=mysqli_real_escape_string($conn,$_GET["namaMobil"]);
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	$username=mysqli_real_escape_string($conn,$_SESSION["id_user"]);
	
	
    $nama = $_GET['namaMobil'];
	$harga = $_GET['harga'];
	$kota = $_GET['groupkota'];
	$tahun = $_GET['tahun'];
	$bahanbakar = $_GET['groupbk'];
	$transmisi = $_GET['grouptransmisi'];
	$warna = $_GET['warna'];
	$jtempuh = $_GET['jaraktempuh'];
	$param=mysqli_real_escape_string($conn,$_SERVER["QUERY_STRING"]);
	//echo $param;
	
	$q="INSERT INTO historymobilbekas (id_user,parameter,nama,kota,harga,tahun,id_bahanbk,id_transmisi,id_warna,jaraktempuh,tanggal) VALUES 
									('$username','$param','$nama','$kota','$harga','$tahun','$bahanbakar','$transmisi','$warna','$jtempuh',SYSDATE())";
	echo $q;
	mysqli_query($conn,$q);
	
	$warning="History berhasil diinputkan";
	
	$url='mobilbekas.php?'.$param.'&w='.urlencode($warning);
	//echo $url;
	//header('location: ./'.$url);
?>