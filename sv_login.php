<?php
session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from users where username='$username' and password='$password'";
$query = mysqli_query($conn,$sql);
$num = mysqli_num_rows($query);

if($num > 0){
    $_SESSION['username'] = $username;
    header("Location: admin/dashboard.php");
    exit;
}else
    header("Location: login.php");
    exit;
}
?>