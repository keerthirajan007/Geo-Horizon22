<?php
    
    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("Location: ./pages/home.php");
    }else if($_SESSION['user_type'] == "user"){
        if(isset($_SESSION['goto_page'])){
            header("Location: ".$_SESSION['goto_page']);
        }else{
            header("Location: ./pages/user.php");
        }
    }else if($_SESSION['user_type'] == "admin"){
        header("Location: ./pages/admin.php");
    }
?>