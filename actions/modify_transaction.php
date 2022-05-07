<?php
    include("./auth_session.php");
    include("../methods/db.php");

    if($_SESSION["user_type"] != "admin"){
        header("Location: ./sign_out.php");
    }
    $input = file_get_contents('php://input'); 
    $r = json_decode($input); 

    $id = $r->payment_id;
    $status = $r->payment_status;
    $paid_amt = $r->paid_amt;
    $needMail = $r->needMail;

    $res = modifyTransaction("payment_status='$status',paid_amt='$paid_amt'","payment_id='$id'");
    $arr = [];
    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed","reason"=> mysqli_error($con));
    }
    echo json_encode($arr);
?>