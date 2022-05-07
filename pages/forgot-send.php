<?php
    require_once('../methods/db.php');
    session_start();

    $err = '';
    $mail = '';

    if (isset($_REQUEST['email'])) {
        $mail = stripslashes($_REQUEST['email']);
        $mail = mysqli_real_escape_string($con, $mail);
        $res = getUsers("user_mail='$mail'");
        if(mysqli_num_rows($res) == 1){
          $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
          $user = $row["user_name"];
          header("Location: ./forgot-set-code.php?user=$user&mail=$mail");
        }else{
          $err= 'The account does not exists';
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

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
            <input required type="email" class="form-control" placeholder="mail id linked with account"
            id="email" name="email" value="<?php echo $mail?>">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Send Code</button>
        </div>
      </form>
      <p class="mb-1">
        <a href="./sign_in.php">Sign In</a>
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

</body>
</html>

