<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jobs.css">
    <title>Document</title>
    
</head>
<?php include 'header3.php'; ?>
<body>
<div class="forms">
    <form action="Jobs.php" method="POST">
    <label for="model">Technicians</label>
    <select id="technician" name="technician">
        <?php
        require_once ("config.php");
        $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

        $select_query = "SELECT * FROM technicians";
        $query = mysqli_query($connection,$select_query) or die ("could not select technicians");
        while($row=mysqli_fetch_array($query)){
            $value = $row['Name'];
            $id=$row['Id'];
           echo "<option value='$id'>$value</option>";
        }
        ?>
    
    </select><br>
  
    <label for="model">Jobs</label>
    <select id="job" name="job">
    <?php
        require_once ("config.php");
        $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");

        $select_query = "SELECT * FROM computers";
        $value = 0;
        $query = mysqli_query($connection,$select_query) or die ("could not select customers");
        while($row=mysqli_fetch_array($query)){
            $value = $row['Id'];
           echo "<option value='$value'>$value</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Assign" name="submit" >
    </form>

  </div>
</body>

<?php
    require_once ("config.php");
    $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
    
if(isset($_REQUEST['submit'])){
    $techId = $_REQUEST['technician'];
    $computerId = $_REQUEST['job'];

    $insertion= "INSERT INTO jobs(ComputerId,TechnicianId,Status,CustomerMessage) VALUES ($computerId,$techId,'In Progress',NULL)";
    $query = mysqli_query($connection,$insertion) or die("Could not insert into Jobs");
    header("Location: index3.php");
 
}


?>

</html>