<?php
define('DB_SERVER', 'db.jamesjjt.co.uk:3306');
define('DB_USERNAME', 'james');
define('DB_PASSWORD', 'fcG9Z5vc9D4dFz2P');
define('DB_NAME', 'james');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>