<?php
    // include("./auth_session.php");
    include("../methods/db.php");

    // header("Content-Type: application/json;charset=utf-8");
    
    $condition = '';
    
    if(isset($_GET["condition"])) $condition = $_GET["condition"];

    $res = getEvents($condition);
    if($res){
        $resultSet = array();
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            array_push($resultSet,$row);
        }
        echo json_encode($resultSet);
    }
?>