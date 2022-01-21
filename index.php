<?php
require_once "connect.php";
$query = "SELECT * FROM status";
$result = $conn->query($query);

$current_month_report = 0;

if($result && $result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $date = new DateTime($row['date']);
    if($date->format("Y") === date("Y") && $date->format("m") === date("m")) {
      $current_month_report++;
    }
  }
}

?>
<!DOCTYPE html>
<html>
<title>Homepage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  background: linear-gradient(to left, cornsilk, tan, sienna);
}
.box {
	background-image: url("background.jpg"); 
	padding: 200px 100px;
  padding-bottom: 150px;
	margin: 55px;
	background-size: cover;
	background-position: center;
	font-family:'Lato',sans-serif;
	letter-spacing: 2px;
	font-size: 220%;
    color: white;
    text-align: center;
    border-radius: 20px;
    box-shadow: 10px 10px 25px black;
}
.navbar{
  margin-left: 250px;
  margin-right: 250px;
  background-color: seashell;
  box-shadow: 0 5px 25px black;
  border-radius: 10px;
}
.stat {
  padding: 20px;
  width: 600px;
  margin-left: 345px;
  margin-top: 100px;
  background-color: rgba(0,0,0, 0.4); 
  border-style: solid;
}
.stat h4 {
  font-size: 150%;
}
nav ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
nav li {
  display: inline-block;
  padding-top:10px;
  padding-bottom: 15px;
}
nav a {
  color: maroon;
  text-align: center;
  text-decoration: none;
  padding: 14px 20px;
  text-transform: uppercase;
  font-size: 21px;
}
nav a:hover {
  color: black;
}
nav li:hover {
  background-color: wheat;
    transform: scale(1.2);
}
nav li:active {
  background-color: sienna;
}
nav ul li a {
  display: block;
}
nav ul li a:hover {
  transform: scale(1.1);
}
</style>
<body>
<div class="box">
	<p><b>GRAINS AND POWDER<br><span style="font-size: 70px;">INVENTORY SYSTEM</span></b></p>
<div class="navbar">
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="inventory.php">Inventory</a></li>
    </ul>
  </nav>
</div>
<div class="stat">
  <h4 style="padding-left: 10px ;">INVENTORY REPORT</h4>
  <p style="padding-left: 10px ;">TOTAL OF SOLD ITEMS FOR THE CURRENT MONTH</p>
  <h4><?php echo $current_month_report ?></h4>
</div>
</body>
</html>