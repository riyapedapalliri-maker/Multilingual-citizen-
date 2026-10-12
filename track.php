<?php
include "db.php";

/* total complaints */
$total=mysqli_query($conn,"SELECT COUNT(*) as total FROM complaints");
$totalRow=mysqli_fetch_assoc($total);

/* resolved complaints */
$resolved=mysqli_query($conn,"SELECT COUNT(*) as total FROM complaints WHERE status='Resolved'");
$resolvedRow=mysqli_fetch_assoc($resolved);

/* under work */
$work=mysqli_query($conn,"SELECT COUNT(*) as total FROM complaints WHERE status='In Progress'");
$workRow=mysqli_fetch_assoc($work);

/* pending */
$pending=mysqli_query($conn,"SELECT COUNT(*) as total FROM complaints WHERE status='Pending'");
$pendingRow=mysqli_fetch_assoc($pending);
?>

<!DOCTYPE html>
<html>
<head>
<title>Track Complaints</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:Segoe UI;
margin:0;
background:#f1f5f9;
}

/* HEADER */

.header{
background:#2563eb;
color:white;
padding:20px;
font-size:22px;
text-align:center;
}

/* DASHBOARD GRID */

.container{
padding:40px;
}

.cards{
display:flex;
gap:20px;
margin-bottom:30px;
}

.card{
flex:1;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
text-align:center;
}

.card h2{
color:#2563eb;
margin:0;
}

.card p{
color:#666;
}

/* PROGRESS BAR */

.progress-box{
background:white;
padding:20px;
border-radius:10px;
margin-bottom:30px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.progress-bar{
width:100%;
height:20px;
background:#e5e7eb;
border-radius:10px;
overflow:hidden;
}

.progress{
height:100%;
width:65%;
background:#10b981;
}

/* CHART AREA */

.chart-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:30px;
}

.chart-card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

</style>
</head>


<body>

<div class="header">
Complaint Tracking Dashboard
</div>

<div class="container">

<!-- STATUS CARDS -->

<div class="cards">

<div class="card">
<h2><?php echo $totalRow['total']; ?></h2>
<p>Total Complaints</p>
</div>

<div class="card">
<h2><?php echo $resolvedRow['total']; ?></h2>
<p>Resolved</p>
</div>

<div class="card">
<h2><?php echo $workRow['total']; ?></h2>
<p>Under Work</p>
</div>

<div class="card">
<h2><?php echo $pendingRow['total']; ?></h2>
<p>Pending</p>
</div>

</div>


<!-- PROGRESS BAR -->

<div class="progress-box">

<h3>Work Completion Progress</h3>

<div class="progress-bar">
<div class="progress"></div>
</div>

<p>65% complaints resolved</p>

</div>
<!-- COMPLAINT UPDATES SECTION -->

<div class="progress-box">

<h3>Complaint Updates</h3>

<?php
$result=mysqli_query($conn,"SELECT * FROM complaints");

while($row=mysqli_fetch_assoc($result)){
?>

<div style="border-bottom:1px solid #ddd;margin-bottom:15px;padding-bottom:10px;">

<strong><?php echo $row['title']; ?></strong><br>

Area: <?php echo $row['area']; ?><br>

Description: <?php echo $row['description']; ?><br>

Status: <b><?php echo $row['status']; ?></b><br>

Admin Response: <?php echo $row['admin_response']; ?>

</div>

<?php
}
?>

</div>


<!-- CHARTS -->

<div class="chart-grid">

<div class="chart-card">
<h3>Complaint Progress</h3>
<canvas id="lineChart"></canvas>
</div>

<div class="chart-card">
<h3>Complaint Categories</h3>
<canvas id="pieChart"></canvas>
</div>

</div>

</div>


<script>

/* LINE GRAPH */

new Chart(document.getElementById("lineChart"),{

type:"line",

data:{
labels:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],

datasets:[{
label:"Resolved Complaints",
data:[2,4,5,6,7,9,10],
borderColor:"#3b82f6",
fill:false
}]
}

})


/* PIE CHART */

new Chart(document.getElementById("pieChart"),{

type:"doughnut",

data:{
labels:["Road","Garbage","Water","Electricity"],

datasets:[{

data:[5,3,2,2],

backgroundColor:[
"#3b82f6",
"#10b981",
"#f59e0b",
"#ef4444"
]

}]
}

})

</script>

</body>
</html>