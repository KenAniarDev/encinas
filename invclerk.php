<?php
require_once "connect.php";

$query = "SELECT * FROM invclerks";
$result = $conn->query($query);

if(isset($_GET['delete'])) {
    $query = "DELETE FROM invclerks WHERE invclerk_id =" . $_GET['id'];
    $conn->query($query);

    $query = "SELECT * FROM invclerks";
    $result = $conn->query($query);
}

?>

<!DOCTYPE html>
<html>
<title>Inventory Clerk</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background: linear-gradient(to left, cornsilk, tan, sienna);
  min-height: 100vh;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Lato", sans-serif;
  letter-spacing: 1.5px;
} 
.box {
    background-image: url("background.jpg"); 
  padding: 100px;
  margin-left: 295px;
  margin-top: 25px;
  margin-right: 45px;
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
.table-container {
  padding: 50px;
  margin-left: 295px;
  margin-top: 25px;
  margin-right: 45px;
  background-size: cover;
  background-position: center;
  font-family:'Lato',sans-serif;
  letter-spacing: 2px;
  text-align: center;
  border-radius: 20px;
  box-shadow: 10px 10px 25px black;
}
nav {
  background: seashell;
  backdrop-filter: blur(15px);
  box-shadow: 5px 7px 15px black;
  border-radius: 20px;
  width: 250px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
}
nav ul {
  position: relative;
  list-style-type: none;
  top: 100px;
}
nav ul li a {
  display: flex;
  align-items: center;
  font-size: 20px;
  text-decoration: none;
  color: black;
  padding: 10px 30px;
  height: 50px;
  transition: 0.5s ease;
}
nav ul li a:hover {
  background: sienna;
  color: white;
  border-radius: 20px;
}
nav ul ul {
  position: absolute;
  left: 250px;
  width: 325px;
  top: 0;
  display: none;
  background: seashell;
  box-shadow: 0px 0px 15px black;
  border-radius: 20px;
}
nav ul span {
  position: absolute;
  right: 20px;
}
nav ul .dropdown {
  position: relative;
}
nav ul .dropdown:hover ul {
  display: initial;
}

button {
  margin-top: 50px;
  display: inline-block;
  padding: 13px 55px;
  text-align: center;
    font-family:'Lato',sans-serif;
  letter-spacing: 2px;
  font-size: 150%;
    color: maroon;
  background-color: seashell;
  border: black;
  border-radius: 20px;
  box-shadow: 10px 10px 25px black;
  margin-left: 1250px;
}
button:hover {
  background-color: wheat;
}
button:active {
  background-color: sienna;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #FFF5EE;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #FFF5EE;
}

</style>
<body>
<?php include "components/nav.php"; ?>
<div class="box">
  <p><b><span style="font-size: 130px;">INVENTORY CLERK</span></b></p>
</div>
<div class="table-container">
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact Number</th>
        <th>Email</th>
        <th>Supervisors ID</th>
        <th>Action</th>
    </tr>
    <?php 
        if($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['invclerk_id'] ?></td>
                <td><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></td>
                <td><?php echo $row['contact_number'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['supervisors_id'] ?></td>
                <td>
                    <a href="add_invclerk.php?edit=edit&id=<?php echo $row['invclerk_id'] ?>">Edit</a>
                    <a href="?delete=delete&id=<?php echo $row['invclerk_id'] ?>">Delete</a>
                </td>
            </tr>
    <?php
            }
        }
    
    ?>
    </table>
</div>

<a href="index.php">Back</a>
</body>
</html>
