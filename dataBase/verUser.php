<?php
 session_start();

 $_SESSION["incorrecto"] = "incorrecto";

 header("location:../recuPass.php");
?>