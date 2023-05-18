<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<body>
<?php include 'header2.php'; ?> 
<?php
require_once ("config.php");
$connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
$select_query = "SELECT * FROM technicians";
$query = mysqli_query($connection,$select_query) or die ("could not select customers");
$name = "";
$surname = "";
while($row=mysqli_fetch_array($query)){
$name=$row['Name'];
$surname=$row['Surname'];

}

?>
<div class="body"><form action="profile.php" method="POST" name="register">
<label for="Name"> Name</label><br>
    <input type="text" value=<?php echo $_SESSION['Name'];?> name="name" required><br>
    <label for="Name"> Surname</label><br>
    <input type="text" value=<?php echo $_SESSION['Surname'];?> name="surname" required><br>
    <label for="Name"> Email</label><br>
    <input type="email" value=<?php echo $_SESSION['Email'];?> name="email" required><br>
    <label for="Name"> Password</label><br>
    <input type="password"  name="password" value=<?php echo $_SESSION['Password'];?>  required><br>
    <input type="submit" name="submit" value="update">
</form>
</body>

<?php

require_once ("config.php");

$connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

if(isset($_REQUEST['submit'])){

$name = $_REQUEST['name'];
$surname = $_REQUEST['surname'];
$email= $_REQUEST['email'];
$password=$_REQUEST['password'];
$username=$_SESSION['Username'];
$id=$_SESSION['Id'];
$Technician_checker =strpos($username,"@Technician");
$admin_checker=strpos($username,"@Admin");

if ($Technician_checker !=''){
    $update_query = "UPDATE technicians set Name='$name',Surname='$surname',Password='$password',Email='$email' where Id=$id ";
    $query= mysqli_query($connection,$update_query) or die("Could not Update the table technicians");
    
    //After Updating , We then retrieve our data from the database , so that we can update the session variables : its just copy & paste from the register.php
    $read_query = "SELECT * from technicians where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    header("Location : login.php");

    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    $database_email="";

    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];
    $database_email=$row['Email'];
    }

    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;
    $_SESSION['Email']= $database_email;
    $_SESSION['Password']=$database_password;
    $_SESSION['Username']=$database_username;
 
    header("Location : profile.php");;
}

else if ($admin_checker !=''){
    $update_query = "UPDATE admins set Name='$name',Surname='$surname',Password='$password',Email='$email' where Id=$id ";
    $query= mysqli_query($connection,$update_query) or die("Could not Update the table admins");
    
    //After Updating , We then retrieve our data from the database , so that we can update the session variables : its just copy & paste from the register.php
    $read_query = "SELECT * from admins where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    header("Location : login.php");

    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    $database_email="";

    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];
    $database_email=$row['Email'];
    }

    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;
    $_SESSION['Email']= $database_email;
    $_SESSION['Password']=$database_password;
    $_SESSION['Username']=$database_username;
    header("Location : profile.php");

}

else{
    $update_query = "UPDATE customers set Name='$name',Surname='$surname',Password='$password',Email='$email' where Id=$id ";
    $query= mysqli_query($connection,$update_query) or die("Could not Update the table customers");
    
    //After Updating , We then retrieve our data from the database , so that we can update the session variables : its just copy & paste from the register.php
    $read_query = "SELECT * from customers where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    header("Location : login.php");

    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    $database_email="";

    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];
    $database_email=$row['Email'];
    }

    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;
    $_SESSION['Email']= $database_email;
    $_SESSION['Password']=$database_password;
    $_SESSION['Username']=$database_username;
    header("Location : profile.php");

}

}
mysqli_close($connection);

?>
</html>