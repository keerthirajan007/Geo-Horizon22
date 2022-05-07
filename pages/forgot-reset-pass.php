<?php
    require_once('../methods/db.php');
    $user = $_REQUEST["user"];
    $mail = $_REQUEST["mail"];
    $code = $_REQUEST["code"];
    $pass = '';
    $err = "";
    if(isset($_REQUEST['password'])){
        $pass = stripslashes($_REQUEST['password']);
        $pass = mysqli_real_escape_string($con, $pass);
        $res = getUsers("user_name='$user' and user_mail='$mail' and token='$code'");
        if(mysqli_num_rows($res) == 1){
            modifyUser("user_pass='".md5($pass)."',token=''","user_name='$user' and user_mail='$mail' and token='$code'");
            header("Location: ./sign_in.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>

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

<body class="hold-transition register-page">
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
          
        <input readonly type="text" id="user" name="user" id="" value="<?php echo $user?>" hidden>
        <input readonly type="text" id="mail" name="mail" id="" value="<?php echo $mail?>" hidden>
        <input readonly type="text" id="code" name="code"  value="<?php echo $code?>" hidden>

          <div class="input-group mb-3">
            <input oninput="checkPass()" required type="password" class="form-control" placeholder="New password"
            id="password" name="password" value="<?php echo $pass?>">
            <div class="input-group-append">
                    <span id="eye-open" onclick="changeType('text')" class="input-group-text">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                    <span hidden id="eye-closed" onclick="changeType('password')"
                        class="input-group-text">
                        <i class="fas fa-eye"></i>
                    </span>
            </div>
        </div>
        <div class="input-group mb-3">
            <input oninput="checkPass()" required type="password" class="form-control" placeholder="Enter Password Again" id="re-password" name="re-password">
        </div>
        <div class="row">
                <button disabled id="submit-button" type="submit" class="btn btn-primary btn-block">Reset</button>
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

<script>
        var pass = document.getElementById("password");
        var eye_o = document.getElementById("eye-open");
        var eye_c = document.getElementById("eye-closed");
        var submit = document.getElementById("submit-button");
        var re_pass = document.getElementById("re-password");
        var err = document.getElementById("error-msg");
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

        var checkPass = () => {
            if (pass.value !== re_pass.value) {
                submit.disabled = true;
                re_pass.className = "form-control is-invalid";
            } else {
                submit.disabled = false;
                re_pass.className = "form-control is-valid";
            }
        }
</script>

</body>
</html>
