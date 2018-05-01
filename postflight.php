<?php
require_once 'php/config.php';
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
  $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
}
else{
  $sign = '<a href="profile.php"> Profile';
  $logged = '<a href="logout.php"> Logout';
}

$flightnum = $_GET['flight_no'];

if (isset($_POST['submit'])){
        $post_note = $_POST['post_notes'];

    
        $idresult = mysqli_query($link,$idselect);
        $result = mysqli_fetch_array($idresult);

        $sqlinsert = "INSERT into postflight(flight_no,post_note) 
                        values ('$flightnum','$post_note')";
        
        $sqlupdate = "UPDATE newflight SET reviewed='5' WHERE flight_no='$flightnum'";
        mysqli_query($link, $sqlinsert);
        mysqli_query($link, $sqlupdate);
        $sucess = "Flight Submitted!";
        header("location: profile.php");
    
    
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Flight</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ 
            font: 14px sans-serif;
            text-align: center;
            
            }
        th{
            text-align: center;
        }
    </style>
</head>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
    </button>
    <a class="navbar-brand" href="#">Drone Managment System</a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="newflight.php">New Flight</a></li>
      <li><a href="weather.php">Weather</a></li>
      <li><a href="map.php">Map</a></li>
      <li><a href="notam.php">NOTAM's</a></li>
        <li><a href="risk.php">Risk Assessment</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li><?php echo $sign ?></a></li>
    <li><?php echo $logged ?></a></li>
  </ul>
  </div>
</div>
</nav>

<div class="container">
    <div class="row">
        <div class="col col-md-2">
        </div>
        <div class="col col-md-8">        
        <h2>Post Flight</h2>
        <h3>Flight Number: <?php echo $flightnum ?></h3>
        <p>Please fill out the information below.</p>
        <form action="" method="POST">
            <div class="form-group">
                <label>Post flight notes:</label>
                <textarea class="form-control" rows="5" name="post_notes"></textarea>
            </div> 
        <h4>By Pressing this button, it will mark the flight as complete.</h4>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </div>
        </form>
        </div>
        <div class="col col-md-2">
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?> </footer>
</html>