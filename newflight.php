<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-iYd8PrGX4e-3Ni1UT0dL9X0SQGLhnD4&libraries=drawing"></script>
    <script>var map;
        function initialize() {
        var myLatlng = new google.maps.LatLng(41.38,2.18);

        var myOptions = {
        zoom: 13,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        var marker = new google.maps.Marker({
        draggable: true,
        position: myLatlng,
        map: map,
        title: "Your location"
        });

        google.maps.event.addListener(map, 'click', function(event) {
            
            alert(event.latLng);
        });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <link rel="stylesheet" href="css/main.css">
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
      <li class="active"><a href="index.html">Home</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
        <form>
            <div class="form-group">
                <label>Mission Proposers:</label>
                <input type="text" name="Name"class="form-control">
            </div> 
            <div class="form-group">
                <label>Date of Proposed Mission</label>
                <input type="date" name="Name"class="form-control">
            </div>   
            <div class="form-group">
                <label>Location of Mission</label>
                <input type="text" name="Name"class="form-control">
            </div> 
            <div class="form-group">
                <label>Principal Technical Aims of the Mission:</label>
                <textarea class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Provide Detailed description of the mission, including estimated flight durations:</label>
                <textarea class="form-control" rows="7"></textarea>
            </div>

            <div class="form-group">
                <label>Describe the Payload Requirements:</label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Describe the Data processing plan:</label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Number of Observers:</label>
                <input type="number" name="Name"class="form-control">
            </div>
            <div class="form-group">
                <label>Is a payload master required?:</label>
                <input type="text" name="Name"class="form-control">
            </div>
            <div class="form-group">
                <label>RPAS Required:</label>
                <input type="text" name="Name"class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
    <div class="col-2 col-md-2">
    </div>
</div>
</div>
<footer>Hey, I'm the fixed footer :)</footer>
</html>

AIzaSyD-iYd8PrGX4e-3Ni1UT0dL9X0SQGLhnD4