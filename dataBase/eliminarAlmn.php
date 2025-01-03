<?php

 include('conn.php');

 $id = $_POST['id'];

 $sql_foto = 'SELECT (foto) FROM alumnos WHERE id ='.$id;
 $ejecutar_foto = $conn->query($sql_foto);
 $foto = $ejecutar_foto->fetch(PDO::FETCH_ASSOC);

 if ($foto['foto'] !== 'img/alumnos/no_foto.png') {
    unlink('../'.$foto['foto']);
}

 $sql = "DELETE FROM alumnos WHERE id = :id";
 $eliminar = $conn->prepare($sql);
 $eliminar -> bindParam(':id', $id, PDO::PARAM_INT);
 $eliminar -> execute();

 if ($eliminar) {
    
 session_start();
 $_SESSION['mensaje-eliminar'] = 'Alumno eliminado con éxito';
 
 header('location:../entidAlmn.php');
 }else {
    echo 'Error al Eliminar Registro' ;
 }

?>