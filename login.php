<?php
// Include config file
require_once 'php/config.php';
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  $logged = '<a href="login.php"><span class="glyphicon glyphicon-user"></span> Login';
  $sign = '<a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up';
}
else{
  $sign = '<a href="profile.php"> Profile';
  $logged = '<a href="logout.php"> Logout';
}
$username = $password = "";
$username_err = $password_err = "";
 
// When the user clicks login
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // See if the username box is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // See if the password box is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: profile.php");
                        } else{
                            // Password Error
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Username error
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

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
            <div class="col-6 col-md-4">
            </div>
            <div class="col-6 col-md-4">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>
            <div class="col-6 col-md-4">
            </div>
        </div>
    </div>
<footer><?php include 'php/footer.php'?></footer>
</body>
</html>
