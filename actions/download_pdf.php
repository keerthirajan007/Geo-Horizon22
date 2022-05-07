<?php
    include("./auth_session.php");
    include("../methods/pdf.php");

    receipt($_GET["payment_id"]);

    exit();
?>
