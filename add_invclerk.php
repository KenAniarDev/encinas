<?php
require_once "connect.php";
$type = 'add';
$firstname = ''; 	
$lastname = ''; 	
$contact_number = ''; 	
$email = ''; 	
$supervisors_id = null; 	

if(isset($_POST['add'])) {
  $query = "INSERT INTO invclerks VALUES(null, '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['contact_number']."', '".$_POST['email']."', '".$_POST['supervisors_id']."')";
  $conn->query($query);

  header("Location: invclerk.php");
}
if(isset($_POST['update'])) {
  $query = "UPDATE invclerks SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', contact_number='".$_POST['contact_number']."', email='".$_POST['email']."', supervisors_id='".$_POST['supervisors_id']."' WHERE invclerk_id=" . $_GET['id'];
  $conn->query($query);

  header("Location: invclerk.php");
}
if(isset($_GET['edit'])) {
  $type = 'update';
  $query = "SELECT * FROM invclerks WHERE invclerk_id=" . $_GET['id'];
  $result = $conn->query($query);

  if($result && $result->num_rows) {
    while($row = $result->fetch_assoc()) {
      $firstname = $row['firstname']; 	
      $lastname = $row['lastname']; 	
      $contact_number = $row['contact_number']; 	
      $email = $row['email']; 	
      $supervisors_id = $row['supervisors_id']; 	
    }
  }
}

?>

<!DOCTYPE html>
<html>
<title>Add Inventory Clerk</title>
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

<h2><?php echo $type; ?> INVENTORY CLERK </h2>
<form action="" method="POST">
<div class="box">
  <div class="container" style="margin: 0 auto;">
    <label for="supervisors_id"><b>Supervisors ID</b></label>
    <?php
      $query = "SELECT * FROM supervisors";
      $result = $conn->query($query);
    ?>
    <select name="supervisors_id" id="">
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
     <label for="firstname"><b>First Name</b></label>
    <input type="text" name="firstname" value="<?php echo $firstname; ?>" required>
     <label for="lastname"><b>Last Name</b></label>
    <input type="text" name="lastname" value="<?php echo $lastname; ?>"  required>
     <label for="contact_number"><b>Contact Number</b></label>
    <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" required>
     <label for="email"><b>Email</b></label>
    <input type="text" name="email" value="<?php echo $email; ?>">
        </div></div></div>
    <div class="container" style="margin: 0 auto;">
      <input type="submit" style="margin-top: 35px;" name="<?php echo $type; ?>" value="<?php echo $type; ?>">
      <a href="list.php"><button type="button" class="cancelbtn"><b>CANCEL</b></button>
    </div> 
</div>
</div>
</form>

</body>
</html>
