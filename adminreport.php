<?php
require_once 'php/config.php';
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
  $sign = '<a href="adminhome.php"> Profile';
  $logged = '<a href="logout.php"> Logout';
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Report</title>
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
      <li class="active"><a href="adminreport.php">Admin Report</a></li>
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
            <h3>All Flights</h3>
            <h4>Search through all the flights below  </h4>
            <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <h3>All Flights</h3>
                <?php 
                    $idselect = "SELECT id from users where username='$sesid'";
                    
                    $idresult = mysqli_query($link,$idselect);
                    $result = mysqli_fetch_array($idresult);
                    $id = $result['id'];
                
                    $sqlselect = "SELECT flight_no,id,reviewed,created_at FROM newflight";
                    
                    $result2 = $link->query($sqlselect);

                    echo "<table class='table'>"; 
                    if ($result2->num_rows > 0) {
                        echo "<thead>
                        <tr>
                          <th scope='col'>Flight Number</th>
                          <th scope='col'>Created at</th>
                          <th scope='col'>Status</th>
                        </tr>
                      </thead>
                      <tbody id='myTable'>";
                        while ($row = $result2->fetch_assoc()) {
                            $url = 'adminflight.php?flight_no=' . $row['flight_no'];
                            if ($row['reviewed'] === '1') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-primary'>Flight Submitted</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '2') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-info'>Reviewed</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '3') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-danger'>Onsite</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '4') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-warning'>Post Flight</span></td></tr>";
                            }
                            elseif ($row['reviewed'] === '5') {
                                echo "<tr><td><a href='$url'>" . $row['flight_no'] . "</a></td><td>" . $row['created_at'] . "</td><td> <span class='label label-success'>Completed</span></td></tr>";
                            }
                            else{
                                echo "<tr><td>" . $row['flight_no'] . "</td><td>" . $row['created_at'] . "</td><td>" . $row['status'] . "</td></tr>";
                            }
                            
                        }
                    }
                    echo "</tbody>
                    </table>";
                    if ($result2->num_rows<1) {
                        echo "<h3>No Flights</h3>";
                    }

                    mysqli_close(); 

                ?>

        </div>
        <div class="col col-md-2">
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<footer><?php include 'php/footer.php'?> </footer>
</html>