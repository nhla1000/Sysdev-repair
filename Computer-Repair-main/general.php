<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php


    require_once ("config.php");
    $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

    if(isset($_REQUEST['submit2'])){
    $part = $_REQUEST['part'];
    $customerId=$_POST['hidden'];
   
    $read_query = "SELECT * from parts";
    $query101= mysqli_query($connection,$read_query) or die("Could not select the data from");
    $partId=0;
    $databaseName="";
    while($row=mysqli_fetch_array($query101)){
        $databaseName=$row['Name'];
        if($part==$databaseName){
        $partId = $row['Id'];
    }
}

   $techId= $_SESSION['Id'];
     $read_query11 = "INSERT INTO orders(TechnicianId,PartsId,ComputerId,Qty) VALUES($techId,$partId,$customerId,1)";
    $query= mysqli_query($connection,$read_query11) or die("Could not insert into orders ");

    //update the quantity in the parts table
    $select2 = "UPDATE parts SET Qty=Qty-1 where Id=$partId ";
    $res2= mysqli_query($connection,$select2) or die("Could not update parts ");
  
    header("Location: index2.php");
 
    
}

?>
</body>
</html>