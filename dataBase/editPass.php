<?php
include("conn.php");

$pass = $_POST["newPass"];
$confirmPass = $_POST["confirmPass"];
$id = $_POST["id"];

if ($pass == $confirmPass) {
    $sql = "UPDATE usuarios SET pass = :pass WHERE id = :id";
    $resultado = $conn -> prepare($sql);
    $resultado -> execute(['pass' => $pass, 'id' => $id]);

    session_start();

    $_SESSION["passSuccess"] = "conraseña validada";

    header("location:../login.php");
}else {
    session_start();

    $_SESSION["passError"] = "conraseña Error";

    header('Location:' . getenv('HTTP_REFERER'));
}
?>