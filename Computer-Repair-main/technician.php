<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Document</title>
</head>
<?php include 'header3.php'; ?>
<body>
    <div class="search"> 
        <form action="technician.php" class="search-form" method="POST">
        <input class="search" type='search' name="search" placeholder="filter by Technician ID"/>
        <button type="submit" name="search-submit" value="Search"><i style="font-size:18px" class="fa">&#xf002;</i></button><br>
        </form>
        <h3 style="color:grey;margin-left:40%;">Summery of Technicians & The Parts They Ordered</h3>
      
    </div>
 <div class="body">
    <?php
     require_once ("config.php");
     $connection = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Could not connect to the database");
     if(!isset($_REQUEST['search-submit'])){
       
     $r_query = "SELECT * from technicians ";
     //$r_query = "SELECT distinct technicians.Id,technicians.Name,technicians.Surname,technicians.Email  from technicians inner join jobs where technicians.Id=jobs.TechnicianId";
     $query1= mysqli_query($connection,$r_query) or die("Could not retrieve data from the database");
    $jobs= 0;
     
     while($row=mysqli_fetch_array($query1)){
        $id=$row['Id'];
        $name = $row['Name'];
        $surname = $row['Surname'];
        $email = $row['Email'];
       
        $p_query = "SELECT PartsId FROM orders where TechnicianId=$id ";
        $query2= mysqli_query($connection,$p_query) or die("Could not retrieve parts from the database");
        while($row=mysqli_fetch_array($query2)){
            $pname = $row['PartsId'];
            
            $p_query = "SELECT Name FROM parts where Id=$pname";
            $query2= mysqli_query($connection,$p_query) or die("Could not retrieve parts from the database");
            echo"<div class=\"course\">";
            while($row=mysqli_fetch_array($query2)){
                
                $pname = $row['Name'];
                   
                    echo "<div class=\"course-preview\">
                    <h6>Name</h6>
                    <h2> $name $surname </h2>
                    <p><a>ID :  $id </a></p>
                </div>
                <div class=\"course-info\">
                    <div class=\"progress-container\">
                        
                    </div>
                    <h6>Parts Ordered</h6>
                        <h5> $pname </h5><br>
                
                </div>";
          
}
echo "</div>";

}


     }

     }
    else{
        $ID=$_REQUEST['search'];
        $query = "SELECT * from technicians where Id=$ID  ";
        $query2= mysqli_query($connection,$query) or die("Could not select all data from Database");
        $jobs= 0;
         
        while($row=mysqli_fetch_array($query2)){
            $id=$row['Id'];
            $name = $row['Name'];
            $surname = $row['Surname'];
            $email = $row['Email'];
            $emparray = array();
            $p_query = "SELECT PartsId FROM orders where TechnicianId=$id ";
            $query3= mysqli_query($connection,$p_query) or die("Could not retrieve parts from the database");
            while($row=mysqli_fetch_array($query3)){
                $pname = $row['PartsId'];
               Array_push($emparray,$pname);
                
                $p_query = "SELECT Name FROM parts where Id=$pname";
                $query2= mysqli_query($connection,$p_query) or die("Could not retrieve parts from the database");
                echo"<div class=\"course\">";
                while($row=mysqli_fetch_array($query2)){
                    
                    $pname = $row['Name'];
                       
                        echo "<div class=\"course-preview\">
                        <h6>Name</h6>
                        <h2> $name $surname </h2>
                        <p><a>ID :  $id </a></p>
                    </div>
                    <div class=\"course-info\">
                        <div class=\"progress-container\">
                            
                        </div>
                        <h6>Parts Ordered</h6>
                            <h5> $pname </h5><br>
                    
                    </div>";
              
    }
    echo "</div>";
    
    }
    
    
         }
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

.courses-container {
	
}

.course {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	display: flex;
	max-width: 100%;
	margin: 20px;
	overflow: hidden;
	width: 700px;
}

.course h6 {
	opacity: 0.6;
	margin: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
}

.course h2 {
	letter-spacing: 1px;
	margin: 10px 0;
}

.course-preview {
	background-color: rgb(170, 69, 89);
	color: #fff;
	padding: 30px;
	max-width: 250px;
}

.course-preview a {
	color: #;
	display: inline-block;
	font-size: 12px;
	opacity: 0.6;
	margin-top: 30px;
	text-decoration: none;
}

.course-info {
	padding: 30px;
	position: relative;
	width: 100%;
}

.progress-container {
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
</style>
</div>
</html>