<?php

    include('conn.php');

    $nombre = $_POST['nombre'];
    $contacto = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $sql = 'INSERT INTO mensajes VALUES (null, :nombre, :contacto, :asunto, :mensaje, 0)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':contacto', $contacto);
    $stmt->bindParam(':asunto', $asunto);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->execute();

    if ($stmt) {

        session_start();

        $_SESSION['mensaje-enviado'] = 'correcto';

        header('location:../index.php#contacto');

    }
?>