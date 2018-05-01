<?php
require_once 'php/config.php';
session_start();

$sesid = $_SESSION['username'];
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
  $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
}
else{
  $sign = '<a href="profile.php"> Profile';
  $logged = '<a href="logout.php"> Logout';
}
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}



if (isset($_POST['submit'])){
    
        $prop = $_POST['prop'];
        $date_of_mission = $_POST["date_of_mission"];
        $loc_of_mission = $_POST['loc_of_mis'];
        $tech_aims = $_POST['tech_aims'];
        $des_of_mis = $_POST['des_of_mis'];
        $des_of_pay = $_POST['des_of_pay'];
        $des_of_pro = $_POST['des_of_pro'];
        $num_of_ob = $_POST['num_of_ob'];
        $pay_req = $_POST['pay_req'];
        $rpas_req = $_POST['rpas_req'];

        $idselect = "SELECT id from users where username='$sesid'";
    
        $idresult = mysqli_query($link,$idselect);
        $result = mysqli_fetch_array($idresult);
        $id = $result['id'];





    
        $sqlinsert = "INSERT into newflight(id,prop,date_of_mission,loc_of_mis,tech_aims,des_of_mis,des_of_pay,des_of_pro,num_of_ob,pay_req,rpas_req) 
                        values ('$id','$prop','$date_of_mission','$loc_of_mission','$tech_aims','$des_of_mis','$des_of_pay', '$des_of_pro','$num_of_ob','$pay_req','$rpas_req')";
        
        mysqli_query($link, $sqlinsert);
        $sucess = "Flight Submitted!";
        header("location: profile.php");
    
    
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Flight</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">

        #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      body {
        font: 14px sans-serif; 
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
      <li class="active"><a href="newflight.php">New Flight</a></li>
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
    <div class="col-2 col-md-2">
    </div>
    <div class="col-8 col-md-8">
        <h2>Part A - Mission Plan</h2>
        <p>Please fill out the information below.</p>
        <form action="" method="POST">
            <div class="form-group">
                <label>Mission Proposers:</label>
                <input type="text" class="form-control" name="prop">
            </div> 
            <div class="form-group">
                <label>Date of Proposed Mission</label>
                <input type="text" class="form-control" name="date_of_mission">
            </div>   
            <div class="form-group">
                <label>Location of Mission</label>
                <input type="text"class="form-control" name="loc_of_mis">
            </div> 
            <div class="form-group">
                <label>Principal Technical Aims of the Mission:</label>
                <textarea class="form-control" rows="5" name="tech_aims"></textarea>
            </div>
            <div class="form-group">
                <label>Provide Detailed description of the mission, including estimated flight durations:</label>
                <textarea class="form-control" rows="7" name="des_of_mis"></textarea>
            </div>

            <div class="form-group">
                <label>Describe the Payload Requirements:</label>
                <textarea class="form-control" rows="3" name="des_of_pay"></textarea>
            </div>
            <div class="form-group">
                <label>Describe the Data processing plan:</label>
                <textarea class="form-control" rows="3" name="des_of_pro"></textarea>
            </div>
            <div class="form-group">
                <label>Number of Observers:</label>
                <input type="text" class="form-control" name="num_of_ob">
            </div>
            <div class="form-group">
                <label>Is a payload master required?:</label>
                <input type="text" class="form-control" name="pay_req">
            </div>
            <div class="form-group">
                <label>RPAS Required:</label>
                <input type="text" class="form-control" name="rpas_req">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit" name="submit">
            </div>
        </form>
    </div>
    <div class="col-2 col-md-2">
    </div>
</div>
</div>
<footer><?php include 'php/footer.php'?></footer>
</html>