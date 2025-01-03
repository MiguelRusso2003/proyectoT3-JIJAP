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

// if (isset($_FILES['foto']) && $_FILES['foto'] !== '') {

//     // sintaxis para obtener el archivo del formulario
//     $tmp_name = $_FILES['foto']["tmp_name"];

//     // obtener nombre original del archivo
//     $nombreFoto = $_FILES['foto']['name'];
	
//     // dar nombre y obtener solo la extension del archivo original
//     $foto = $nombre.'_'.$apellido.'_'.$cedula.'_'.date('d-m-Y').'.'.pathinfo($nombreFoto, PATHINFO_EXTENSION);

//     // guardar archivo en un directorio
//     if ( move_uploaded_file($tmp_name, "../img/docentes/".$foto)) {
	
//         //obtener ruta
//        $rutafoto = "img/docentes/".$foto;
//     }
//     if (empty($rutafoto)) {
//         $rutafoto = "img/docentes/no_foto.png";
//     }

// }

$sql = "UPDATE alumnos SET nombre = :nombre, apellido = :apellido, cedula = :cedula, sexo = :sexo, 
                            lugarNac = :lugarNac, fechaNac = :fechaNac, entFed = :entFed, seccion = :seccion WHERE id = :id";

$editar = $conn->prepare($sql);
$editar->bindParam('id', $id );
$editar->bindParam('nombre',$nombre );
$editar->bindParam('apellido',$apellido );
$editar->bindParam('cedula', $cedula);
$editar->bindParam('sexo', $sexo);
$editar->bindParam('lugarNac', $lugarNac);
$editar->bindParam('fechaNac', $fechaNac);
$editar->bindParam('entFed', $entFed);
$editar->bindParam('seccion', $seccion);
$editar->execute();

session_start();
$_SESSION["mensaje-editar"] = "alumno editado con éxito";

header('location:../entidAlmn.php');

if (!$editar) {
    echo 'ah Ocurrido un Error Al Editar los Datos Seleccionados del Registro';
}

?>