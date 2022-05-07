<?php
    include("./auth_session.php");
    include("../methods/mail.php");

    $input = file_get_contents('php://input'); 
    $r = json_decode($input);

    $address = $r->to;
    
    $msg = $r->msg;
    $sub = $r->sub;
    
    $res = mailTo($address,$sub,$msg);

    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed");
    }
    echo json_encode($arr);
?>