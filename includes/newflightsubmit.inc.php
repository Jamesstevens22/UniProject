<?php
require_once 'php/config.php';
// Initialize the session
session_start();
//vars g
if (isset($_POST['submit'])){

    $prop = $POST['prop'];
    $date_of_mission = $POST['date_of_mission'];
    $loc_of_mission = $POST['loc_of_mission'];
    $tech_aims = $POST['tech_aims'];
    $des_of_mis = $POST['des_of_mis'];
    $des_of_pay = $POST['des_of_pay'];
    $des_of_pro = $POST['des_of_pro'];
    $num_of_ob = $POST['num_of_ob'];
    $pay_req = $POST['pay_req'];
    $rpas_req = $POST['rpas_rew'];
    $id = '1';

    $sqlinsert = "INSERT into newflight(id,prop,date_of_mission,loc_of_mis,tech_aims,des_of_mis,des_of_pay,des_of_pro,num_of_ob,pay_req,rpas_req) 
                    values ('$id','$prop','$date_of_mission','$loc_of_mission','$tech_aims','$des_of_mis','$des_of_pay', '$des_of_pro','$num_of_ob','$pay_req','$rpas_req')";
    
    mysqli_query($link, $sqlinsert);


}

header("location: welcome.php");

?>