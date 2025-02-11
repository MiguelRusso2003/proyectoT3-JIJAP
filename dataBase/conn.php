<?php

    try {
        $conn = new PDO('mysql:host=localhost;dbname=prueba', 'root', '');
    } catch (PDOException $e) {
        echo " Error de Conexion a la base de datos";
    }

?>