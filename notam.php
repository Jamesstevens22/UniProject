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


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NOTAM's</title>
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
      <li><a href="newflight.php">New Flight</a></li>
      <li><a href="weather.php">Weather</a></li>
      <li><a href="map.php">Map</a></li>
      <li class="active"><a href="notam.php">NOTAM's</a></li>
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
    <h3>Enter the ICAO code for the airport that you would like the NOTAM's for.</h3>
    <form action="">
      <div class="form-group">
                <input type="text" name="location" class="form-control"/>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
                
    </form>
	<ul class="list-group">
            <?php
            if (!empty($_GET['location'])) {
                $airport = $_GET['location'];
                $airport = strtoupper($airport);
                $chester_url = 'https://api.autorouter.aero/v1.0/notam?itemas=["' . urlencode($airport) .'"]&offset=0&limit=10';
                $chester_json = file_get_contents($chester_url);
                $chester_array = json_decode($chester_json, true);
                $b = $chester_array['total'];
                $b = $b - 1; #due to the fact that arrays start at 0
                $a = 0;
            
                while ($a <= $b) {
                        $id =  $chester_array['rows'][$b]['id'];
                        if ($id === null) {
                          $b--;
                        }
                        else {
                          $id =  $chester_array['rows'][$b]['id'];
                          $iteme =  $chester_array['rows'][$b]['iteme'];
                          $validfrom =  $chester_array['rows'][$b]['startvalidity'];
                          $validfrom = date("Y-m-d\TH:i:s\Z", $validfrom);
                          $validto =  $chester_array['rows'][$b]['endvalidity'];
                          $validto = date("Y-m-d\TH:i:s\Z", $validto);
                          echo "<li class='list-group-item'>NOTAM ID:$id<p>$iteme<p>Valid From: $validfrom<p>Valid To: $validto</li>"; 
                          $b--;
                        }

                }
            }
                ?>
	</ul>
    </div>
    <div class="col col-md-2">
    </div>
</div>
</div>
<footer><?php include 'php/footer.php'?></footer>
</html>