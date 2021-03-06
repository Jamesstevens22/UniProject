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
  <title>Map</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://dronesafetymap.com/client/altitudeAngelMap.js"></script>
  <style>
  h3{
      text-align: center;
  }
  h4{
      text-align: center;
  }
  
  </style>
</head>
<body>

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
        <li class="active"><a href="map.php">Map</a></li>
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
        <h3>Enter the location that you would like to view the area for.</h3>
        <h4>Zoom in once you have found the location, to see more detailed information.</h4>
        <div class="col col-md-12">
            <div id="aamap" style="width: 800px; height:600px; margin:0; padding:0;"></div>
                    <script>
                        $(function () {
                            aa.initialize({
                                "target": "aamap",
                                "baseUrl": "https://dronesafetymap.com",
                                "authDetails": {
                                    "apiKey": "tSZk2c2WErkgjBPvT6U6kTKlEFHVEaO9hoKsR9au0"
                                }
                            });
                        });
                    </script>
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?></footer>
</body>
</html>