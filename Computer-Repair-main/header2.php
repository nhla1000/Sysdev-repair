
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<div class="header">
        <div class="logo">TechGurus</div>
        <div class="navigation">
        <nav>
            <ul>
            <li ><a href="index2.php" >Home</a></li>
                <li><a href="techjobs.php" >Jobs</a></li>
                <li><a href="profile2.php" >Profile</a></li>
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

