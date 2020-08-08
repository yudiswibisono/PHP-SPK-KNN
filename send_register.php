<?php
include "conn.php";
if (isset($_POST['username']) && $_POST['username']) {
    // memasukan file koneksi ke database
    require_once 'conn.php';
    // menyimpan variable yang dikirim Form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    // cek nilai variable

    if (empty($username)) {
        header('location: ./daftaruser.php?error=' .base64_encode('Username tidak boleh kosong'));   
    }
    if (empty($password)) {
        header('location: ./daftaruser.php?error=' .base64_encode('Password tidak boleh kosong'));   
    }
    // validasi apakah password dengan repassword sama
    if ($password != $repassword) { // jika tidak sama
        header('location: ./daftaruser.php?error=' .base64_encode('Password tidak boleh sama'));   
    }
     
	 $q="SELECT * FROM user WHERE username='$username'";
	 $res=mysqli_query($conn,$q);
	 
	 if ($row=mysqli_fetch_assoc($res))
	 {
		 header('location: ./daftarUser.php?error=' .urlencode('Username sudah digunakan'));   
		 //echo "aa" . "</br>";
	 }
	 
	 else if ($password != $repassword) 
	 { // jika tidak sama
       header('location: ./daftaruser.php?error=' .urldecode('Password dan ulangi password tidak sama'));   
		//echo "bb";
     }
	 else 
	 {
		 // SQL Insert
		$q = "INSERT INTO user (username,password) VALUES ('$username', '$password')";
		//echo $q;
		$insert = $conn->query($q);
		// jika gagal
		if (! $insert) 
		{
			echo "<script>alert('".$conn->error."'); window.location.href = './daftarUser.php';</script>";
			//echo "cc";
		} 
		else if ($insert)
		{
			//echo "<script>alert('Daftar berhasil'); window.location.href = './loginuser.php';</script>";
			header('location: ./daftaruser.php?berhasil=' .urldecode('Akun Berhasil Didaftarkan'));   
			//echo "dd";
		}
	 }
    
}
?>