<?php
include("conn.php");

$cantidad = $_POST['cant']; 
$codCat = $_POST['codCat']; 
$Inv = $_POST['inv'];
$desc = $_POST['desc'];
$precio = $_POST['precio'];
$tabla = $_POST['tabla'];
$ubicacion = $_POST['ubicacion'];

$sql = "INSERT INTO ".$tabla." VALUES (null, :cantidad, :codCat, :inv, :descripcion, :precio)";
$ejecutar = $conn -> prepare($sql);
$ejecutar -> bindParam(':cantidad', $cantidad);
$ejecutar -> bindParam(':codCat', $codCat);
$ejecutar -> bindParam(':inv', $Inv);
$ejecutar -> bindParam(':descripcion', $desc);
$ejecutar -> bindParam(':precio', $precio);
$ejecutar -> execute();

session_start();
$_SESSION['mensaje-registro'] = "registro realizado con exito";

header('location:../'.$ubicacion.'.php');

?>