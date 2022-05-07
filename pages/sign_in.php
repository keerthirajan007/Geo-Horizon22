<?php
    require_once('../methods/db.php');
    session_start();

    $err = '';
    $user = '';
    $pass = '';

    if (isset($_COOKIE['username'])) {
      $user = $_COOKIE['username'];
      $pass = $_COOKIE['password'];
      $res = getUsers("user_name='$user' and user_pass='$pass'");
      if(mysqli_num_rows($res) == 1){  
        echo "Successfully Logged";
        $row = mysqli_fetch_array($res);
        $_SESSION['user_name'] = $user;
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['user_id'] =   $row['user_id'];
        $_SESSION['user_mail'] = $row['user_mail'];
        $_SESSION['user_phone'] = $row['user_phone'];
      }else{
        $err= 'Incorrect Username/Password';
      }
    }else if (isset($_REQUEST['username'])) {
        $user = stripslashes($_REQUEST['username']);
        $user = mysqli_real_escape_string($con, $user);
        $pass = stripslashes($_REQUEST['password']);
        $pass = (mysqli_real_escape_string($con, $pass));
        $temp = md5($pass);
        $res = getUsers("user_name='$user' and user_pass='$temp'");
        

        if(mysqli_num_rows($res) == 1){  
            
            if(isset($_REQUEST["remember"])){
              echo "Remember";
              $hour = time() + 3600 * 24 * 30;
              setcookie('username',$user, $hour,"/");
              setcookie('password', $temp, $hour,"/");
          }
          $row = mysqli_fetch_array($res);
          $_SESSION['user_name'] = $user;
          $_SESSION['user_type'] = $row['user_type'];
          $_SESSION['user_id'] =   $row['user_id'];
          $_SESSION['user_mail'] = $row['user_mail'];
          $_SESSION['user_phone'] = $row['user_phone'];
          header("Location: ../index.php");
        }else{
          $err= 'The username or password you entered is incorrect';
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../_assets/css/adminlte.min.css">
  <style>
        body{
            background-image: url('../_assets/img/sign_in_background.jpg');
            background-size: cover;
            height: 100vh;
            padding:0;
            margin:0;
        }
    </style>
</head>

<body class="hold-transition login-page">
<div class="login-box">

<!-- /.login-logo -->
  <div class="card card-outline card-primary">
    
  <div class="card-header text-center">
      <a href="" class="h1"><b>Geo </b>Horizon'22</a>
    </div>

    <div class="card-body">
    
    <?php 
      if($err){
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$err.'</div>';
      }
    ?>

    <form action="" method="post">
        <div class="input-group mb-3">
        <input required type="text" class="form-control" placeholder="Username"
        id="username" name="username" value="<?php echo $user?>">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
        </div>
        <div class="input-group mb-3">
        <input required type="password" class="form-control" placeholder="password"
        id="password" name="password" value="<?php echo $pass?>">
          <div class="input-group-append">
                <span id="eye-open" onclick="changeType('text')" class="input-group-text">
                  <i class="fas fa-eye"></i>
                </span>
                <span hidden id="eye-closed" onclick="changeType('password')"
                class="input-group-text">
                  <i class="fas fa-eye-slash"></i>
                </span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a href="./forgot-send.php">Forgot Password</a>
      </p>
      <p class="mb-0">
        <a href="./sign_up.php" class="text-center">Don't have a account</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../_assets/js/adminlte.min.js"></script>

<script>
        var pass = document.getElementById("password");
        var eye_o = document.getElementById("eye-open");
        var eye_c = document.getElementById("eye-closed");
        var changeType = (name) => {
            if (name == "text") {
                eye_o.hidden = true;
                eye_c.hidden = false;
                pass.type = "text"
            } else {
                eye_o.hidden = false;
                eye_c.hidden = true;
                pass.type = "password"
            }
        }
</script>

</body>
</html>
