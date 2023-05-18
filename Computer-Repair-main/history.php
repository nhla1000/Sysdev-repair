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
<body><?php include 'header3.php'; ?>
<div class="wrapper">
<?php  
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     $Name="";
     $email ="";
     $select = "SELECT * from history";
     $query= mysqli_query($connection,$select) or die("Could not retrieve history");
     while($row=mysqli_fetch_array($query)){
      $tid =$row['TechnicianId'];
      $cid =$row['ComputerId'];
      $date=$row['CompletedDate'];
      $select1 = "SELECT Name,Surname from technicians where Id=$tid";
      $query1= mysqli_query($connection,$select1) or die("Could not retrieve technicians");
      while($row=mysqli_fetch_array($query1)){
        $tname =$row['Name'];
        $tsname =$row['Surname'];
      }
      $select2 = "SELECT * from computers where Id=$cid";
      $query2= mysqli_query($connection,$select2) or die("Could not retrieve technicians");
      $bookeddate='2022-01-01 00:00:00';
      while($row=mysqli_fetch_array($query2)){
        $customerid =$row['CustomerId'];
        $model=$row['Model'];
        $bookeddate=$row['Date'];
        
        $select3 = "SELECT Name,Email from customers where Id=$customerid";
        $query3= mysqli_query($connection,$select3) or die("Could not retrieve technicians");
        while($row=mysqli_fetch_array($query3)){
          $Name =$row['Name'];
          $email =$row['Email'];
        }
              echo"<div class=\"container\">
              <div class=\"container-preview\">
              <h5>Technician Name</h5>
              <h4> $tname  $tsname</h4>
              <h5><a>  ID : $tid </a></h5>      
          </div>
          <div class=\"container-info\">
              <div class=\"cid-container\">
            
              <h6>Completed Date  : <a style=\"color:green;\">  {$date} </a></h6><br>
          
              </div>
              <h6> Booked Date : <a style=\"color:red;\">   $bookeddate </a></h6><br>
              <h3><a> Customer Name : $Name </a></h3>
              <h5><a> Email :  $email </a></h5>
              <h3><a> Model :  $model </a></h3>
             
          </div><br>
      </div>";}
    
    }
  
      ?>
</body>

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
</html>