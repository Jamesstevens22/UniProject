<!DOCTYPE html>

<?php 
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
  $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
}
else{
  $sign = '<a href="profile.php"> Profile';
  $logged = '<a href="logout.php"> Logout';
}
?>
<html lang="en">
<head>
  <title>Weather</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://api.checkwx.com/widgets/metartaf.js"></script>
</head>
<body>

<?php include 'php/nav.php' ?>

<div class="container">
        <div class="row">
            <div class="col col-md-2">
            </div>
            <div class="col-8 col-md-8">
                <img src="images/weather.jpg" alt="Weather">
            </div>
            <div class="col col-md-2">
            </div>
        </div>
    </div>
<footer><?php include 'php/footer.php'?></footer>
</body>
</html>