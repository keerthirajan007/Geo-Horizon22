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


    $id = mysqli_real_escape_string($con, stripslashes($r->id));
    $name = mysqli_real_escape_string($con, stripslashes($r->name));
    $type = mysqli_real_escape_string($con, stripslashes($r->type));
    $icon = mysqli_real_escape_string($con, stripslashes($r->icon));
    $desc = mysqli_real_escape_string($con, stripslashes($r->desc));
    $datetime = mysqli_real_escape_string($con, stripslashes($r->datetime));
    $amount = mysqli_real_escape_string($con, stripslashes($r->amount));
    $venue =mysqli_real_escape_string($con, stripslashes($r->venue));
    $organizer = mysqli_real_escape_string($con, stripslashes($r->organizer));
    $short = mysqli_real_escape_string($con, stripslashes($r->short));
    $path = mysqli_real_escape_string($con, stripslashes($r->path));
    $imageConformation = mysqli_real_escape_string($con, stripslashes($r->image_conformation));

    // 0 - no change / reset
    // 1 - change to new image
    // 2 - change to default
    if($imageConformation == "1"){
        if($path !== 'default.png'){
            unlink("../uploads/events/$path");
        }
        $path = Uuid::uuid4()->toString();
        move_uploaded_file($_FILES["event-image"]["tmp_name"],"../uploads/events/$path");
    }else if($imageConformation == "2"){

        if($path !== 'default.png'){
            unlink("../uploads/events/$path");
        }
        $path = 'default.png';
    }

    $res = modifyEvent("short='$short',name='$name',description='$desc',date_time='$datetime',venue='$venue',amount=$amount,organizer='$organizer',image_path='$path',icon_class='$icon',event_type='$type'","event_id='$id'");

    $arr = [];

    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed");
        $arr["reason"] = mysqli_error($con);
    }
    echo json_encode($arr);
?>