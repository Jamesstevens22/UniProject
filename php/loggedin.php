<?php
class logged {
    function loggedin($sign,$logged);{
            if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
        $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
        }
        else{
        $logged = '<a href="profile.php"> Profile';
        }
    }    
}

?>