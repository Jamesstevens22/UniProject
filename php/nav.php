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
echo
"<nav class='navbar navbar-inverse'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>                        
      </button>
      <a class='navbar-brand' href='#'>Drone Managment System</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
      <ul class='nav navbar-nav'>
        <li><a href='index.php'>Home</a></li>
        <li><a href='newflight.php'>New Flight</a></li>
        <li class='active'><a href='weather.php'>Weather</a></li>
        <li><a href='map.php'>Map</a></li>
      </ul>
      <ul class='nav navbar-nav navbar-right'>
        <li><?php echo $sign ?></a></li>
        <li><?php echo $logged ?></a></li>
      </ul>
    </div>
  </div>
</nav>";

?>