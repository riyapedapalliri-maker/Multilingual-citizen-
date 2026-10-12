<?php
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM citizens WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

header("Location: user-dashboard.html");
exit();

}else{

echo "Invalid Login";

}

?>