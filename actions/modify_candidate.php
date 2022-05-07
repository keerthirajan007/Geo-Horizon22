<?php
    include("./auth_session.php");
    include("../methods/db.php");
    include("../methods/mail.php");
    
    $link = "http://www.sge.com";

    if($_SESSION["user_type"] != "admin"){
        header("Location: ./sign_out.php");
    }
    $input = file_get_contents('php://input'); 
    $r = json_decode($input); 

    $id = mysqli_real_escape_string($con, stripslashes($r->reg_id));
    $status = mysqli_real_escape_string($con, stripslashes($r->status));
    $remark = mysqli_real_escape_string($con, stripslashes($r->remark));
    $needMail = mysqli_real_escape_string($con, stripslashes($r->needMail));

    $res = modifyCandidate("status='$status',remark='$remark'","reg_id='$id'");
    $arr = [];
    if($res){
        
        if($needMail == "true"){
        
            $event = getCandidates("c.reg_id = '$id' "); 
            $event = mysqli_fetch_array($event, MYSQLI_ASSOC);
            
            $user_name = $event["user_name"];
            $event_name = $event["name"];
            $o_name = $event["organizer"];
            
            $content = "<p></p><p><span style=\"\&quot;\&quot;font-size:\&quot;\" 1rem;\"=\"\&quot;\&quot;\">Dear $user_name,</span></p><p>&nbsp; &nbsp; Your registered event($event_name) results changed by SGE team. Check the <a href='$link' target=\"_blank\">website</a> for more details.</p><p> <span style=\"\&quot;\&quot;font-size:\&quot;\" 1rem;\"=\"\&quot;\&quot;\">&nbsp;For any queries, contact&nbsp; :</span></p><p> </p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$o_name&nbsp;<p></p>";

            mailTo($event["user_mail"],$event["name"]." status updated",$content);
        
        }

        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed","reason"=> $res);
    }

    echo json_encode($arr);
?>