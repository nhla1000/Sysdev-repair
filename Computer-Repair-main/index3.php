<?php 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
   <?php include 'header3.php'; ?>
    <script >
        var i = 0; 			// Start Point
var images = [];	// Images Array
var time = 4000;	// Time Between Switch
	 
// Image List
images[0] = "./images/1.jpg";
images[1] = "./images/7.png";
images[2] = "./images/3.jpg";
images[3] = "./images/4.jpg";

// Change Image
function changeImg(){
	document.slide.src = images[i];

	// Check If Index Is Under Max
	if(i < images.length - 1){
	  // Add 1 to Index
	  i++; 
	} else { 
		// Reset Back To O
		i = 0;
	}

	// Run function every x seconds
	setTimeout("changeImg()", time);
}

// Run function when page loads
window.onload=changeImg;
    </script>
    <div class="slider-img">
    <img name="slide" width="100%" height="430" alt="">
    </div>
    
</body>
<div class="prefooter">
    <div class="text"> Welcome <?php echo $_SESSION['Name']." ". $_SESSION['Surname']; ?> to repair Hub ! The number One Brand You can Trust with your Technological Gargets </div>
    <div class="make-booking">
    
    </div>
</div>
<div class="footer">

<div class="supporting">   
<div class="Contact-us">Contact Us</div><br>
    <div class="footer-links">
    <a href="">Facebook</a>
    <a href="">Instagram</a>
    <a href="">Email</a>
    </div>
</div>
 

</div>
</html>