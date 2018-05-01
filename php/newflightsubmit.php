<?php
if (isset($_POST['submit'])){
    define('DB_SERVER', 'db.jamesjjt.co.uk:3306');
    define('DB_USERNAME', 'james');
    define('DB_PASSWORD', 'fcG9Z5vc9D4dFz2P');
    define('DB_NAME', 'james');
     
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $prop = $_POST['prop'];
    $date_of_mission = $_POST['date_of_mission'];
    $loc_of_mission = $_POST['loc_of_mission'];
    $tech_aims = $_POST['tech_aims'];
    $des_of_mis = $_POST['des_of_mis'];
    $des_of_pay = $_POST['des_of_pay'];
    $des_of_pro = $_POST['des_of_pro'];
    $num_of_ob = $_POST['num_of_ob'];
    $pay_req = $_POST['pay_req'];
    $rpas_req = $_POST['rpas_rew'];

    $sesuser = $_SESSION['username'];

    $sqlid = "SELECT ID FROM USERS WHERE username='$sesuser'";
    $id = $link->query($sqlid);



    $sqlinsert = "INSERT into newflight(id,prop,date_of_mission,loc_of_mis,tech_aims,des_of_mis,des_of_pay,des_of_pro,num_of_ob,pay_req,rpas_req) 
                    values ('$id','$prop','$date_of_mission','$loc_of_mission','$tech_aims','$des_of_mis','$des_of_pay', '$des_of_pro','$num_of_ob','$pay_req','$rpas_req')";
    mysqli_query($link, $sql);
    header("Location: ../profile.php");

?>