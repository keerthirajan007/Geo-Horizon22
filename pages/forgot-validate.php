<?php
    require_once('../methods/db.php');
    session_start();

    $code = '';
    $user = $_GET['user'];
    $mail = $_GET['mail'];
    $err = '';

    if (isset($_REQUEST['code'])) {
        $code = stripslashes($_REQUEST['code']);
        $code = mysqli_real_escape_string($con, $code);
        $res = getUsers("user_name='$user' and user_mail='$mail' and token='$code'");
        if(mysqli_num_rows($res) == 1){
?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
      </head>
      <body>
        <form id="temp-form" action="./forgot-reset-pass.php" method="post">
          <input type="text" id="user" name="user"  value="<?php echo $user?>" hidden>
          <input type="text" id="mail" name="mail"  value="<?php echo $mail?>" hidden>
          <input type="text" id="code" name="code"  value="<?php echo $code?>" hidden>
        </form>
        <script>
          document.getElementById("temp-form").submit();
        </script>
      </body>
      </html>
<?php
        }else{
          $err = "Incorrect code";
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Validate Code</title>

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
            <input required type="text" class="form-control" placeholder="Enter/Paste the code"
            id="code" name="code" value="<?php echo $code?>">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-code"></i></span>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Validate</button>
        </div>
        <br>
        <div class="row">
            <a href="<?php echo "./forgot-set-code.php?user=$user&mail=$mail"?>" type="button" class="btn btn-primary btn-block">Resend Code</a>
        </div>
      </form>
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
