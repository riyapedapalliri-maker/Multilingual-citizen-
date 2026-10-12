<?php
include "db.php";

$name=$_POST['admin_name'];
$department=$_POST['department'];
$district=$_POST['district'];
$email=$_POST['email'];
$password=$_POST['password'];

$sql="INSERT INTO admins(admin_name,department,district,email,password)
VALUES('$name','$department','$district','$email','$password')";

if(mysqli_query($conn,$sql)){
echo "Admin Registered";
}else{
echo "Error";
}

?>