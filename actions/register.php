<?php

require_once '../vendor/autoload.php';
use Ramsey\Uuid\Uuid;

include("../actions/auth_session.php");
include("../methods/db.php");
require("../methods/mail.php");

$input = file_get_contents('php://input'); 
$r = json_decode($input);
$event_id = $r->event_id;
$user_id = $r->user_id;

$candidate = getCandidates("c.event_id = '$event_id' and c.user_id = '$user_id'");

$arr = [];

if(mysqli_num_rows($candidate) == 0){

    $id = Uuid::uuid4()->toString();
    
    $q = "INSERT INTO transactions (payment_id,user_id,event_id,paid_amt,payment_status,created,modified) VALUES ('$id','$user_id','$event_id',0,'not-paid',NOW(),NOW())";
    
    $res = mysqli_query($con,$q) or die(mysqli_error($con)); 
    
    if($res){
        $r = addCandidate($user_id,$event_id,$id,"Not Set");
// amount calculation ---------------------------------------------------------------------------
    $fee = 0;
    $hasTech = false;
    
    $list = getCandidates("a.user_id = '$user_id'");
    if($list){
        $resultSet = array();
        while ($row = mysqli_fetch_array($list, MYSQLI_ASSOC)) {
            array_push($resultSet,$row);
        }
        foreach ($resultSet as  $record) {
            if($record["event_type"] == "event-technical"){
                $hasTech = true;
            }else{
                $fee = $fee + intval($record["event_amt"]);
            }
        }
        
        if($hasTech){
            $fee = $fee + 50;  // general fees
        }
    }

// amount calculation ---------------------------------------------------------------------------
        modifyUser("events=CONCAT(events,'$event_id',', '),amt_required=$fee","user_id='$user_id'");
        
        $user = getUsers("user_id = '$user_id'"); 
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);

        $event = getEvents("e.event_id = '$event_id'"); 
        $event = mysqli_fetch_array($event, MYSQLI_ASSOC);
        
        $user_name = $user["user_name"];
        $event_name = $event["name"];
        $date_time = $event["date_time"];
        $venue = $event["venue"];
        $o_name = $event["organizer"];
        
        $content = "<p></p><p><span style=\"\&quot;font-size:\" 1rem;\"=\"\">Dear $user_name,</span></p>
        <p>You have successfully registered for \"<b>$event_name\"</b>&nbsp;in 18<sup>th</sup> edition of national-level technical symposium <b>GEO HORIZON'22</b>. The round 1 of this event/workshop will be carried out at <b>$date_time</b> in <b>$venue</b>.&nbsp;</p>
        
        <p> <span style=\"\&quot;font-size:\" 1rem;\"=\"\">For any queries, contact&nbsp; :</span>
        </p><p> </p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$o_name&nbsp;<p></p>";

        mailTo($user["user_mail"],$event["name"]." Registered successfully",$content);

        $arr = array("status"=>"success","code"=>"1");
    }else{
        $arr = array("status"=>"failed","code"=>"0");
        $arr["reason"] = mysqli_error($con);
    }
}else{
    $arr = array("status"=>"failed","code"=>"2","reason"=>"already registered");
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arr);
?>