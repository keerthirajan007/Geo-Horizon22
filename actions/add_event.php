<?php
    include("./auth_session.php");
    include("../methods/db.php");
    // admin only
    if($_SESSION["user_type"] != "admin"){
        header("Location: ./sign_out.php");
    }
    require_once '../vendor/autoload.php';
    use Ramsey\Uuid\Uuid;
    
    $input = file_get_contents('php://input'); 
    $r = json_decode($input);

    $name = mysqli_real_escape_string($con, stripslashes($r->name));
    $desc = mysqli_real_escape_string($con, stripslashes($r->desc));
    $type = mysqli_real_escape_string($con, stripslashes($r->type));
    $icon = mysqli_real_escape_string($con, stripslashes($r->icon));
    $datetime = mysqli_real_escape_string($con, stripslashes($r->datetime));
    $amount = mysqli_real_escape_string($con, stripslashes($r->amount));
    $venue =mysqli_real_escape_string($con, stripslashes($r->venue));
    $organizer = mysqli_real_escape_string($con, stripslashes($r->organizer));
    $short = mysqli_real_escape_string($con, stripslashes($r->short));
    $path = 'default.png';
    $imageConformation = mysqli_real_escape_string($con, stripslashes($r->image_conformation));
    
    if($imageConformation == "1"){
        $path = Uuid::uuid4()->toString();
        // .".".pathinfo($_FILES["event-image"]["name"],PATHINFO_EXTENSION)
        move_uploaded_file($_FILES["event-image"]["tmp_name"],"../uploads/events/".$path);
    }

    $res = addEvent($name,$short,$desc,$datetime,$amount,$venue,$organizer,$path,$type,$icon);

    $arr = [];

    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed");
        $arr["reason"] = mysqli_error($con);
    }
    echo json_encode($arr);
?>