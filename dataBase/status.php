<?php
include('conn.php');
$id = $_POST['id'];
$sql = 'UPDATE mensajes SET '.'status ='.'1 WHERE id ='.$id;
$stmt = $conn->query($sql);

if ($stmt) {
    session_start();
    $_SESSION['status'] = 'status';
    header('location:../mensajes.php');
}
?>