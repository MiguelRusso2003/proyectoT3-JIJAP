<?php

    include('conn.php');

    $usuario =$_POST['usuario'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE user = :usuario AND pass = :clave";
    $resultado = $conn->prepare($sql);
    $resultado->bindParam(':usuario', $usuario);
    $resultado->bindParam(':clave', $clave);
    $resultado->execute();

    $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

    if ($clave === $usuario['pass']) {

        if ($usuario['usertype'] == 'Administrador') {
            session_start();
            $_SESSION['mensaje'] = $usuario['nombre'] . " | Admin.";
            $_SESSION['idUser'] = $usuario['id'];
            $_SESSION['bienvenido'] = $usuario['nombre'];

            header('location:../index.php');
        }elseif ($usuario['usertype'] == 'Usuario') {
            session_start();
            $_SESSION['mensaje'] = $usuario['nombre'] . " | Usuarios";
            $_SESSION['idUser'] = $usuario['id'];
            $_SESSION['bienvenido'] = $usuario['nombre'];

            header('location:../index.php');
        }
         
    }else {
        session_start();
        $_SESSION['mensaje'] = 'Usuario o/y Clave Incorrecto(s)';
        header('location:../login.php');
    }

?>