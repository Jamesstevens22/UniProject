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


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
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
        <div class="col-8 col-md-8">
            <h3>Your Flights</h3>
            <h4>Please note that you cannot edit or delete completed flights</h4>
                <?php 
                    $sesid = $_SESSION['username'];
                    $idselect = "SELECT id from users where username='$sesid'";
                    
                    $idresult = mysqli_query($link,$idselect);
                    $result = mysqli_fetch_array($idresult);
                    $id = $result['id'];
                
                    $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight WHERE id='$id'";
                    $result2 = $link->query($sqlselect);

                    echo "<table class='table'>"; 
                    if ($result2->num_rows > 0) {
                        echo "<thead>
                        <tr>
                          <th scope='col'>Flight Number</th>
                          <th scope='col'>Created at</th>
                          <th scope='col'>Status</th>
                          <th scope='col'>Edit</th>
                          <th scope='col'>Delete</th>
                        </tr>
                      </thead>";
                        while ($row = $result2->fetch_assoc()) {
                            $url = 'flight.php?flight_no=' . $row['flight_no'];
                            $urledit = 'editflight.php?flight_no=' . $row['flight_no'];
                            $urldelete = 'deleteflight.php?flight_no=' . $row['flight_no'];
                            if ($row['reviewed'] === '1') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-primary'>Flight Submitted</span></td><td> <a href='$urledit'><span class='glyphicon glyphicon-pencil' href='$urledit'></span></a></td> <td><a href='$urldelete'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
                            }
                            elseif ($row['reviewed'] === '2') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-info'>Reviewed</span></td><td> <a href='$urledit'><span class='glyphicon glyphicon-pencil' href='$urledit'></span></a></td> <td><a href='$urldelete'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
                            }
                            elseif ($row['reviewed'] === '3') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-danger'>Onsite</span></td><td> <a href='$urledit'><span class='glyphicon glyphicon-pencil' href='$urledit'></span></a></td> <td><a href='$urldelete'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
                            }
                            elseif ($row['reviewed'] === '4') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-warning'>Post Flight</span></td><td> <a href='$urledit'><span class='glyphicon glyphicon-pencil' href='$urledit'></span></a></td> <td><a href='$urldelete'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
                            }
                            elseif ($row['reviewed'] === '5') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-success'>Completed</span></td><td> <span> </span></td><td> <span> </span></td></tr>";
                            }
                            else{
                                echo "<tr><td>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td>" . $row['status'] . "</td></tr>";
                            }
                            
                        }
                    }
                    echo "</table>";
                    if ($result2->num_rows<1) {
                        echo "<h3>No Flights</h3>";
                    }

                    mysqli_close(); 

                ?>
            <hr>
            <h3>
                    Pre-Flights Available:
            </h3>
            <?php 
                    $sesid = $_SESSION['username'];
                    $idselect = "SELECT id from users where username='$sesid'";
                    
                    $idresult = mysqli_query($link,$idselect);
                    $result = mysqli_fetch_array($idresult);
                    $id = $result['id'];
                
                    $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight WHERE id='$id' AND reviewed='2'";
                    $result2 = $link->query($sqlselect);

                    echo "<table class='table'>"; 
                    if ($result2->num_rows > 0) {
                        echo "<thead>
                        <tr>
                          <th scope='col'>Flight Number</th>
                          <th scope='col'>Created at</th>
                          <th scope='col'>Status</th>
                        </tr>
                      </thead>";
                        while ($row = $result2->fetch_assoc()) {
                            $url = 'preflight.php?flight_no=' . $row['flight_no'];
                            if ($row['reviewed'] === '2') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-info'>Reviewed</span></td></tr>";
                            }
                            
                        }
                    }
                    echo "</table>";
                    if ($result2->num_rows<1) {
                        echo "<h4>No Pre Flights Flights Available</h4>";
                    }

                    mysqli_close(); 

                ?>
            <hr>
            <h3>
                    On-Sites Available:
            </h3>        
            <h4>
                If you will have not access to the internet while you perform the onsite, you can download the form from this <a href="onsite.php">page</a>.
            </h4>
            <?php 
                    $sesid = $_SESSION['username'];
                    $idselect = "SELECT id from users where username='$sesid'";
                    
                    $idresult = mysqli_query($link,$idselect);
                    $result = mysqli_fetch_array($idresult);
                    $id = $result['id'];
                
                    $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight WHERE id='$id' AND reviewed='3'";
                    $result2 = $link->query($sqlselect);

                    echo "<table class='table'>"; 
                    if ($result2->num_rows > 0) {
                        echo "<thead>
                        <tr>
                          <th scope='col'>Flight Number</th>
                          <th scope='col'>Created at</th>
                          <th scope='col'>Status</th>
                        </tr>
                      </thead>";
                        while ($row = $result2->fetch_assoc()) {
                            $url = 'onsite.php?flight_no=' . $row['flight_no'];
                            if ($row['reviewed'] === '3') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-danger'>On-Site</span></td></tr>";
                            }
                            
                        }
                    }
                    echo "</table>";
                    if ($result2->num_rows<1) {
                        echo "<h4>No Pre Flights Flights Available</h4>";
                    }

                    mysqli_close(); 

                ?>
            <hr>
            <h3>Post Flights Available</h3>
                <?php 
                        $sesid = $_SESSION['username'];
                        $idselect = "SELECT id from users where username='$sesid'";
                        
                        $idresult = mysqli_query($link,$idselect);
                        $result = mysqli_fetch_array($idresult);
                        $id = $result['id'];
                    
                        $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight WHERE id='$id' AND reviewed='4'";
                        $result2 = $link->query($sqlselect);

                        echo "<table class='table'>"; 
                        if ($result2->num_rows > 0) {
                            echo "<thead>
                            <tr>
                            <th scope='col'>Flight Number</th>
                            <th scope='col'>Created at</th>
                            <th scope='col'>Status</th>
                            </tr>
                        </thead>";
                            while ($row = $result2->fetch_assoc()) {
                                $url = 'postflight.php?flight_no=' . $row['flight_no'];
                                if ($row['reviewed'] === '4') {
                                    echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-warning'>Post Flight</span></td></tr>";
                                }
                                
                            }
                        }
                        echo "</table>";
                        if ($result2->num_rows<1) {
                            echo "<h4>No Post Flights Flights Available</h4>";
                        }

                        mysqli_close(); 

                    ?>

        </div>
        <div class="col col-md-2">
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?> </footer>
</html>