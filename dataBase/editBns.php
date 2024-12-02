<?php 
include("conn.php");

$id = $_POST['id'];
$cantidad =$_POST['cantidad'];
$codCat =$_POST['codCat'];
$n_Inv =$_POST['inv'];
$descripcion = $_POST["desc"];
$precioUni = $_POST["precio"];
$tabla = $_POST["tipoBn"];
$ubicacion = $_POST["ubicacion"];

$sql = "UPDATE ".$tabla." SET cantidad = :cantidad, codCat = :codCat, n_Inv = :inv, descripcion = :desc, precioUni = :precio WHERE id = :id";
$editar = $conn->prepare($sql);
$editar->bindParam(':cantidad', $cantidad);
$editar->bindParam(':codCat', $codCat);
$editar->bindParam(':inv', $n_Inv);
$editar->bindParam(':desc', $descripcion);
$editar->bindParam(':precio', $precioUni);
$editar->bindParam(':id', $id);
$editar->execute();

session_start();
$_SESSION["mensaje-editar"] = "Alumno editado con éxito";

header('location:../'.$ubicacion.'.php');

if (!$editar) {
    echo 'ah Ocurrido un Error Al Editar los Datos Seleccionados del Registro';
}

?>