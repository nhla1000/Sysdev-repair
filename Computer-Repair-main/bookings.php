<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookings.css">
    <title>Document</title>
</head>
<body>
<body><?php include 'header3.php'; ?>

<body>
  <div class="wrapper">
<?php  
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     $id=$_SESSION['Id'];
     $r_query = "SELECT * from computers ";
     $query1= mysqli_query($connection,$r_query) or die("Could not retrieve data from the database");
     $ComputerId=0;
     $model = '';
     $customerId=0;
     $jid=0;
     while($row=mysqli_fetch_array($query1)){
        $ComputerId=$row['Id'];
        $model = $row['Model'];
        $customerId=$row['CustomerId'];
        $problem=$row['Problem'];
        $ComputerId=$row['Id'];
        $date = $row['Date'];

        $query9 = "SELECT TechnicianId,Status,Id from jobs where ComputerId=$ComputerId ";
        $query11= mysqli_query($connection,$query9) or die("Could not retrieve status from the database");
       
        while($row=mysqli_fetch_array($query11)){
          $status =$row['Status'];
          $tid=$row['TechnicianId'];
          $jid=$row['Id'];

          $query913 = "SELECT PartsId from orders where ComputerId=$ComputerId and TechnicianId=$tid";
          $query110= mysqli_query($connection,$query913) or die("Could not retrieve the Parts Id ");
          $pid=0;
          while($row=mysqli_fetch_array($query110)){
            $pid =$row['PartsId'];
          }

          $query91 = "SELECT * from parts where parts.Id=$pid";
          $query111= mysqli_query($connection,$query91) or die("Could not retrieve Joined Data");
          $price= 0;
          $labor=0;
          $total=0;
          while($row=mysqli_fetch_array($query111)){
            $price =$row['Price'];
            $labor =$row['LaborCost'];
          }
          
          $total = $labor+$price;
              echo"<div class=\"container\">
              <div class=\"container-preview\">
              <h4>Model</h4>
              <h2> $model</h2>
              <h5><a> Customer ID : $customerId </a></h5>      
          </div>
          <div class=\"container-info\">
              <div class=\"cid-container\">
              <h6><a> Computer Number: $ComputerId </a></h6><br>
              <h6><a> Technician: $tid </a></h6><br>
              <h6><a> Booked In Date : {$date} </a></h6><br>
              <h6> Part Cost :<a style=\"color:red;\">  R{$price}</a></h6><br>
              <h6> Labor Cost :<a style=\"color:red;\">  R{$labor}</a></h6><br>
              <h6> Total Cost :<a style=\"color:red;\">  R{$total}</a></h6>
            
              </div>
              <h6>Issue :</h6>
                  <h5> $problem</h5>
                  <h5>Status :</5>
                  <h6 style=\"color : green \"><i> $status</i></h6>
                  <form action=\"bookings.php\" method=\"POST\"><input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Delete Job\"></form>
          </div><br>
      </div>";}
      
    
  }
      ?>
</body>
<?php  
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     if(isset($_REQUEST['submit'])){
     $query = "DELETE from jobs where Id= $jid";
     $query= mysqli_query($connection,$query) or die("Could not retrieve data from the database");
    
     }
     ?>
<style>
   .body {

font-family: 'Muli', sans-serif;
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;

margin: 0;
}

.containers-container {

}
#btn{
  background-color: rgb(170, 69, 89);
  color:whitesmoke;
  border:none;
}
#btn:hover{
  cursor:pointer;
}

.container {
background-color: #fff;
border-radius: 10px;
box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
display: flex;
max-width: 100%;
margin: 20px;
overflow: hidden;
width: 100%;
height:250px;
}

.container h6 {
opacity: 0.6;
margin: 0;
letter-spacing: 1px;
text-transform: uppercase;
}

.container h2 {
letter-spacing: 1px;
margin: 10px 0;
}

.container-preview {
background-color: rgb(170, 69, 89);
color: #fff;
padding: 30px;
max-width: 250px;
}

.container-preview a {
color: #;
display: inline-block;
font-size: 12px;
opacity: 0.6;
margin-top: 30px;
text-decoration: none;
}

.container-info {
padding: 30px;
position: relative;
width: 100%;
}

.cid-container {
position: absolute;
top: 30px;
right: 30px;
text-align: right;
width: 150px;
}

form{
  margin-left:40%;
  margin-top:45px;
  display:flex;

}

input{

  padding:8px 8px;
  border:1px solid grey ;
  border-radius:6%;
  margin-bottom:8px;
}
input[type="text"]:focus{
outline:1px solid grey ;
}
button{
  height:32px;
  width:35px;
}

button:hover{
 
  cursor: pointer;

}

.wrapper{
  margin : 20px 550px;
}
</style>
</style>
</div>
</html>