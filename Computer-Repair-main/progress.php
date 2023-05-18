<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

</head>
<body><?php include 'header.php'; ?>
<body>
<?php  
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     $id=$_SESSION['Id'];
     $r_query = "SELECT * from computers where CustomerId=$id";
     $query1= mysqli_query($connection,$r_query) or die("Could not retrieve data from the database");
     $ComputerId=0;
     $model = '';
     $status = "";
     while($row=mysqli_fetch_array($query1)){
        $ComputerId=$row['Id'];
        $model = $row['Model'];
        //$_SESSION['computer']=$ComputerId;

        $r_query = "SELECT Status from jobs where ComputerId=$ComputerId";
     $query1= mysqli_query($connection,$r_query) or die("Could not retrieve data from the jobs database");

     while($row=mysqli_fetch_array($query1)){
      $status=$row['Status'];
   
    

        echo"<div class=\"container\">
        <div class=\"container-preview\">
        <h4>Model</h4>
        <h2> $model</h2>     
    </div>
    <div class=\"container-info\">
        <div class=\"cid-container\"><form action=\"progress.php\" method=\"POST\">
        <h6><a> Computer Number: $ComputerId </a></h6><br>

      
        </div>
        <h5>Status :</5>
        <h6 style=\"color : green \"><i> $status</i></h6><br>
        <h6>Message Technician</h6><br>
      
        <textarea name=\"message\" placeholder=\"any concern , update or query ?\" ></textarea><br>
        <input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Update Message\"><form>
          
    </div><br>  
</div>";

}
  
      
    }
      if(isset($_REQUEST['submit'])){
        $message = $_REQUEST['message'];
        echo "This is a computer ID ....{$ComputerId}";
        $insertion= "UPDATE jobs SET CustomerMessage='$message' where ComputerId=$ComputerId";
        $query = mysqli_query($connection,$insertion) or die("Could not upudate the customer Message");
      
        header("Location: index.php");
      
     
       
      }
      

       


    ?>
      

 
</html>

<?php
      
      require_once ("config.php");
      $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
      $id=2;/* $_SESSION['Id'];*/
      
      
      $read_query = "SELECT * from jobs where ComputerId=$ComputerId";
      $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
      $ComputerId = 0;
      $status= 0;
      while($row=mysqli_fetch_array($query)){
        $status=$row['Status'];
          $entry = "['".$row['ComputerId']."',".$status."],";
       
      }
      ?>
  
      
    </div>
    
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
input[type=text],input[type=email],input[type=password],textarea,select {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}

.container {
background-color: #fff;
border-radius: 10px;
box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
display: flex;
max-width: 50%;
margin: 20px 500px;
overflow: hidden;
width: 100%;
height:290px;
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
#btn{
  background-color: rgb(170, 69, 89);
  color:whitesmoke;
  border:none;
}
#btn:hover{
  cursor:pointer;
}
</style>
</html>