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


    $name = $r -> name;
    $mail = $r -> email;
    $code = $r-> code;
    $phone = $r-> phone;
    $profession = $r->profession;
    $college = $r->college;
    $department = $r->department;
    $event = $r->event;
    $about = $r->about;
    $path = 'default.png';
    $imageConformation = $r->image_conformation;
    
    if($imageConformation == "1"){
        $path = Uuid::uuid4()->toString();
        // .".".pathinfo($_FILES["contact-image"]["name"],PATHINFO_EXTENSION)
        move_uploaded_file($_FILES["contact-image"]["tmp_name"],"../uploads/contacts/".$path);
    }

    $res = addContact($name,$mail,"+".$code." ".$phone,$profession,$department,$college,$about,$path,$event);

    $arr = [];

    if($res){
        $arr = array("status"=>"success");
    }else{
        $arr = array("status"=>"failed");
        $arr["reason"] = mysqli_error($con);
    }
    echo json_encode($arr);
?>