<?php

    function loggedin(){
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
            $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
            $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
            return $sign;
            return $logged;
        }
        else{
            $logged = '<a href="profile.php"> Profile';
            return $logged;
        }
    }      
}
  
function weather($METAR){
    if(!empty($_GET['location'])){
        $weather_url = 'https://avwx.rest/api/metar/' . $_GET['location'];
      
        $weather_json = file_get_contents($weather_url);
        $weather_array = json_decode($weather_json, true);
      
        $METAR = $weather_array['Raw-Report'];
      }

}


?>