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
        $job_no = $_POST['job_no'];
        $date_of_survey = $_POST['date_of_survey'];
        $location = $_POST['location'];
        $tsk_out = $_POST['tsk_out'];
        $int_tsk = $_POST['int_tsk'];
        $wind_speed = $_POST['wind_speed'];
        $temp = $_POST['temp'];
        $cloud_cover = $_POST['cloud_cover'];
        $direction = $_POST['direction'];
        $precip = $_POST['precip'];
        $visibility = $_POST['visibility'];
        $gusting = $_POST['gusting'];
        $cloud_type = $_POST['cloud_type'];
        $hivis = $_POST['hivis'];
        $saf_glov = $_POST['saf_glov'];
        $saf_glas = $_POST['saf_glas'];
        $saf_boot = $_POST['saf_boot'];
        $hard_hat = $_POST['hard_hat'];
        $note = $_POST['note'];
        $name = $_POST['name'];
        $signed = $_POST['signed'];
        $dateofsign = $_POST['dateofsign'];


        $sqlinsert = "INSERT into onsite(flight_no,job_no,date_of_survey,location,tsk_out,int_tsk,wind_speed,temp,cloud_cover,direction,precip,visibility,gusting,cloud_type,hivis,saf_glov,saf_glas,saf_boot,hard_hat,note,name,signed,dateofsign) 
                        values ('$flightnum','$job_no','$date_of_survey','$location','$tsk_out','$int_tsk','$wind_speed','$temp','$cloud_cover','$direction','$precip','$visibility','$gusting','$cloud_type','$hivis','$saf_glov','$saf_glas','$saf_boot','$hard_hat','$note','$name','$signed','$dateofsign')";
        
        $sqlupdate = "UPDATE newflight SET reviewed='4' WHERE flight_no='$flightnum'";
        mysqli_query($link, $sqlinsert);
        mysqli_query($link, $sqlupdate);
        $sucess = "Flight Submitted!";
        header("location: profile.php");
    
    
    }



$weather_url = 'https://api.darksky.net/forecast/1c330c8321336b4cc7d03d02266077f0/53.053090,-3.006531?units=uk2';
$weather_json1 = file_get_contents($weather_url);
$weather_array1 = json_decode($weather_json1, true);

$windspeed1 = round($weather_array1['hourly']['data'][0]['windSpeed']) . " mph";
$windhead1 = $weather_array1['hourly']['data'][0]['windBearing'] . "°";
$temp1 = round($weather_array1['hourly']['data'][0]['temperature']) . "°C";
$cloud1 = $weather_array1['hourly']['data'][0]['cloudCover'];
$cloud1 = round((float)$cloud1 * 100 ) . '%';
$precip = $weather_array1['hourly']['data'][0]['precipType'];
    if ($precip === null) {
        $precip = 'None';
    }
    else {
        $precip = $weather_array1['hourly']['data'][0]['precipType'];
    }
$vis = $weather_array1['hourly']['data'][0]['visibility'] . ' km';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Onsite</title>
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
        <div class="col col-md-5">        
        <h2>Onsite </h2>
        <h3>Flight Number: <?php echo $flightnum ?></h3>
        <p>Please fill out the information below.</p>
        <form action="" method="POST">
            <div class="form-group">
                <label>Job Number</label>
                <input type="text" class="form-control" name="job_no">
            </div> 
            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control" name="date_of_survey">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text"class="form-control" name="location">
            </div> 
            <div class="form-group">
                <label>Task Outline</label>
                <textarea class="form-control" rows="3" name="tsk_out"></textarea>
            </div>
            <div class="form-group">
                <label>Notes of intended task:</label>
                <textarea class="form-control" rows="5" name="int_tsk"></textarea>
            </div>
            <hr>
            <h3>Drawing</h3>
            <hr>
            <h3>Met Data</h3>
            <div class="form-group">
                <label>Wind Speed</label>
                <input type="text"class="form-control" name="wind_speed" value="<?php echo $windspeed1 ?>">
            </div>
            <div class="form-group">
                <label>Temperature</label>
                <input type="text"class="form-control" name="temp" value="<?php echo $temp1 ?>">
            </div>
            <div class="form-group">
                <label>Cloud Cover</label>
                <input type="text"class="form-control" name="cloud_cover" value="<?php echo $cloud1?>">
            </div>
            <div class="form-group">
                <label>Direction</label>
                <input type="text"class="form-control" name="direction"  value="<?php echo $windhead1 ?>">
            </div>
            <div class="form-group">
                <label>Precipitation</label>
                <input type="text"class="form-control" name="precip" value="<?php echo $precip ?>">
            </div>
            <div class="form-group">
                <label>Visibility</label>
                <input type="text"class="form-control" name="visibility" value="<?php echo $vis ?>">
            </div>
            <div class="form-group">
                <label>Gusting</label>
                <input type="text"class="form-control" name="gusting">
            </div>
            <div class="form-group">
                <label>Cloud Type</label>
                <input type="text"class="form-control" name="cloud_type">
            </div>
            <hr>
            <h3>PPE</h3>
            <div class="form-group">
                <label>Hi-Vis Jacket</label>
                <input type="text"class="form-control" name="hivis">
            </div>
            <div class="form-group">
                <label>Safety Gloves</label>
                <input type="text"class="form-control" name="saf_glov">
            </div>
            <div class="form-group">
                <label>Safety Glasses</label>
                <input type="text"class="form-control" name="saf_glas">
            </div>
            <div class="form-group">
                <label>Safety Boots</label>
                <input type="text"class="form-control" name="saf_boot">
            </div>
            <div class="form-group">
                <label>Hard Hat</label>
                <input type="text"class="form-control" name="hard_hat">
            </div>
            <hr>
            <h3>Additional Notes</h3>
            <div class="form-group">
                <label>Notes:</label>
                <textarea class="form-control" rows="5" name="note"></textarea>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text"class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Signed</label>
                <input type="text"class="form-control" name="signed">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="text"class="form-control" name="dateofsign">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </div>
        </form>
        </div>
        <div class="col col-md-2">
        </div>
        <div class="col col-md-5">
            <h3>6 Hour Weather:</h3>
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
            <hr>
            <h2>
                Key Contact Details
            </h2>
            <h3>
                Local Police:
            </h3>
            <h4>
                North Wales Police
                Address: Bodhyfryd, Wrexham, LL12 7BW
                Phone: 0300 330 0101
            </h4>
            <h3>
                Emergency Services:
            </h3>
            <h4>
                999: for emergency response <br>
                101: for police non-emergency resoponse.
            </h4>
            <h3>
                Nearest A&E unit.
            </h3>
            <h4>
                Wrexham Maelor Hospital
                Croesnewydd Road, Wrexham Technology Park, Wrexham, LL13 7TD <br>
                Phone: +44 (0) 1978 291100
            </h4>
            <h3>
                Aviation Contacts:
            </h3>
            <h4>
                Harwarden Airport
                Tel: 01244 538568 <br>
            </h4>
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?> </footer>
</html>