<?php
// Include config file
require_once('config.php');

// Define variables and initialize with empty values
$username = $password = "";
$alertError = $alertMessage = $username_err = $password_err = $hashed_password = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);

  // Validate username and password
  if(empty($username) && empty($password)){
    $alertMessage = "Please enter username and password";
  }
  if (empty($username)){
    $alertError = "Please enter username.";
  }
  if(empty($password)){
    $alertError = "Please enter password.";
  }

  //Query
  $querySelect ="SELECT * FROM users WHERE username='$username' ";
  $queryResult = mysqli_query($link, $querySelect) or die(mysqli_error($link));

  if($queryResult){

    if(mysqli_num_rows($queryResult) > 0){
      while($row = mysqli_fetch_assoc($queryResult)){
        $username = $row['username'];
        $hash     = $row['password'];
        $usertype = $row['usertype'];
      }

      if(password_verify($password, $hash)){
        //Direct pages with different user levels
        if ($usertype == "Admin") {
          session_start();
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          $_SESSION["usertype"] = "Admin";
          header('location: index.php');
          exit;
        }
        else
        if ($usertype == "Manager") {
          session_start();
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          $_SESSION["usertype"] = "Manager";
          header('location: index.php');
          exit;

        }
        else
        if ($usertype == 'Accounting') {
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          $_SESSION["usertype"] = "Accounting";
          header('location: index.php');

        }
        else
        {
          // Display an error message
          $alertError = "Invalid username & password combination";
        }
      }// ./password validation
    }// ./num_rows
  }// ./query result

  // Close connection
  mysqli_close($link);
}// ./POST

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>VIP</b>IMS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <p class="text-danger"><?php echo $alertError ?></p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" oninput="upperCase(this)">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <div class="col-8">

            </div>
            <!-- /.col -->
          </div>
        </form>

        Powered by: <a href="http://www.unixondev.com" class="text-center">Unixon IT Creatives</a>


        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <?php include('includes/js.php'); ?>

  </body>
  </html>
