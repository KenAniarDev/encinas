<?php
require_once "connect.php";
$type = 'add';
$date_receive = ''; 	
$items_receive = ''; 	
$status = ''; 	
$item_id = ''; 	

if(isset($_POST['add'])) {
    $query = "INSERT INTO inventory VALUES(null, '".$_POST['date_receive']."', ".$_POST['items_receive'].", '".$_POST['status']."', '".$_POST['item_id']."')";
    $conn->query($query);

    header("Location: inventory.php");
}
if(isset($_POST['update'])) {
    $query = "UPDATE inventory SET date_receive='".$_POST['date_receive']."', items_receive=".$_POST['items_receive'].", status='".$_POST['status']."', item_id='".$_POST['item_id']."' WHERE inventory_id=" . $_GET['id'];
    $conn->query($query);

    header("Location: inventory.php");
}
if(isset($_GET['edit'])) {
    $type = 'update';
    $query = "SELECT * FROM inventory WHERE inventory_id=" . $_GET['id'];
    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $date_receive = $row['date_receive'];	
            $items_receive = $row['items_receive'];	
            $status = $row['status'];
            $item_id = $row['item_id'];
        }
    }
}

?>

<!DOCTYPE html>
<html>
<title>Add Inventory</title>
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

<h2><?php echo $type ?> INVENTORY</h2>
<form action="" method="POST">
    <div class="box">
        <div class="container" style="margin: 0 auto;">
        <!-- date_receive 	items_receive 	status 	 -->
            <label for="date_receive"><b>Date Receive </b></label>
            <input type="date" name="date_receive" value="<?php echo $date_receive ?>" required>
            <label for="items_receive"><b>Number of Items Receive</b></label>
            <input type="number" name="items_receive" value="<?php echo $items_receive ?>" required>
            <label for="status"><b>Status</b></label>
            <input type="text" name="status" value="<?php echo $status ?>" required>

            <label for="uname"><b>Stock Number</b></label>
            <?php
              $query = "SELECT * FROM items";
              $result = $conn->query($query);
            ?>
            <select name="item_id">
              <?php 
                  if($result && $result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) { 
                        if($item_id === $row['item_id']) {
                          echo "<option value=".$row['item_id']." selected>".$row['stock_number']."</option>";
                        }else {
                          echo "<option value=".$row['item_id'].">".$row['stock_number']."</option>";
                        }
                      }
                  }
              
              ?>
            </select>

        </div></div></div>
        <div class="container" style="margin: 0 auto;">
            <input type="submit" style="margin-top: 35px;" name="<?php echo $type ?>" value="<?php echo $type ?>">
            <a href="list.php"><button type="button" class="cancelbtn"><b>CANCEL</b></button>
        </div> 
    </div>
</form>

</body>
</html>
