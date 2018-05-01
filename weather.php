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
        <li class="active"><a href="weather.php">Weather</a></li>
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
            <div class="col-8 col-md-8">
            <h3>Weather for Wrexham</h3>            
            <h5>
                <?php
                    $weather_url = 'https://api.darksky.net/forecast/1c330c8321336b4cc7d03d02266077f0/53.053090,-3.006531?units=uk2';
                    $weather_json = file_get_contents($weather_url);
                    $weather_array = json_decode($weather_json, true);
                    echo "<table class='table'>"; 
                        echo "<thead>
                        <tr>
                          <th scope='col'>Time</th>
                          <th scope='col'>Wind</th>
                          <th scope='col'>Dir</th>
                          <th scope='col'>Gust</th>
                          <th scope='col'>Temp</th>
                          <th scope='col'>Cloud</th>
                          <th scope='col'>Press</th>
                        </tr>
                      </thead>";
                      $b = 0;
                      $a = 0;
                      while ($a <= 6) {
                        $time =  $weather_array['hourly']['data'][$b]['time'];
                        $time = date("H:i", $time);
                        $windspeed = round($weather_array['hourly']['data'][$b]['windSpeed']);
                        $windspeedknts = $windspeed * 0.868976;
                        $windspeedknts = round($windspeedknts);
                        $windhead = $weather_array['hourly']['data'][$b]['windBearing'];
                        $windgust = round($weather_array['hourly']['data'][$b]['windGust']);
                        $windgustknts = $windgust * 0.868976;
                        $windgustknts = round($windgustknts);
                        $temp = round($weather_array['hourly']['data'][$b]['temperature']);
                        $press = round($weather_array['hourly']['data'][$b]['pressure']);
                        $cloud = $weather_array['hourly']['data'][$b]['cloudCover'];
                        $cloud = round((float)$cloud * 100 ) . '%';
                        if ($windspeedknts < 10) {
                            echo "<tr><td>" .$time. "</td><td>" .$windspeed. " mph/" .$windspeedknts." kts</td><td>" .$windhead. "°</td><td>" .$windgust.  " mph/" .$windgustknts." kts</td><td>" .$temp. "°C</td><td>" .$cloud. "</td><td>" .$press. " mb</td></tr>";
                        }
                        elseif ($windspeedknts >=10 && $windspeedknts <15) {
                            echo "<tr class='warning'><td>" .$time. "</td><td>" .$windspeed. " mph/" .$windspeedknts." kts</td><td>" .$windhead. "°</td><td>" .$windgust.  " mph/" .$windgustknts." kts</td><td>" .$temp. "°C</td><td>" .$cloud. "</td><td>" .$press. " mb</td></tr>";
                        }
                        else {
                            echo "<tr class='danger'><td>" .$time. "</td><td>" .$windspeed. " mph/" .$windspeedknts." kts</td><td>" .$windhead. "°</td><td>" .$windgust.  " mph/" .$windgustknts." kts</td><td>" .$temp. "°C</td><td>" .$cloud. "</td><td>" .$press. " mb</td></tr>";
                        }
                        



                        $b++;
                        $a++;
                      }
                      echo "</table>";
                ?>
              </h5>
            </div>
            <div class="col col-md-2">
            </div>
        </div>
    </div>
<footer><?php include 'php/footer.php'?></footer>
</body>
</html>