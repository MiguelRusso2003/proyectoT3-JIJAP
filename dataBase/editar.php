<?php 
include("conn.php");

$id = $_POST['id'];
$nombre =$_POST['nombre'];
$apellido =$_POST['apellido'];
$cedula =$_POST['cedula'];

$sql = "UPDATE personas SET nombre = :nombre, apellido = :apellido, cedula = :cedula WHERE id = $id";
$editar = $conn->prepare($sql);
$editar->bindParam(':nombre', $nombre);
$editar->bindParam(':apellido', $apellido);
$editar->bindParam(':cedula', $cedula);
$editar->execute();

header('location:../index.php');

?>