<?php
require_once 'php/config.php';
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


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
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
            <h3>Flights that need reviewing.</h3>
            <?php                 
                    $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight WHERE reviewed='1'";
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
                            $url = 'adminreview.php?flight_no=' . $row['flight_no'];
                            if ($row['reviewed'] === '1') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td> <span class='label label-primary'>Flight Submitted</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '2') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td> <span class='label label-info'>Reviewed</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '3') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td> <span class='label label-success'>Completed</span></td></tr>";
                            }
                            else{
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td>" . $row['status'] . "</td></tr>";
                            }
                            
                        }
                    }
                    echo "</table>";
                    if ($result2->num_rows<1) {
                        echo "<h3>No Flights</h3>";
                    }

                    mysqli_close(); 

                ?>
        </div>
        <div class="col col-md-2">
        </div>
        <div class="col col-md-5">
            <h3>Flight Stats</h3>
            <h3><span class='label label-primary'>Flight's That need Reviewing</span></h3>
                <?php                 
                    $sqlselect = "SELECT * FROM newflight where reviewed='1';";
                    $result2 = $link->query($sqlselect);
                    $row_cnt = $result2->num_rows;
                    echo $row_cnt; 

                    mysqli_close(); 

                ?>
            <h3><span class='label label-info'>Flight's Flights Reviewed</span></h3>
                <?php                 
                        $sqlselect = "SELECT * FROM newflight where reviewed='2';";
                        $result2 = $link->query($sqlselect);
                        $row_cnt = $result2->num_rows;
                        echo $row_cnt; 

                        mysqli_close(); 

                    ?>
            <h3><span class='label label-danger'>Onsite</span></td></h3>
                <?php                 
                        $sqlselect = "SELECT * FROM newflight where reviewed='3';";
                        $result2 = $link->query($sqlselect);
                        $row_cnt = $result2->num_rows;
                        echo $row_cnt; 

                        mysqli_close(); 

                    ?>
            <h3><span class='label label-warning'>Post Flight</span></td></h3>
                <?php                 
                        $sqlselect = "SELECT * FROM newflight where reviewed='4';";
                        $result2 = $link->query($sqlselect);
                        $row_cnt = $result2->num_rows;
                        echo $row_cnt; 

                        mysqli_close(); 

                    ?>
            <h3><span class='label label-success'>Post Flight</span></td></h3>
                <?php                 
                        $sqlselect = "SELECT * FROM newflight where reviewed='5';";
                        $result2 = $link->query($sqlselect);
                        $row_cnt = $result2->num_rows;
                        echo $row_cnt; 

                        mysqli_close(); 

                    ?>
            
        </div>
    </div>
</div>
<footer><?php include 'php/footer.php'?></footer>
</html>