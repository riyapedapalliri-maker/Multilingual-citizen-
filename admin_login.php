<?php
include "db.php";

$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM admins WHERE email='$email' AND password='$password'";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

header("Location:admin-dashboard.html");

}else{

echo "Invalid Admin Login";

}

?>