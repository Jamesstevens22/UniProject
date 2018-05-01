<?php
require 'php/config.php';
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

$sqlselect = "SELECT * FROM newflight WHERE flight_no='$flightnum'";
$result2 = $link->query($sqlselect);

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $prop = $row['prop'];
        $date_of_mission = $row['date_of_mission'];
        $loc_of_mis = $row['loc_of_mis'];
        $tech_aims = $row['tech_aims'];
        $des_of_mis = $row['des_of_mis'];
        $des_of_pay = $row['des_of_pay'];
        $des_of_pro = $row['des_of_pro'];
        $num_of_ob = $row['num_of_ob'];
        $pay_req = $row['pay_req'];
        $rpas_req = $row['pay_req'];
        $reviewed = $row['reviewed'];
        $created_at = $row['created_at'];
    }
}


if (isset($_POST['submit'])){
    $flightnum = $_GET['flight_no'];

    $sqldeletenewflight = "DELETE FROM newflight WHERE flight_no='$flightnum'";
    $sqldeletenewreviewed = "DELETE FROM reviewed WHERE flight_no='$flightnum'";
    $sqldeletenewpreflight = "DELETE FROM preflight WHERE flight_no='$flightnum'";
    $sqldeletenewonsite = "DELETE FROM onsite WHERE flight_no='$flightnum'";
    $sqldeletenewpostflight = "DELETE FROM postflight WHERE flight_no='$flightnum'";

    mysqli_query($link, $sqldeletenewflight);
    mysqli_query($link, $sqldeletenewreviewed);
    mysqli_query($link, $sqldeletenewpreflight);
    mysqli_query($link, $sqldeletenewonsite);
    mysqli_query($link, $sqldeletenewpostflight);

    header("location: profile.php");
}

mysqli_close(); 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Flight</title>
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
        h4{
            text-align: left;
        }
        h5{
            margin-top: 20px;
            text-align: left;
        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
            background-color: #ffffff;
        }
        .navbar {
            border-radius: 0px;
        }
        .btn-group-justified>.btn, .btn-group-justified>.btn-group {
            padding: 20px;
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
        <div class="col-8 col-md-8">
            <h3>Flight Number: <?php   echo $_GET['flight_no'];?></h3>
            <h3>Status: <?php  
                            if ($reviewed === '1') {
                                echo "<span class='label label-primary'>Flight Submitted</span></td></tr>";
                            }
                            elseif ($reviewed === '2') {
                                echo "<span class='label label-info'>Reviewed</span></td></tr>";
                            }
                            elseif ($reviewed === '3') {
                                echo "<span class='label label-danger'>Onsite</span></td></tr>";
                            }
                            elseif ($reviewed === '4') {
                                echo "<span class='label label-warning'>Post Flight</span></td></tr>";
                            }
                            elseif ($reviewed === '5') {
                                echo "<span class='label label-success'>Completed</span></td></tr>";
                            }
                        ?>
            </h3>
            <h3>This action in not reversable</h3>
            <div class="btn-group btn-group-justified">
                <div class="btn-group" role="group">
                    <form action="profile.php" >
                            <input type="submit" class="btn btn-primary" value="Cancel" name="submit">       
                    </form>
                </div>
                <div class="btn-group" role="group">
                    <form action="" method="POST">
                            <input type="submit" class="btn btn-danger" value="Delete" name="submit">       
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-md-2">
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?> </footer>
</html>