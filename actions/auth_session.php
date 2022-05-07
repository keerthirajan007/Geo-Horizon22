<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("Location: ../pages/sign_in.php");
        exit();
    }
?>