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
$flightnum1 = $_GET['flight_no'];
$sqlselect3 = "SELECT * FROM reviewed WHERE flight_no='$flightnum1'";
$result3 = $link->query($sqlselect3);

if ($result3->num_rows > 0) {
    while ($row2 = $result3->fetch_assoc()) {
        $RPAS_All = $row2['RPAS_All'];
        $pay_all = $row2['pay_all'];
        $pic_all = $row2['pic_all'];
        $pay_mas_all = $row2['pay_mas_all'];
        $notes = $row2['notes'];
        $signed = $row2['signed'];
        $datesigned = $row2['datesigned'];
        $flightnum2 = $row2['flight_no'];
    }
}

$sqlselect4 = "SELECT * FROM preflight WHERE flight_no='$flightnum1'";
$result4 = $link->query($sqlselect4);
if ($result4->num_rows > 0) {
    while ($row3 = $result4->fetch_assoc()) {
        $miss_prop_num = $row3['miss_prop_num'];
        $land_own = $row3['land_own'];
        $loc_res = $row3['loc_res'];
        $atc = $row3['atc'];
        $police = $row3['police'];
        $site_per = $row3['site_per'];
        $ide_pot_haz = $row3['ide_pot_haz'];
        $airspace = $row3['airspace'];
        $airfield = $row3['airfield'];
        $res_air = $row3['res_air'];
        $notams = $row3['notams'];
        $date_of_rsk_ass = $row3['date_of_rsk_ass'];
        $schl_dept = $row3['schl_dept'];
        $ass_car_by = $row3['ass_car_by'];
        $loc = $row3['loc'];
        $per_cons_risk = $row3['per_cons_risk'];
        $activity = $row3['activity'];
        $what_hazards = $row3['what_hazards'];
        $harmed = $row3['harmed'];
        $already_doing = $row3['already_doing'];
        $further_actions = $row3['further_actions'];
        $into_action = $row3['into_action'];
    }
}

$sqlselect5 = "SELECT * FROM onsite WHERE flight_no='$flightnum1'";
$result5 = $link->query($sqlselect5);
if ($result5->num_rows > 0) {
    while ($row5 = $result5->fetch_assoc()) {
        $job_no = $row5['job_no'];
        $date_of_survey = $row5['date_of_survey'];
        $location = $row5['location'];
        $tsk_out = $row5['tsk_out'];
        $int_tsk = $row5['int_tsk'];
        $wind_speed = $row5['wind_speed'];
        $temp = $row5['temp'];
        $cloud_cover = $row5['cloud_cover'];
        $direction = $row5['direction'];
        $precip = $row5['precip'];
        $visibility = $row5['visibility'];
        $gusting = $row5['gusting'];
        $cloud_type = $row5['cloud_type'];
        $hivis = $row5['hivis'];
        $saf_glov = $row5['saf_glov'];
        $saf_glas = $row5['saf_glas'];
        $saf_boot = $row5['saf_boot'];
        $hard_hat = $row5['hard_hat'];
        $note = $row5['note'];
        $name = $row5['name'];
        $signed = $row5['signed'];
        $dateofsign = $row5['dateofsign'];
    }
}

$sqlselect6 = "SELECT * FROM postflight WHERE flight_no='$flightnum1'";
$result6 = $link->query($sqlselect6);
if ($result6->num_rows > 0) {
    while ($row6 = $result6->fetch_assoc()) {
        $post_note = $row6['post_note'];
    }
}


if (isset($_POST['submit'])){
        #new flight
        $prop1 = $_POST['prop'];
        $date_of_mission1 = $_POST["date_of_mission"];
        $loc_of_mission1 = $_POST['loc_of_mis'];
        $tech_aims1 = $_POST['tech_aims'];
        $des_of_mis1 = $_POST['des_of_mis'];
        $des_of_pay1 = $_POST['des_of_pay'];
        $des_of_pro1 = $_POST['des_of_pro'];
        $num_of_ob1 = $_POST['num_of_ob'];
        $pay_req1 = $_POST['pay_req'];
        $rpas_req1 = $_POST['rpas_req'];


        $sqlupdate1 = "UPDATE newflight
                      set  prop='$prop1',date_of_mission='$date_of_mission1',loc_of_mis='$loc_of_mission1',tech_aims='$tech_aims1',des_of_mis='$des_of_mis1',des_of_pay='$des_of_pay1',des_of_pro='$des_of_pro1',num_of_ob='$num_of_ob1',pay_req='$pay_req1',rpas_req='$rpas_req1'
                      where flight_no='$flightnum1';";
        
        mysqli_query($link, $sqlupdate1);

        #Preflight
        $miss_prop_num2 = $_POST['miss_prop_num'];
        $land_own2 = $_POST['land_own'];
        $loc_res2 = $_POST['loc_res'];
        $atc2 = $_POST['atc'];
        $police2 = $_POST['police'];
        $site_per2 = $_POST['site_per'];
        $ide_pot_haz2 = $_POST['ide_pot_haz'];
        $airspace2 = $_POST['airspace'];
        $airfield2 = $_POST['airfield'];
        $res_air2 = $_POST['res_air'];
        $notams2 = $_POST['notams'];
        $date_of_rsk_ass2 = $_POST['date_of_rsk_ass'];
        $schl_dept2 = $_POST['schl_dept'];
        $ass_car_by2 = $_POST['ass_car_by'];
        $loc2 = $_POST['loc'];
        $per_cons_risk2 = $_POST['per_cons_risk'];
        $activity2 = $_POST['activity'];
        $what_hazards2 = $_POST['what_hazards'];
        $harmed2 = $_POST['harmed'];
        $already_doing2 = $_POST['already_doing'];
        $further_actions2 = $_POST['further_actions'];
        $into_action2 = $_POST['into_action'];

        $sqlupdate2 = "UPDATE preflight
                        set miss_prop_num='$miss_prop_num2',land_own='$land_own2',loc_res='$loc_res2',atc='$atc2',police='$police2',site_per='$site_per2',ide_pot_haz='$ide_pot_haz2',airspace='$airspace2',airfield='$airfield2',res_air='$res_air2',notams='$notams2',date_of_rsk_ass='$date_of_rsk_ass2',schl_dept='$schl_dept2',ass_car_by='$ass_car_by2',loc='$loc2',per_cons_risk='$per_cons_risk2',activity='$activity2',what_hazards='$what_hazards2',harmed='$harmed2',already_doing='$already_doing2',further_actions='$further_actions2',into_action='$into_action2'
                        where flight_no='$flightnum1'";
        
        mysqli_query($link, $sqlupdate2);

        #onsite
        $job_no3 = $_POST['job_no'];
        $date_of_survey3 = $_POST['date_of_survey'];
        $location3 = $_POST['location'];
        $tsk_out3 = $_POST['tsk_out'];
        $int_tsk3 = $_POST['int_tsk'];
        $wind_speed3 = $_POST['wind_speed'];
        $temp3 = $_POST['temp'];
        $cloud_cover3 = $_POST['cloud_cover'];
        $direction3 = $_POST['direction'];
        $precip3 = $_POST['precip'];
        $visibility3 = $_POST['visibility'];
        $gusting3 = $_POST['gusting'];
        $cloud_type3 = $_POST['cloud_type'];
        $hivis3 = $_POST['hivis'];
        $saf_glov3 = $_POST['saf_glov'];
        $saf_glas3 = $_POST['saf_glas'];
        $saf_boot3 = $_POST['saf_boot'];
        $hard_hat3 = $_POST['hard_hat'];
        $note3 = $_POST['note'];
        $name3 = $_POST['name'];
        $signed3 = $_POST['signed'];
        $dateofsign3 = $_POST['dateofsign'];


        $sqlupdate3 = "UPDATE onsite
                        set job_no='$job_no3',date_of_survey='$date_of_survey3',location='$location3',tsk_out='$tsk_out3',int_tsk='$int_tsk3',gusting='$gusting3',cloud_type='$cloud_type3',hivis='$hivis3',saf_glov='$saf_glov3',saf_glas='$saf_glas3',saf_boot='$saf_boot3',hard_hat='$hard_hat3',note='$note3'
                        WHERE flight_no='$flightnum1";
        
        mysqli_query($link, $sqlupdate3);



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
            <form action="" method="POST">
                <H3>
                    Part A - Mission Plan
                </H3>
                <h4>
                    Mission Proposers:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="prop" value="<?php echo $prop;?>">
                </h5>
                <h4>
                    Date of Proposed Mission:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="date_of_mission" value="<?php echo $date_of_mission;?>">
                </h5>
                <h4>
                    Location of Mission:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="loc_of_mis" value="<?php echo $loc_of_mis?>">
                </h5>
                <h4>
                    Principal technical aims of the mission:
                </h4>
                <h5>
                    <textarea class="form-control" rows="5" name="tech_aims"><?php echo $tech_aims; ?></textarea>
                </h5>
                <h4>
                    Provide Detailed description of the mission, including estimated flight durations:
                </h4>
                <h5>
                    <textarea class="form-control" rows="7" name="des_of_mis"><?php echo $des_of_mis?></textarea>
                </h5>
                <h4>
                    Describe the Payload Requirements:
                </h4>
                <h5>
                    <textarea class="form-control" rows="3" name="des_of_pay"><?php echo $des_of_pay?></textarea>
                </h5>
                <h4>
                    Describe the Data processing plan:
                </h4>
                <h5>
                    <textarea class="form-control" rows="3" name="des_of_pro"><?php echo $des_of_pro?></textarea>
                </h5>
                <h4>
                    Number of Observers:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="num_of_ob" value="<?php echo $num_of_ob?>">
                </h5>
                <h4>
                    Is a payload master required?:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="pay_req" value="<?php echo $pay_req?>">
                </h5>
                <h4>
                    RPAS Required: 
                </h4>
                <h5>
                    <input type="text" class="form-control" name="rpas_req" value="<?php echo $rpas_req?>">
                </h5>
                <hr>
                <h3>
                    Response from Drone Manager
                </h3>            
                <h4>
                    RPAS Allocated and confirmation of pre-mission check:
                </h4>
                <h5>
                    <input type="text" class="form-control" name="RPAS_All" value="<?php echo $RPAS_All?>"disabled>
                </h5>
                <h4>Payload Allocated</h4>
                <input type="text" class="form-control" name="pay_all" value="<?php echo $pay_all?>"disabled>

            
                <h4>Name of PIC allocated</h4>
                <input type="text"class="form-control" name="pic_all" value="<?php echo $pic_all?>"disabled>

            
                <h4>Name of Payload master allocated</h4>
                <input type="text"class="form-control" name="pay_mas_all" value="<?php echo $pay_mas_all?>"disabled>

            
                <h4>Notes or endorsements by the operations manager approving the mission</h4>
                <textarea class="form-control" rows="5" name="notes"disabled><?php echo $signed ?></textarea>

            
                <h4>Signed: (Ops Man)</h4>
                <input type="text"class="form-control" name="signed" value="<?php echo $signed?>"disabled>

            
                <h4>Date:</h4>
                <input type="text"class="form-control" name="datesigned" value="<?php echo $datesigned?>"disabled>
                <hr>
                <h3>
                    Preflight 
                </h3>
                <div class="form-group">
                    <label>Mission Proposers Name and Number:</label>
                    <input type="text" class="form-control" name="miss_prop_num"value="<?php echo $miss_prop_num?>">
                </div> 
                <div class="form-group">
                    <label>Landowner</label>
                    <input type="text" class="form-control" name="land_own"value="<?php echo $land_own?>">
                </div>
                <hr>
                <h3>Pre-Notifications</h3>
                <div class="form-group">
                    <label>Local Residents</label>
                    <input type="text"class="form-control" name="loc_res" value="<?php echo $loc_res?>">
                </div> 
                <div class="form-group">
                    <label>Air Traffic Control</label>
                    <input type="text"class="form-control" name="atc" value="<?php echo $atc?>">
                </div>
                <div class="form-group">
                    <label>Local Police</label>
                    <input type="text"class="form-control" name="police" value="<?php echo $police?>">
                </div>
                <div class="form-group">
                    <label>Site Permission</label>
                    <input type="text"class="form-control" name="site_per" value="<?php echo $site_per?>">
                </div>
                <hr>
                <div class="form-group">
                    <label>Identification of Potential Hazards</label>
                    <textarea class="form-control" rows="7" name="ide_pot_haz"><?php echo $ide_pot_haz?></textarea>
                </div>
                <hr>
                <h3>Aviation Features of the Area</h3>
                <div class="form-group">
                    <label>Airspace</label>
                    <textarea class="form-control" rows="2" name="airspace"><?php echo $airspace?></textarea>
                </div>
                <div class="form-group">
                    <label>Airfield/Airports</label>
                    <textarea class="form-control" rows="2" name="airfield"><?php echo $airfield?></textarea>
                </div>
                <div class="form-group">
                    <label>Restricted Airspace</label>
                    <textarea class="form-control" rows="2" name="res_air"><?php echo $res_air?></textarea>
                </div>
                <div class="form-group">
                    <label>NOTAM's</label>
                    <textarea class="form-control" rows="2" name="notams"><?php echo $notams?></textarea>
                </div>
                <hr>
                <h3>Risk Assessment for RPAS Operation</h3>
                <div class="form-group">
                    <label>Date of Risk Assessment</label>
                    <input type="text"class="form-control" name="date_of_rsk_ass" value="<?php echo $date_of_rsk_ass?>">
                </div>
                <div class="form-group">
                    <label>School/Service Department</label>
                    <input type="text"class="form-control" name="schl_dept" value="<?php echo $schl_dept?>">
                </div>
                <div class="form-group">
                    <label>Assessment carried out by</label>
                    <input type="text"class="form-control" name="ass_car_by" value="<?php echo $ass_car_by?>">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text"class="form-control" name="loc" value="<?php echo $loc?>">
                </div>
                <div class="form-group">
                    <label>Persons Consulted during the risk assessment</label>
                    <input type="text"class="form-control" name="per_cons_risk" value="<?php echo $per_cons_risk?>">
                </div>
                <div class="form-group">
                    <label>Activity</label>
                    <input type="text"class="form-control" name="activity" value="<?php echo $activity?>">
                </div>
                <div class="form-group">
                    <label>Step 1 - What are the hazards?</label>
                    <textarea class="form-control" rows="4" name="what_hazards"><?php echo $what_hazards?></textarea>
                </div>
                <div class="form-group">
                    <label>Who might be harmed and how?</label>
                    <textarea class="form-control" rows="4" name="harmed"><?php echo $harmed?></textarea>
                </div>
                <div class="form-group">
                    <label>Step 3a - What are you already doing?</label>
                    <textarea class="form-control" rows="4" name="already_doing"><?php echo $already_doing?></textarea>
                </div>
                <div class="form-group">
                    <label>Step 3b - What further action is needed?</label>
                    <textarea class="form-control" rows="4" name="further_actions"><?php echo $further_actions?></textarea>
                </div>
                <div class="form-group">
                    <label>Step 4 - How will you put this into action?</label>
                    <textarea class="form-control" rows="4" name="into_action"><?php echo $into_action?></textarea>
                </div>
                <hr>
                <h3>Onsite</h3>
                <div class="form-group">
                    <label>Job Number</label>
                    <input type="text" class="form-control" name="job_no" value="<?php echo $job_no?>">
                </div> 
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date_of_survey" value="<?php echo $date_of_survey?>">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text"class="form-control" name="location" value="<?php echo $location?>">
                </div> 
                <div class="form-group">
                    <label>Task Outline</label>
                    <textarea class="form-control" rows="3" name="tsk_out"><?php echo $tsk_out?></textarea>
                </div>
                <div class="form-group">
                    <label>Notes of intended task:</label>
                    <textarea class="form-control" rows="5" name="int_tsk"><?php echo $int_tsk?></textarea>
                </div>
                <hr>
                <h3>Drawing</h3>
                <hr>
                <h3>Met Data</h3>
                <div class="form-group">
                    <label>Wind Speed</label>
                    <input type="text"class="form-control" name="wind_speed"  value="<?php echo $wind_speed?>"disabled>
                </div>
                <div class="form-group">
                    <label>Temperature</label>
                    <input type="text"class="form-control" name="temp"  value="<?php echo $temp?>"disabled>
                </div>
                <div class="form-group">
                    <label>Cloud Cover</label>
                    <input type="text"class="form-control" name="cloud_cover"  value="<?php echo $cloud_cover?>"disabled>
                </div>
                <div class="form-group">
                    <label>Direction</label>
                    <input type="text"class="form-control" name="direction"   value="<?php echo $direction?>"disabled>
                </div>
                <div class="form-group">
                    <label>Precipitation</label>
                    <input type="text"class="form-control" name="precip"  value="<?php echo $precip?>"disabled>
                </div>
                <div class="form-group">
                    <label>Visibility</label>
                    <input type="text"class="form-control" name="visibility"  value="<?php echo $visibility?>"disabled>
                </div>
                <div class="form-group">
                    <label>Gusting</label>
                    <input type="text"class="form-control" name="gusting" value="<?php echo $gusting?>">
                </div>
                <div class="form-group">
                    <label>Cloud Type</label>
                    <input type="text"class="form-control" name="cloud_type" value="<?php echo $cloud_type?>">
                </div>
                <hr>
                <h3>PPE</h3>
                <div class="form-group">
                    <label>Hi-Vis Jacket</label>
                    <input type="text"class="form-control" name="hivis" value="<?php echo $hivis?>">
                </div>
                <div class="form-group">
                    <label>Saftey Gloves</label>
                    <input type="text"class="form-control" name="saf_glov" value="<?php echo $saf_glov?>">
                </div>
                <div class="form-group">
                    <label>Saftey Glasses</label>
                    <input type="text"class="form-control" name="saf_glas" value="<?php echo $saf_glas?>">
                </div>
                <div class="form-group">
                    <label>Saftey Boots</label>
                    <input type="text"class="form-control" name="saf_boot" value="<?php echo $saf_boot?>">
                </div>
                <div class="form-group">
                    <label>Hard Hat</label>
                    <input type="text"class="form-control" name="hard_hat" value="<?php echo $hard_hat?>">
                </div>
                <hr>
                <h3>Additional Notes</h3>
                <div class="form-group">
                    <label>Notes:</label>
                    <textarea class="form-control" rows="5" name="note"><?php echo $note?></textarea>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text"class="form-control" name="name" value="<?php echo $name?>"disabled>
                </div>
                <div class="form-group">
                    <label>Signed</label>
                    <input type="text"class="form-control" name="signed" value="<?php echo $signed?>"disabled>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="text"class="form-control" name="dateofsign" value="<?php echo $dateofsign?>"disabled>
                </div>

                <hr>
                <h3>Post Flight Notes</h3>
                <div class="form-group">
                    <label>Post flight notes:</label>
                    <textarea class="form-control" rows="5" name="post_notes"><?php echo $post_note?></textarea>
                </div> 

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update" name="submit">
            </div>
            
            </form>


            </div> 

        </div>
        <div class="col col-md-2">
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?> </footer>
</html>