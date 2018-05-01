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
        $miss_prop_num = $_POST['miss_prop_num'];
        $land_own = $_POST['land_own'];
        $loc_res = $_POST['loc_res'];
        $atc = $_POST['atc'];
        $police = $_POST['police'];
        $site_per = $_POST['site_per'];
        $ide_pot_haz = $_POST['ide_pot_haz'];
        $airspace = $_POST['airspace'];
        $airfield = $_POST['airfield'];
        $res_air = $_POST['res_air'];
        $notams = $_POST['notams'];
        $date_of_rsk_ass = $_POST['date_of_rsk_ass'];
        $schl_dept = $_POST['schl_dept'];
        $ass_car_by = $_POST['ass_car_by'];
        $loc = $_POST['loc'];
        $per_cons_risk = $_POST['per_cons_risk'];
        $activity = $_POST['activity'];
        $what_hazards = $_POST['what_hazards'];
        $harmed = $_POST['harmed'];
        $already_doing = $_POST['already_doing'];
        $further_actions = $_POST['further_actions'];
        $into_action = $_POST['into_action'];

    
        $idresult = mysqli_query($link,$idselect);
        $result = mysqli_fetch_array($idresult);

        $sqlinsert = "INSERT into preflight(flight_no,miss_prop_num,land_own,loc_res,atc,police,site_per,ide_pot_haz,airspace,airfield,res_air,notams,date_of_rsk_ass,schl_dept,ass_car_by,loc,per_cons_risk,activity,what_hazards,harmed,already_doing,further_actions,into_action) 
                        values ('$flightnum','$miss_prop_num','$land_own','$loc_res','$atc','$police','$site_per','$ide_pot_haz','$airspace','$airfield','$res_air','$notams','$date_of_rsk_ass','$schl_dept','$ass_car_by','$loc','$per_cons_risk','$activity','$what_hazards','$harmed','$already_doing','$further_actions','$into_action')";
        
        $sqlupdate = "UPDATE newflight SET reviewed='3' WHERE flight_no='$flightnum'";
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
    <title>PreFlight</title>
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
        <h2>Pre-Flight</h2>
        <h3>Flight Number: <?php echo $flightnum ?></h3>
        <p>Please fill out the information below.</p>
        <form action="" method="POST">
            <div class="form-group">
                <label>Mission Proposers Name and Number:</label>
                <input type="text" class="form-control" name="miss_prop_num">
            </div> 
            <div class="form-group">
                <label>Landowner</label>
                <input type="text" class="form-control" name="land_own">
            </div>
            <hr>
            <h3>Pre-Notifications</h3>
            <div class="form-group">
                <label>Local Residents</label>
                <input type="text"class="form-control" name="loc_res">
            </div> 
            <div class="form-group">
                <label>Air Traffic Control</label>
                <input type="text"class="form-control" name="atc">
            </div>
            <div class="form-group">
                <label>Local Police</label>
                <input type="text"class="form-control" name="police">
            </div>
            <div class="form-group">
                <label>Site Permission</label>
                <input type="text"class="form-control" name="site_per">
            </div>
            <hr>
            <div class="form-group">
                <label>Identification of Potential Hazards</label>
                <textarea class="form-control" rows="7" name="ide_pot_haz"></textarea>
            </div>
            <hr>
            <h3>Aviation Features of the Area</h3>
            <div class="form-group">
                <label>Airspace</label>
                <textarea class="form-control" rows="2" name="airspace"></textarea>
            </div>
            <div class="form-group">
                <label>Airfield/Airports</label>
                <textarea class="form-control" rows="2" name="airfield"></textarea>
            </div>
            <div class="form-group">
                <label>Restricted Airspace</label>
                <textarea class="form-control" rows="2" name="res_air"></textarea>
            </div>
            <div class="form-group">
                <label>NOTAM's</label>
                <textarea class="form-control" rows="2" name="notams"></textarea>
            </div>
            <hr>
            <h3>Risk Assessment for RPAS Operation</h3>
            <div class="form-group">
                <label>Date of Risk Assessment</label>
                <input type="text"class="form-control" name="date_of_rsk_ass">
            </div>
            <div class="form-group">
                <label>School/Service Department</label>
                <input type="text"class="form-control" name="schl_dept">
            </div>
            <div class="form-group">
                <label>Assessment carried out by</label>
                <input type="text"class="form-control" name="ass_car_by">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text"class="form-control" name="loc">
            </div>
            <div class="form-group">
                <label>Persons Consulted during the risk assessment</label>
                <input type="text"class="form-control" name="per_cons_risk">
            </div>
            <div class="form-group">
                <label>Activity</label>
                <input type="text"class="form-control" name="activity">
            </div>
            <div class="form-group">
                <label>Step 1 - What are the hazards?</label>
                <textarea class="form-control" rows="4" name="what_hazards"></textarea>
            </div>
            <div class="form-group">
                <label>Who might be harmed and how?</label>
                <textarea class="form-control" rows="4" name="harmed"></textarea>
            </div>
            <div class="form-group">
                <label>Step 3a - What are you already doing?</label>
                <textarea class="form-control" rows="4" name="already_doing"></textarea>
            </div>
            <div class="form-group">
                <label>Step 3b - What further action is needed?</label>
                <textarea class="form-control" rows="4" name="further_actions"></textarea>
            </div>
            <div class="form-group">
                <label>Step 4 - How will you put this into action?</label>
                <textarea class="form-control" rows="4" name="into_action"></textarea>
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