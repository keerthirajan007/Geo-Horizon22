<?php
    include("./auth_session.php");
    include("../methods/db.php");
    
    if($_SESSION["user_type"] != "admin"){
        header("Location: ./sign_out.php");
    }
    
    $input = file_get_contents('php://input'); 
    $r = json_decode($input); 
    
    $id = $r->user_id;
    $status = mysqli_real_escape_string($con, stripslashes($r->status));
    $amt_paid = mysqli_real_escape_string($con, stripslashes($r->amt_paid));
    $needMail = mysqli_real_escape_string($con, stripslashes($r->needMail));
    
    $res = modifyUser("status='$status',amt_paid = $amt_paid","user_id='$id'");
    $arr = [];
    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed","reason"=> $res);
    }
    echo json_encode($arr);
    
    if($needMail == true){
        include("../methods/db.php");
        
        $user = getUsers("user_id = '$user_id'"); 
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        
        $user_name = $user["user_name"];
        $user_id = $event["name"];
        $user_mail = $event["date_time"];
        $user_phone = $event["venue"];
       
        $content = "";
        mailTo("","Payment Status Updated - $user_name",$content);
    }
?>