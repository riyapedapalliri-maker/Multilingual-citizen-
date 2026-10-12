<?php
include "db.php";

$name=$_POST['name'];
$area=$_POST['area'];
$category=$_POST['category'];
$lang=$_POST['language'];
$complaint=$_POST['complaint'];

$url="https://translate.googleapis.com/translate_a/single?client=gtx&sl=".$lang."&tl=en&dt=t&q=".urlencode($complaint);

$response=file_get_contents($url);

$data=json_decode($response,true);

$translated=$data[0][0][0];

$sql="INSERT INTO complaints
(citizen_name, location, title, area, description, complaint_original, complaint_english)
VALUES
('$name','$area','$category','$area','$complaint','$complaint','$translated')";

if(mysqli_query($conn,$sql)){
echo "<script>alert('Complaint Submitted Successfully');window.location='user-dashboard.html';</script>";
}
else{
echo mysqli_error($conn);
}
?>