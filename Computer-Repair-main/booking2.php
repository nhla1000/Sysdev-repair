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

</style>  

<div class="form">
  <form action="booking.php" method="POST">

    <div class="problem">
   
    <div class="options">
    <label for="model">Model</label>
    <select id="model" name="model">
      <option value="lenovo">Lenovo</option>
      <option value="hp">HP</option>
      <option value="thinkpad">ThinkPad</option>
      <option value="samsung">Samsung</option>
       <option value="mecer">Mecer</option>
       <option value="thinkpad">ThinkPad</option>
       <option value="huawei">Huawei</option>
       <option value="other">Other</option>
    </select><br>
    </div>
    <label for="fname">Problem Domain</label>
    <textarea type="text" id="textbox" name="problem" placeholder="describe your problem..."></textarea><br> 
    </div>
    <div class="serial">
    <label for="fname">Serial Number (optional)</label>
    <input type="text" id="textbox" name="serial" placeholder="34954-A231-9...."></input><br> 
    </div>
    <div class="date">
    <label for="date">Booking Date</label>
    <input type="date" id="date" name="date" /><br>

    </div>
   
    <input type="submit" value="Book" name="submit" >
  </form>

  <?php

require_once ("config.php");

$connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

if(isset($_REQUEST['submit'])){
$model = $_REQUEST['model'];
$problem= $_REQUEST['problem'];
$serial=  $_REQUEST['serial'];
$date=  $_REQUEST['date'];
$customerID= $_SESSION['Id'];

$insert_query = "INSERT INTO computers(CustomerId,Problem,Model,SerialNumber,Date) VALUES('$customerID','$problem','$model','$serial','$date')";
$query =mysqli_query($connection,$insert_query) or die("Could not execute a query ..");
 
header("Location: index.php");
}
  ?>

</body>
</html>