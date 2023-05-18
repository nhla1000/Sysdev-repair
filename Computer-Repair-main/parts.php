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
     $id=$_SESSION['Id'];
     $r_query = "SELECT * from parts ";
     $query1= mysqli_query($connection,$r_query) or die("Could not retrieve parts from the database");
     $ComputerId=0;
     $model = '';
     $customerId=0;
    $total=0;
    $all=0;
     while($row=mysqli_fetch_array($query1)){
        $partid=$row['Id'];
        $name=$row['Name'];
        $qty=$row['Qty'];
        $price=$row['Price'];

        $total = $price * $qty;
       
        echo"<div class=\"container\">
        <div class=\"container-preview\">
        
        <h2>  $name</h2>
             
    </div>
    <div class=\"container-info\">
        <div class=\"cid-container\">

        <h5><a> Part ID : $partid </a></h5>  
        </div>
       
        <h6> Quantity Remaining :<a style=\"color:brown;\">  $qty</a></h6><br>
        <h6> Price :<a style=\"color:red;\">  R{$price}</a></h6><br>
        <h6> Total Value :<a style=\"color:green;\">  R{$total}</a></h6>
    </div><br>
</div>";
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
height:150px;
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
background-color: rgb(255, 255, 240);
color: black;
padding: 30px;
max-width: 250px;
}

.container-preview a {
color: black;
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