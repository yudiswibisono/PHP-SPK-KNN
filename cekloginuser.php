<?php 

include 'conn.php';
$username = $_POST['username'];
$password = $_POST['password'];
$data = mysqli_query($conn,"select * from user where username='$username' and password='$password'");
 
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$row=mysqli_fetch_assoc($data);
	$_SESSION['id_user'] = $row["id_user"];
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:home.php");
}else{
	header('location: ./loginuser.php?error=' .urldecode('username atau password salah'));
}

?>