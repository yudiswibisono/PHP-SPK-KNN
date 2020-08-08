<?php 

include 'conn.php';
$username = $_POST['username'];
$password = $_POST['password'];
$data = mysqli_query($conn,"select * from admin where username='$username' and password='$password'");
 
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$row=mysqli_fetch_assoc($data);
	$_SESSION['id_admin'] = $row["id_admin"];
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:halamanhomeadmin.php");
}else{
	header('location: ./loginadmin.php?error=' .urldecode('username atau password salah'));
}

?>