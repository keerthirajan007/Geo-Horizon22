<?php
    require_once('../methods/db.php');
    require_once('../methods/mail.php');
    require_once '../vendor/autoload.php';
    use Ramsey\Uuid\Uuid;
    $link ="http://localhost";
    session_start();
    
    $user = $_GET['user'];
    $mail = $_GET['mail'];
    // $code = Uuid::uuid4()->toString();
    $code = random_int(100000, 999999);
    
    modifyUser("token='$code'","user_name='$user' and user_mail='$mail'");

    $content = "<p>Dear $user,</p><p>&nbsp; &nbsp; &nbsp;<b> &nbsp; A request has been received to change the password for your Geo Horizon account.</b></p><p>&nbsp; &nbsp;Here&nbsp; is your password reset code, copy the code and paste it in the <a href='$link/pages/forgot-validate.php?user=$user&amp;mail=$mail' target=\"_blank\">link</a><b><br></b></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#0000ff\"><span style=\"font-size: 18px;\">&nbsp;</span><span style=\"font-family: sans-serif; font-size: 24px;\">$code</span></font><b><br></b></p><p><b>Thank you,</b></p><p><b>SGE Admin</b><br></p>";

    mailTo($mail,"Password Reset Code",$content);
    header("Location: ./forgot-validate.php?user=$user&mail=$mail"); 
?>