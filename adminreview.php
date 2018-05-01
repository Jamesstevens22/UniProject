<?php
require 'php/config.php'; 
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
if($username != "admin"){
    header("location:index.php");
    exit;
}

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
  $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
}
else{
  $sign = '<a href="adminhome.php"> Admin';
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
        $RPAS_All = $_POST['RPAS_All'];
        $pay_all = $_POST['pay_all'];
        $pic_all = $_POST['pic_all'];
        $pay_mas_all = $_POST['pay_mas_all'];
        $notes = $_POST['notes'];
        $signed = $_POST['signed'];
        $datesigned = $_POST['datesigned'];
        $flightnum2 = $_GET['flight_no'];
            
        $sqlinsert = "INSERT INTO reviewed(flight_no,RPAS_All,pay_all,pic_alL,pay_mas_all,notes,signed,datesigned) 
                        VALUES ('$flightnum2','$RPAS_All','$pay_all','$pic_all','$pay_mas_all','$notes','$signed','$datesigned')";
        $sqlupdate = "UPDATE newflight SET reviewed='2' WHERE flight_no='$flightnum2'";
        mysqli_query($link, $sqlinsert);
        mysqli_query($link, $sqlupdate);
        header("location: adminhome.php");
    }





mysqli_close();

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
      <li><a href="adminreport.php">Admin Report</a></li>
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
        <div class="col col-md-5">
        <h3>
            Mission Number: <?php   echo $_GET['flight_no'];?>
        </h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>RPAS Allocated and confirmation of pre-mission check:</label>
                <input type="text" class="form-control" name="RPAS_All">
            </div> 
            <div class="form-group">
                <label>Payload Allocated</label>
                <input type="text" class="form-control" name="pay_all">
            </div>   
            <div class="form-group">
                <label>Name of PIC allocated</label>
                <input type="text"class="form-control" name="pic_all">
            </div> 
            <div class="form-group">
                <label>Name of Payload master allocated</label>
                <input type="text"class="form-control" name="pay_mas_all">
            </div> 
            <div class="form-group">
                <label>Notes or endorsements by the operations manager approving the mission</label>
                <textarea class="form-control" rows="5" name="notes"></textarea>
            </div>
            <div class="form-group">
                <label>Signed: (Ops Man)</label>
                <input type="text"class="form-control" name="signed">
            </div>
            <div class="form-group">
                <label>Date:</label>
                <input type="text"class="form-control" name="datesigned">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit" name="submit">
            </div>
        </form>
        <?php
        echo $RPAS_All;
        echo $pay_all;
        echo $pic_all;
        echo $pay_mas_all;
        echo $notes;
        echo $signed;
        echo $datesigned;
        echo $flightnum2;
        ?>
        </div>
        <div class="col col-md-2">
        </div>
        <div class="col col-md-5">
        <h3>Flight Number: <?php   echo $_GET['flight_no'];?></h3>
            <h3>Status: <?php  
                            if ($reviewed === '1') {
                                echo "<span class='label label-primary'>Flight Submitted</span></td></tr>";
                            }
                            elseif ($reviewed === '2') {
                                echo "<span class='label label-info'>Reviewed</span></td></tr>";
                            }
                            elseif ($reviewed === '3') {
                                echo "<span class='label label-success'>Completed</span></td></tr>";
                            }
                        ?>
            </h3>
            <H3>
                Part A - Mission Plan
            </H3>
            <h4>
                Mission Proposers:
            </h4>
            <h5>
                <input type="text" class="form-control" name="prop" value="<?php echo $prop;?>"disabled>
            </h5>
            <h4>
                Date of Proposed Mission:
            </h4>
            <h5>
                <input type="text" class="form-control" name="date_of_mission" value="<?php echo $date_of_mission;?>"disabled>
            </h5>
            <h4>
                Location of Mission:
            </h4>
            <h5>
                <input type="text" class="form-control" name="loc_of_mis" value="<?php echo $loc_of_mis?>"disabled>
            </h5>
            <h4>
                Principal technical aims of the mission:
            </h4>
            <h5>
                <textarea class="form-control" rows="5" name="tech_aims"disabled><?php echo $tech_aims; ?></textarea>
            </h5>
            <h4>
                Provide Detailed description of the mission, including estimated flight durations:
            </h4>
            <h5>
                <textarea class="form-control" rows="7" name="des_of_mis"disabled><?php echo $des_of_mis?></textarea>
            </h5>
            <h4>
                Describe the Payload Requirements:
            </h4>
            <h5>
                <textarea class="form-control" rows="3" name="des_of_pay"disabled><?php echo $des_of_pay?></textarea>
            </h5>
            <h4>
                Describe the Data processing plan:
            </h4>
            <h5>
                <textarea class="form-control" rows="3" name="des_of_pro"disabled><?php echo $des_of_pro?></textarea>
            </h5>
            <h4>
                Number of Observers:
            </h4>
            <h5>
                <input type="text" class="form-control" name="num_of_ob" value="<?php echo $num_of_ob?>"disabled>
            </h5>
            <h4>
                Is a payload master required?:
            </h4>
            <h5>
                <input type="text" class="form-control" name="pay_req" value="<?php echo $pay_req?>"disabled>
            </h5>
            <h4>
                RPAS Required: 
            </h4>
            <h5>
                <input type="text" class="form-control" name="rpas_req" value="<?php echo $rpas_req?>"disabled>
            </h5>
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?></footer>
</html>