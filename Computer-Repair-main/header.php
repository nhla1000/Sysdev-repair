
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<div class="header">
        <div class="logo">TechGurus</div>
        <div class="navigation">
        <nav>
            <ul>
            <li><a href="index.php" >Home</a></li>
                <li><a href="booking.php" >Bookings</a></li>
                <li><a href="progress.php" >Progress</a></li>
                <li><a href="profile.php" >Profile</a></li>
                <li><a href="login.php">Logout</a></li>
          
           
            </ul>
        </nav>
        </div>
    </div>
    <style>
    ul li a{
        padding:10px 20px;
    }
    .active{
        background-color:#340000;
        border:1px solid #C41E3A;
        border-radius:5px;
        
    }
</style>
<script>
    const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('nav a').forEach(link => {
  if(link.href.includes(`${activePage}`)){
    link.classList.add('active');
    console.log(link);
  }
})
</script>
</html>

