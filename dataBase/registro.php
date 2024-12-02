<?php
    include("conn.php");

    if (isset($_POST['registrar'])) {

        $nombre =$_POST['nombre'];
        $apellido =$_POST['apellido'];
        $ced =$_POST['cedula'];
        $cod_c =$_POST['cod-c'];
        $cedula = $cod_c.$ced;

        $sql="INSERT INTO personas (nombre, apellido, cedula) VALUES (:nombre, :apellido, :cedula)";
        $registrar = $conn->prepare($sql);
        $registrar->bindParam(':nombre', $nombre);
        $registrar->bindParam(':apellido', $apellido);
        $registrar->bindParam(':cedula', $cedula);
        $registrar->execute();

        header("location:../index.php");

    }else {
        echo"No se enviaron Datos por el Formulario";
    }
    

?>