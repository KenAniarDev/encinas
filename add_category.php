<?php
require_once "connect.php";

$type = 'add';
$name = '';
$weight = 0;
$remarks = '';

if(isset($_POST['add'])) {
    $query = "INSERT INTO categories VALUES(null, '".$_POST['name']."', ".$_POST['weight'].", '".$_POST['remarks']."')";
    $conn->query($query);

    header("Location: categories.php");
}

if(isset($_POST['update'])) {
    $query = "UPDATE categories SET name='".$_POST['name']."', weight=".$_POST['weight'].", remarks='".$_POST['remarks']."' WHERE cat_id=" . $_GET['id']; 
    $conn->query($query);

    header("Location: categories.php");
}

if(isset($_GET['edit'])) {
    $type = 'update';

    $query = "SELECT * FROM categories WHERE cat_id=" . $_GET['id'];
    $result = $conn->query($query);

    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $weight = $row['weight'];
            $remarks = $row['remarks'];
        }
    }
}

?>

<!DOCTYPE html>
<html>
<title>Add Category</title>
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
  text-transform: uppercase;
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
input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
}

input[type='submit'] {
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

input[type='submit']:hover {
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

<h2><?php echo $type; ?> CATEGORY </h2>
<form action="" method="POST">
    <div class="box">
        <div class="container" style="margin: 0 auto;">
            <label for="name"><b>Name</b></label>
            <input type="text" name="name" value="<?php echo $name; ?>" required>
            <label for="weight"><b>Weight</b></label>
            <input type="number" name="weight" value="<?php echo $weight; ?>" required>
            <label for="remarks"><b>Remarks</b></label>
            <input type="text" name="remarks" value="<?php echo $remarks; ?>" required>
        </div></div></div></div>
        <div class="container" style="margin: 0 auto;">
            <input type="submit" style="margin-top: 35px;" value="<?php echo $type; ?>" name="<?php echo $type; ?>">
            <a href="list.php"><button type="button" class="cancelbtn"><b>CANCEL</b></button>
        </div> 
    </div>
</form>

</body>
</html>
