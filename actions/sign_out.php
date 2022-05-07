<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        setcookie('username',"", time() - 4000, "/");
        setcookie('password',"", time() - 4000, "/");
        header("Location: ../pages/sign_in.php");
    }
?>