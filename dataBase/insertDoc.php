<?php
include('conn.php');

$id = null;
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cod_cedula'].$_POST['cedula'];
$fechaNac = $_POST['fechaNac'];
$correo = $_POST['correo'];
$telefono = $_POST['cod_telefono'].$_POST['telefono'];
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

if (isset($_FILES['foto']) && $_FILES['foto'] !== '') {

    // sintaxis para obtener el archivo del formulario
    $tmp_name = $_FILES['foto']["tmp_name"];

    // obtener nombre original del archivo
    $nombreFoto = $_FILES['foto']['name'];
	
    // dar nombre y obtener solo la extension del archivo original
    $foto = $nombre.'_'.$apellido.'_'.$cedula.'_'.date('d-m-Y').'.'.pathinfo($nombreFoto, PATHINFO_EXTENSION);

    // guardar archivo en un directorio
    if ( move_uploaded_file($tmp_name, "../img/docentes/".$foto)) {
	
        //obtener ruta
       $rutafoto = "img/docentes/".$foto;
    }
    if (empty($rutafoto)) {
        $rutafoto = "img/docentes/no_foto.png";
    }

}

$sql_insert = 'INSERT INTO docentes VALUES (:id, :nombre, :apellido, :cedula, :telefono, 
                                            :correo, :fechaNac, :fechaIngre, :seccion, 
                                            :codDep, :gdoInst, :mesesServ, :clasif, 
                                            :horas, :areaForm, :matricula, :estatus, :foto )';
$ejecutar_insert = $conn->prepare($sql_insert);
$ejecutar_insert->bindParam('id', $id );
$ejecutar_insert->bindParam('nombre',$nombre );
$ejecutar_insert->bindParam('apellido',$apellido );
$ejecutar_insert->bindParam('cedula', $cedula);
$ejecutar_insert->bindParam('telefono', $telefono);
$ejecutar_insert->bindParam('correo', $correo);
$ejecutar_insert->bindParam('fechaNac', $fechaNac);
$ejecutar_insert->bindParam('fechaIngre', $fechaIngre);
$ejecutar_insert->bindParam('seccion', $seccion);
$ejecutar_insert->bindParam('codDep', $codDep);
$ejecutar_insert->bindParam('gdoInst', $gdoInst);
$ejecutar_insert->bindParam('mesesServ', $mesesServ);
$ejecutar_insert->bindParam('clasif', $clasif);
$ejecutar_insert->bindParam('horas', $horas);
$ejecutar_insert->bindParam('areaForm', $areaForm);
$ejecutar_insert->bindParam('matricula', $matricula);
$ejecutar_insert->bindParam('estatus', $status);
$ejecutar_insert->bindParam('foto', $rutafoto);
$ejecutar_insert->execute();

if ($ejecutar_insert) {
    session_start();
    $_SESSION['mensaje-registro'] = 'exito';
    header('location:../entidDoc.php');
}

?>