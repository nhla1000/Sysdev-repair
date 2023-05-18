<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register-login.css">
    <title>Document</title>
</head>
<body>
<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="login-register.php" method="POST">
				<label for="chk" aria-hidden="true">Sign up</label>
                <input type="text"  name="name"  placeholder="Name" required>
                <input type="text"  name="surname" placeholder="Surname" required>
                <input type="email"  name="email" placeholder="Email" required>
                <input type="text"  name="username" placeholder="Username" required >
                <input type="password"  name="password" placeholder="Password"  required>
                <input type="password"  name="confirm" placeholder="Confrim Password"  required>
					<button  name="register" type="submit">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form  action="login.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button name="login" type="submit">Login</button>
				</form>
			</div>
	</div>

</body>
<?php

require_once ("config.php");

$connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

if(isset($_REQUEST['login'])){
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$Technician_checker =strpos($username,"@Technician");
$admin_checker=strpos($username,"@Admin");

//if the person who logs in is a technician , we want to check if their username and password exists in the database , then if they do , we serve them with index2.php
if ($Technician_checker !=''){

    $read_query = "SELECT* from technicians where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    
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
    if($username == $database_username && $password != $database_password ){
    echo " Wrong Password ! please enter the correct password ";
    header("Location : login.php");
    }

    else if ($username == $database_username && $password == $database_password ){
    header("Location : index2.php");
    }

 else{
    header("Location : register.php");
}
   
}
//if the person who logs in is a admin , we want to check if their username and password exists in the database , then if they do , we serve them with index3.php
else if ($admin_checker !=''){
    $read_query = "SELECT * from admins where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
   
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
    if($username == $database_username && $password != $database_password ){
    echo " Wrong Password ! please enter the correct password ";
    header("Location : login.php");
    }

    else if ($username == $database_username && $password == $database_password ){
    header("Location : index3.php");
    }

 else{
    header("Location : register.php");
}
}


//if the person who logs in is a customer , we want to check if their username and password exists in the database , then if they do , we serve them with index.php
else{
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
    if($username == $database_username && $password != $database_password ){
        echo " Wrong Password ! please enter the correct password ";
        header("Location : login.php");
    }

    else if ($username == $database_username && $password == $database_password ){
    header("Location : index.php");
    }

    else{
        header("Location : register.php");
    }

}

mysqli_close($connection);

}


?>
<?php

require_once ("config.php");

$connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

if(isset($_REQUEST['register'])){

$name = $_REQUEST['name'];
$surname = $_REQUEST['surname'];
$email= $_REQUEST['email'];
$username =$_REQUEST['username'];
$password=$_REQUEST['password'];
$confirm=$_REQUEST['confirm'];

$Technician_checker =strpos($username,"@Technician");
$admin_checker=strpos($username,"@Admin");
//Padiah@Technician
if ($Technician_checker !=''){
    if($password==$confirm){
    $insert_query = "INSERT INTO technicians(Name,Surname,Username,Password,Email) VALUES('$name','$surname','$username','$password','$email')";
    $query = mysqli_query($connection,$insert_query) or die ("Could not insert the data into the technician database .."); 
    
    $read_query = "SELECT Id,Name,Surname,Username,Password from technicians where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];

}
    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;

    header("Location : index2.php");
}else{
    echo"<script>Please enter the same Password</script>";

}
}
else if ($admin_checker !=''){
    if($password==$confirm){
    $insert_query = "INSERT INTO admins(Name,Surname,Username,Email,Password) VALUES('$name','$surname','$username','$email','$password')";
    $query = mysqli_query($connection,$insert_query) or die ("Could not insert the data into the database .."); 
    $read_query = "SELECT Id,Name,Surname,Username,Password from admins where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];

    }
    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;
    header("Location : index3.php");
}else{
    echo"<script>Please enter the same Password</script>";
}
}

else{
    if($password==$confirm){
    $insert_query = "INSERT INTO customers(Name,Surname,Username,Email,Password) VALUES('$name','$surname','$username','$email','$password')";
    $query = mysqli_query($connection,$insert_query) or die ("Could not insert the data into the database ..");
    $read_query = "SELECT Id,Name,Surname,Username,Password from customers where Username='$username' and Password='$password'";
    $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
    header("Location : login.php");

    $database_username = "";
    $database_password = "";
    $Id = 0;
    $database_name = "";
    $database_surname = "";
    while($row=mysqli_fetch_array($query)){
    $database_username = $row['Username'];
    $database_password = $row['Password'];
    $Id = $row['Id'];
    $database_name=$row['Name'];
    $database_surname=$row['Surname'];

    }
    $_SESSION['Id']=$Id ;
    $_SESSION['Name']=$database_name;
    $_SESSION['Surname']= $database_surname;
    header("Location : index.php");
}else{
    echo"<script>Please enter the same Password</script>";
}
}

}
mysqli_close($connection);
?>


</html>