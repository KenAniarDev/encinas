<?php
require_once "connect.php";
$type = 'add';
$stock_number = ''; 	
$description = ''; 	
$classification = ''; 	
$remarks = ''; 	
$category_id = null; 	
$invclerks_id = null; 	
$supervisors_id = null;

if(isset($_POST['add'])){
  $query = "INSERT INTO items VALUES(null, '".$_POST['stock_number']."', '".$_POST['description']."', '".$_POST['classification']."', '".$_POST['remarks']."', '".$_POST['category_id']."', '".$_POST['invclerks_id']."', '".$_POST['supervisors_id']."')";
  $conn->query($query);

  header("Location: item.php");
}
if(isset($_POST['update'])){
  $query = "UPDATE items SET stock_number='".$_POST['stock_number']."', description='".$_POST['description']."', classification='".$_POST['classification']."', remarks='".$_POST['remarks']."', category_id='".$_POST['category_id']."', invclerks_id='".$_POST['invclerks_id']."', supervisors_id='".$_POST['supervisors_id']."' WHERE item_id=" . $_GET['id'];
  $conn->query($query);

  header("Location: item.php");
}
if(isset($_GET['edit'])){
  $type = 'update';
  $query = "SELECT * FROM items WHERE item_id=" . $_GET['id'];
  $result = $conn->query($query);

  if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $stock_number = $row['stock_number']; 	
      $description = $row['description']; 	
      $classification = $row['classification']; 	
      $remarks = $row['remarks']; 	
      $category_id = $row['category_id']; 	
      $invclerks_id = $row['invclerks_id']; 	
      $supervisors_id = $row['supervisors_id'];
    }
  }
}
?>

<!DOCTYPE html>
<html>
<title>Add Items</title>
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
  font-size: 65px;
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

<h2><?php echo $type ?> ITEMS </h2>
<form action="" method="POST">
  <div class="box">
  <div class="container" style="margin: 0 auto;">
  <!-- stock_number 	description 	classification 	remarks 	category_id  	invclerks_id 	supervisors_id 	 -->
    <label for="stock_number"><b>Stock Number</b></label>
    <input type="number" name="stock_number" value="<?php echo $stock_number; ?>" required>
     <label for="description"><b>Description</b></label>
    <input type="text" name="description" value="<?php echo $description; ?>" required>
     <label for="classification"><b>Classification</b></label>
    <input type="text" name="classification" value="<?php echo $classification; ?>" required>
     <label for="remarks"><b>Remarks</b></label>
    <input type="text" name="remarks" value="<?php echo $remarks; ?>" required>
    
    <label for="uname"><b>Category ID</b></label>
      <?php
        $query = "SELECT * FROM categories";
        $result = $conn->query($query);
      ?>
      <select name="category_id">
        <?php 
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  if($category_id === $row['cat_id']) {
                    echo "<option value=".$row['cat_id']." selected>".$row['cat_id']."</option>";
                  }else {
                    echo "<option value=".$row['cat_id'].">".$row['cat_id']."</option>";
                  }
                }
            }
        
        ?>
      </select>
    <label for="uname"><b>Inventory Clerks ID</b></label>
      <?php
        $query = "SELECT * FROM invclerks";
        $result = $conn->query($query);
      ?>
      <select name="invclerks_id">
        <?php 
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  if($invclerks_id === $row['invclerk_id']) {
                    echo "<option value=".$row['invclerk_id']." selected>".$row['invclerk_id']."</option>";
                  }else {
                    echo "<option value=".$row['invclerk_id'].">".$row['invclerk_id']."</option>";
                  }
                }
            }
        
        ?>
      </select>
    <label for="uname"><b>Supervisors ID</b></label>
      <?php
        $query = "SELECT * FROM supervisors";
        $result = $conn->query($query);
      ?>
      <select name="supervisors_id">
        <?php 
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  if($supervisors_id === $row['supervisor_id']) {
                    echo "<option value=".$row['supervisor_id']." selected>".$row['supervisor_id']."</option>";
                  }else {
                    echo "<option value=".$row['supervisor_id'].">".$row['supervisor_id']."</option>";
                  }
                }
            }
        
        ?>
      </select>
<div></div></div></div>
<div class="container" style="margin: 0 auto;">
    <input type="submit" name="<?php echo $type ?>" value="<?php echo $type ?>">
    <a href="list.php"><button type="button" class="cancelbtn"><b>CANCEL</b></button>
</div>
</form>

</body>
</html>
