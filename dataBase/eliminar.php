<?php

 include('conn.php');

 $id = $_POST['id'];
 $tabla = $_POST["tabla"];
 $ubicacion = $_POST["ubicacion"];

 $sql = "DELETE FROM ".$tabla." WHERE id = :id";
 $eliminar = $conn->prepare($sql);
 $eliminar -> bindParam(':id', $id, PDO::PARAM_INT);
 $eliminar -> execute();

 if ($eliminar) {
 session_start();
 $_SESSION['mensaje-eliminar'] = 'Alumno eliminado con éxito';
 
 header('location:../'.$ubicacion.'');
 }else {
    echo 'Error al Eliminar Registro' ;
 }

?>