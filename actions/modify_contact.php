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

    $id = $r->id;
    $name = $r -> name;
    $mail = $r -> email;
    $code = $r-> code;
    $phone = $r-> phone;
    $profession = $r->profession;
    $college = $r->college;
    $department = $r->department;
    $event = $r->event;
    $about = $r->about;
    $path = $r -> path;
    $imageConformation = $r->image_conformation;
    
    // 0 - no change / reset
    // 1 - change to new image
    // 2 - change to default
    if($imageConformation == "1"){
        if($path !== 'default.png'){
            unlink("../uploads/contacts/$path");
        }
        $path = Uuid::uuid4()->toString();
        move_uploaded_file($_FILES["contact-image"]["tmp_name"],"../uploads/contacts/$path");
    }else if($imageConformation == "2"){

        if($path !== 'default.png'){
            unlink("../uploads/contacts/$path");
        }
        $path = 'default.png';
    }

    $res = modifyContact("name='$name',mail='$mail',phone='$phone',profession='$profession',department='$department',college='$college',about='$about',profile_path='$path',event_id='$event'","contact_id='$id'");

    $arr = [];

    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed");
        $arr["reason"] = mysqli_error($con);
    }
    echo json_encode($arr);
?>