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

    if ($clave === $usuario['pass']  && $usuario['nombre'] === null ) {
        
        session_start();
        $_SESSION['mensaje'] = $usuario['usertype'];
        $_SESSION['idUser'] = $usuario['id'];
        $_SESSION['bienvenido'] = $usuario['nombre'];
        $_SESSION['primer-ingreso'] = 'primer-ingreso';

        header('location:../admin.php');

    }elseif ($clave === $usuario['pass'] && $usuario['nombre'] !== null) {

        if ($usuario['usertype'] == 'Administrador') {
            session_start();
            $_SESSION['mensaje'] = $usuario['usertype'];
            $_SESSION['idUser'] = $usuario['id'];
            $_SESSION['bienvenido'] = $usuario['nombre'];

            header('location:../admin.php');
        }elseif ($usuario['usertype'] == 'Usuario') {
            session_start();
            $_SESSION['mensaje'] = $usuario['usertype'];
            $_SESSION['idUser'] = $usuario['id'];
            $_SESSION['bienvenido'] = $usuario['nombre'];

            header('location:../admin.php');
        }
         
    }else {
        session_start();
        $_SESSION['mensaje'] = 'Usuario o/y Clave Incorrecto(s)';
        header('location:../login.php');
    }

?>