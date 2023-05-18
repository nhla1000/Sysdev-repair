<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <title>Document</title>

  
   
</head>
<body><?php include 'header2.php';?>

<?php  
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     $id=$_SESSION['Id'];
     $status = 0;
    
     $read_query = "SELECT * from jobs where TechnicianId=$id";
     $query= mysqli_query($connection,$read_query) or die("Could not retrieve data from the database");
     $ComputerId = 0;
     while($row=mysqli_fetch_array($query)){
        $ComputerId = $row['ComputerId'];
        $message= $row['CustomerMessage'];
        $status=$row['Status'];
      
     $read_query101 = "SELECT * from computers where Id=$ComputerId";
     $query101= mysqli_query($connection,$read_query101) or die("Could not retrieve data from the database");
     $CustomerId = 0;
    
 while($row=mysqli_fetch_array($query101)){
        $problem = $row['Problem'];
        $model = $row['Model'];
        $CustomerId=$row['CustomerId'];
       
      echo "<div class=\"container\">
    <div class=\"container-preview\">
    <h5  style=\" font-family:  'Source Sans Pro', sans-serif;\"> Customer Number :  $CustomerId</h5>
        <h3  style=\" font-family: 'Poppins', sans-serif;\"> Model : $model </h3><br>
        <h6 style=\" font-family: 'Poppins', sans-serif;\">Issue :  $problem </h6>
    </div>
    <div class=\"customer\">
    <h4 style=\"color : grey\">Message from Customer :</h4>
    <h4><a style=\"font-family: 'Source Sans Pro', sans-serif;\">$message</a></h4></div>
      <form action=\"techjobs.php\" method=\"POST\">
            <div name=\"message\">
            
            </div><br>
        <div class=\"status\">
            <label for=\"\"  style=\" font-family: 'Poppins', sans-serif;\" >Progress Status</label><br>
            <select id=\"status\"  name=\"status\">
            <option value=\"InProgress\">Waiting for Parts</option>
                <option value=\"Half Way Through\">Half Way Through</option>
                <option value=\"Almost Done\">Almost Done</option>
                <option value=\"Completed\">Completed</option>
            </select><br>
            <input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Update Status\" >     
        </div>
    </form>


    <form action=\"general.php\" method=\"POST\">
    <input type=\"hidden\" name='hidden' value='$ComputerId'/>
    <div name=\"message\">
    <h4  style=\" font-family: 'Poppins', sans-serif;\"> Order Part</h4>
    </div>
    
<div class=\"status\">
    <select id=\"part\" name=\"part\">

    <option value='Screen'>Screen</option>
        <option value='Keyboard'>Keyboard</option>
      <option value='Expansion Slot'>Expansion Slot</option>
      <option value='Motherboard'>Motherboard</option>
      <option value='Mouse'>Mouse</option>
      <option value='LED'>LED</option>
      <option value='Sound Dampening'>Sound Dampening</option>
      <option value='Switch Spring'>Switch Spring</option>
      <option value='Stabilizer'>Stabilizer</option>
      <option value='Power Cable'>Power Cable</option>
      <option value='Plate'>Plate</option>
    </select>
    <input id=\"btn\" type=\"submit\" name=\"submit2\" value=\"Order\" >
</div>
</form>

    </div>";
    echo "<br>"; 
}
}
    
    if(isset($_REQUEST['submit'])){
         $status=$_REQUEST['status'];
        $read_query = "UPDATE jobs set Status='$status' where ComputerId= $ComputerId";
        $query= mysqli_query($connection,$read_query) or die("Could not update the database");
       
        if($status=='Completed'){
        $read_query101 = "INSERT into history(ComputerId,TechnicianId,CompletedDate) Values($ComputerId,$id,NOW())";
         $query101= mysqli_query($connection,$read_query101) or die("Could not retrieve data from the database");
        } echo "<script>Status Successfully Updated</script>";
        header("Location : index2.php"); 
    

     
}
     

     
    ?>

</body>
<style>


.customer{
  width:190px;
}
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
max-width: 100%;
justify-content:space-around;
align-items:center;
overflow: hidden;
margin-top:30px;
margin-left:200px;
width: 80%;
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
background-color: #FEF3F2;
color: black;
padding: 30px;
max-width: 200px;
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
  font-family:  'Poppins', sans-serif;
}
#btn:hover{
  cursor:pointer;
}
</style>
</html>