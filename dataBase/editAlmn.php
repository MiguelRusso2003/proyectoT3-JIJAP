<?php
include('conn.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$fechaNac = $_POST['fechaNac'];
$lugarNac = $_POST['lugarNac'];
$sexo = $_POST['sexo'];
$entFed = $_POST['entFed'];
$seccion = $_POST['seccion'];

$sql_foto = 'SELECT (foto) FROM alumnos WHERE id ='.$id;
$ejecutar_foto = $conn->query($sql_foto);
$foto = $ejecutar_foto->fetch(PDO::FETCH_ASSOC);

if ($_FILES['foto']['name'] !== '') {

    // eliminar foto de la carpeta
    if (file_exists( '../'.$foto['foto'])) {
        unlink('../'.$foto['foto']);
    }

    // sintaxis para obtener el archivo del formulario
    $tmp_name = $_FILES['foto']["tmp_name"];

    // obtener nombre original del archivo
    $nombreFoto = $_FILES['foto']['name'];
	
    // dar nombre y obtener solo la extension del archivo original
    $foto = $nombre.'_'.$apellido.'_'.$cedula.'_'.date('d-m-Y').'.'.pathinfo($nombreFoto, PATHINFO_EXTENSION);

    // guardar archivo en un directorio
    if ( move_uploaded_file($tmp_name, "../img/alumnos/".$foto)) {
	
        //obtener ruta
       $rutafoto = "img/alumnos/".$foto;
    }

}else {
    $rutafoto = $foto['foto'];
}

$sql = "UPDATE alumnos SET nombre = :nombre, apellido = :apellido, 
                           cedula = :cedula, sexo = :sexo, 
                           lugarNac = :lugarNac, fechaNac = :fechaNac, 
                           entFed = :entFed, seccion = :seccion,
                           foto = :foto WHERE id = :id";

$editar = $conn->prepare($sql);
$editar->bindParam(':id', $id );
$editar->bindParam(':nombre',$nombre );
$editar->bindParam(':apellido',$apellido );
$editar->bindParam(':cedula', $cedula);
$editar->bindParam(':sexo', $sexo);
$editar->bindParam(':lugarNac', $lugarNac);
$editar->bindParam(':fechaNac', $fechaNac);
$editar->bindParam(':entFed', $entFed);
$editar->bindParam(':seccion', $seccion);
$editar->bindParam(':foto', $rutafoto);
$editar->execute();

session_start();
$_SESSION["mensaje-editar"] = "alumno editado con éxito";

header('location:../entidAlmn.php');

if (!$editar) {
    echo 'ah Ocurrido un Error Al Editar los Datos Seleccionados del Registro';
}

?>