<?php
include('conn.php');

$id = null;
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$fechaNac = $_POST['fechaNac'];
$lugarNac = $_POST['lugarNac'];
$seccion = $_POST['seccion'];
$sexo = $_POST['sexo'];
$entFed = $_POST['entFed'];

if (isset($_FILES['foto']) && $_FILES['foto'] !== '') {

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
    if (empty($rutafoto)) {
        $rutafoto = "img/alumnos/no_foto.png";
    }

}

$sql_insert = 'INSERT INTO alumnos VALUES (:id, :nombre, :apellido, :cedula, :lugar, 
                                            :fecha, :sexo, :entidad, :seccion, :foto )';
$ejecutar_insert = $conn->prepare($sql_insert);
$ejecutar_insert->bindParam(':id', $id );
$ejecutar_insert->bindParam(':nombre',$nombre );
$ejecutar_insert->bindParam(':apellido',$apellido );
$ejecutar_insert->bindParam(':cedula', $cedula);
$ejecutar_insert->bindParam(':lugar', $lugarNac);
$ejecutar_insert->bindParam(':fecha', $fechaNac);
$ejecutar_insert->bindParam(':sexo', $sexo);
$ejecutar_insert->bindParam(':entidad', $entFed);
$ejecutar_insert->bindParam(':seccion', $seccion);
$ejecutar_insert->bindParam(':foto', $rutafoto);
$ejecutar_insert->execute();

if ($ejecutar_insert) {
    session_start();
    $_SESSION['mensaje-registro'] = 'exito';
    header('location:../entidAlmn.php');
}

?>