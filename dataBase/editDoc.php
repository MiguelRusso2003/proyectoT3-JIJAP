<?php
include('conn.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$fechaNac = $_POST['fechaNac'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$fechaIngre = $_POST['fechaIngre'];
$codDep = $_POST['codDep'];
$gdoInst = $_POST['gdoInst'];
$seccion = $_POST['seccion'];
$clasif = $_POST['clasif'];
$mesesServ = $_POST['mesesServ'];
$horas = $_POST['horas'];
$areaForm = $_POST['areaForm'];
$matricula = $_POST['matricula'];
$status = $_POST['status'];

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

$sql = "UPDATE docentes SET nombre = :nombre, apellido = :apellido, cedula = :cedula, telefono = :telefono, 
                                            correo = :correo, fechaNac = :fechaNac, fechaIngre = :fechaIngre, seccion = :seccion, 
                                            codDep = :codDep, gdoInst = :gdoInst, mesesServ = :mesesServ, clasif = :clasif, 
                                            horas = :horas, areaForm = :areaForm, matricula = :matricula, ".'status'." = :estatus  WHERE id = :id";
$editar = $conn->prepare($sql);
$editar->bindParam('id', $id );
$editar->bindParam('nombre',$nombre );
$editar->bindParam('apellido',$apellido );
$editar->bindParam('cedula', $cedula);
$editar->bindParam('telefono', $telefono);
$editar->bindParam('correo', $correo);
$editar->bindParam('fechaNac', $fechaNac);
$editar->bindParam('fechaIngre', $fechaIngre);
$editar->bindParam('seccion', $seccion);
$editar->bindParam('codDep', $codDep);
$editar->bindParam('gdoInst', $gdoInst);
$editar->bindParam('mesesServ', $mesesServ);
$editar->bindParam('clasif', $clasif);
$editar->bindParam('horas', $horas);
$editar->bindParam('areaForm', $areaForm);
$editar->bindParam('matricula', $matricula);
$editar->bindParam('estatus', $status);
$editar->execute();

session_start();
$_SESSION["mensaje-editar"] = "docente editado con éxito";

header('location:../entidDoc.php');

if (!$editar) {
    echo 'ah Ocurrido un Error Al Editar los Datos Seleccionados del Registro';
}

?>