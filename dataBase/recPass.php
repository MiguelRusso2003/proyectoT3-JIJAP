<?php

include("conn.php");

$resp1 = $_POST["resp1"];
$resp2 = $_POST["resp2"];
$usuario = $_POST["usuario"];

$sql = "SELECT * FROM usuarios WHERE user = :usuario";

$declaracion = $conn -> prepare($sql);
$declaracion -> bindParam(":usuario", $usuario);
$declaracion -> execute();

$user = $declaracion -> fetch(PDO::FETCH_ASSOC);
if ($user['resp1'] == $resp1 && $user['resp2'] == $resp2) {
    
    session_start();
    $_SESSION["correcto"] = "Verificado Correctamente";
    $_SESSION["usuario"] = $usuario;

    header("location:../cambClave.php");
}else {
    session_start();
    $_SESSION["error"] = "Verificado Correctamente";

    header("location:../recuPass.php");
}




?>