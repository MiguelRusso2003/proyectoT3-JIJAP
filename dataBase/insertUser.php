<?php
include('conn.php');

$userName = $_POST['nombre'];
$pass = $_POST['pass1'];
$pass2 = $_POST['pass2'];

$sql = 'SELECT * FROM usuarios WHERE user = :user';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user', $userName);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {

    session_start();
    $_SESSION['mensaje-usuario-exist'] = 'exito';
    header('location:../datosCuenta.php');

}elseif($pass !== $pass2){

    session_start();
    $_SESSION['mensaje-clave-mal'] = 'exito';
    header('location:../datosCuenta.php');

}else{
    
    $usertype = 'Usuario';

    $sql_insert = 'INSERT INTO usuarios VALUES (null, :user, :pass, :usertype, null, null, null, null, null, null, null )';

    $ejecutar_insert = $conn->prepare($sql_insert);
    $ejecutar_insert->bindParam(':user', $userName );
    $ejecutar_insert->bindParam(':pass', $pass);
    $ejecutar_insert->bindParam(':usertype', $usertype);
    $ejecutar_insert->execute();

    if ($ejecutar_insert) {
        session_start();
        $_SESSION['mensaje-registro'] = 'exito';
        header('location:../datosCuenta.php');
    }
}



?>