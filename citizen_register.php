<?php
include "db.php";

$name=$_POST['name'];
$city=$_POST['city'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];

$sql="INSERT INTO citizens(name,city,phone,email,password)
VALUES('$name','$city','$phone','$email','$password')";

if(mysqli_query($conn,$sql)){
echo "Registration Successful";
}else{
echo "Error";
}

?>