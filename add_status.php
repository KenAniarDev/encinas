<?php
require_once "connect.php";
$type = 'add';
$date = '';
$nosoldout = '';
$no_items_left = '';
$inventory_id = null;

if(isset($_POST['add'])){
  $query = "INSERT INTO status VALUES(null, '".$_POST['date']."', '".$_POST['nosoldout']."', '".$_POST['no_items_left']."', '".$_POST['inventory_id']."')";
  $conn->query($query);

  header("Location: status.php");
}
if(isset($_POST['update'])){
  $query = "UPDATE status SET date='".$_POST['date']."', nosoldout='".$_POST['nosoldout']."', no_items_left='".$_POST['no_items_left']."', inventory_id='".$_POST['inventory_id']."' WHERE status_id=" . $_GET['id'];
  $conn->query($query);

  header("Location: status.php");
}
if(isset($_GET['edit'])){
  $type = 'update';
  $query = "SELECT * FROM status WHERE status_id=" . $_GET['id'];
  $result = $conn->query($query);

  if($result && $result->num_rows){
    while($row = $result->fetch_assoc()){
      $date = $row['date'];
      $nosoldout = $row['nosoldout'];
      $no_items_left = $row['no_items_left'];
      $inventory_id = $row['inventory_id'];
    }
  }
}

?>

<!DOCTYPE html>
<html>
<title>Add Status</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background: linear-gradient(to left, cornsilk, tan, sienna);
  min-height: 100vh;
  font-family: "Lato", sans-serif;
  letter-spacing: 1px;
}
h2 {
  text-align: center;
  font-size: 55px;
  margin: 10px 0;
  text-transform: uppercase
}
.box {
  background-image: url("background.jpg"); 
  padding: 50px 100px;
  margin: 20px 55px 5px 55px;
  background-size: cover;
  background-position: center;
    color: white;
    text-align: center;
    border-radius: 20px;
    box-shadow: 10px 10px 25px black;
}

input,
select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
}

input[type=submit] {
  background-color: sienna;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  font-family: "Lato", sans-serif;
  letter-spacing: 1px;
  font-size: 15px;
  text-transform: uppercase
}

input[type=submit]:hover {
  transform: scale(1.1);
  opacity: 0.7;
}

.cancelbtn {
  width: 50%;
  padding: 10px 18px;
  background-color: #f44336;
  text-align: center;
    margin: 8px 0;
  border: none;

}

.container {
  padding: 16px;
  text-align: center;
  width: 50%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 50%;
  }
}
</style>
</head>
<body>

<h2><?php echo $type; ?> STATUS </h2>
<form action="" method="POST">
<div class="box">
  <div class="container" style="margin: 0 auto;">
      <label for="date"><b>Date</b></label>
      <input type="date" name="date" value="<?php echo $date ?>" required>
      <label for="no_items_left"><b>Number of Items Left</b></label>
      <input type="number" name="no_items_left" value="<?php echo $no_items_left ?>" required>
      <label for="nosoldout"><b>Number of Sold Out</b></label>
      <input type="number" name="nosoldout" value="<?php echo $nosoldout ?>" required>
      
      <label for="supervisors_id"><b>Inventory ID</b></label>
      <?php
        $query = "SELECT * FROM inventory";
        $result = $conn->query($query);
      ?>
      <select name="inventory_id">
        <?php 
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  if($inventory_id === $row['inventory_id']) {
                    echo "<option value=".$row['inventory_id']." selected>".$row['inventory_id']."</option>";
                  }else {
                    echo "<option value=".$row['inventory_id'].">".$row['inventory_id']."</option>";
                  }
                }
            }
        
        ?>
      </select>
  <div>
</div></div></div>
<div class="container" style="margin: 0 auto;">
    <input type="submit" style="margin-top: 35px;" name="<?php echo $type; ?>" value="<?php echo $type; ?>"> 
    <a href="list.php"><button type="button" class="cancelbtn"><b>CANCEL</b></button>
  </div> 
</div>
</form>

</body>
</html>
