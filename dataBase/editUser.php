<?php
        include("conn.php");

        if (isset($_POST["id"])) {
            
            $id = $_POST["id"];
            $userName = $_POST["userName"];
            $pass = $_POST["pass"];
            $name = $_POST["name"];
            $lastName = $_POST["lastName"];
            $pregunta1 = $_POST["pregunta1"];
            $respuesta1 = $_POST["respuesta1"];
            $pregunta2 = $_POST["pregunta2"];
            $respuest2 = $_POST["respuesta2"];
        }
?>