<?php
    include("./auth_session.php");
    include("../methods/db.php");

    // header("Content-Type: application/json;charset=utf-8");
    // if($_SESSION["user_type"] != "admin"){
    //     header("Location: ./sign_out.php");
    // }

    $condition = "user_type != 'admin'";
    
    if(isset($_GET["condition"])) $condition = $condition.' and '.$_GET["condition"];

    $res = getUsers($condition);
    if($res){
        $resultSet = array();
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            array_push($resultSet,$row);
        }
        echo json_encode($resultSet);
    }
?>