<?php
    include("conn.php");

    $sql = 'SELECT * FROM usuarios WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $pgt1 = $_POST["pgt1"];
        $resp1 = $_POST["resp1"];
        $pgt2 = $_POST["pgt2"];
        $resp2 = $_POST["resp2"];

        $sqlEdit = 'UPDATE usuarios SET nombre = :nombre, apellido = :apellido, correo = :correo, 
                                        pregunta1 = :pgt1, pregunta2 = :pgt2,
                                        resp1 = :resp1, resp2 = :resp2 WHERE id = :id ';
        $stmtEdit = $conn->prepare($sqlEdit);
        $stmtEdit->bindParam(':nombre', $nombre);
        $stmtEdit->bindParam(':apellido', $apellido);
        $stmtEdit->bindParam(':correo', $correo);
        $stmtEdit->bindParam(':pgt1', $pgt1);
        $stmtEdit->bindParam(':pgt2', $pgt2);
        $stmtEdit->bindParam(':resp1', $resp1);
        $stmtEdit->bindParam('resp2', $resp2);
        $stmtEdit->bindParam(':id', $id);
        $stmtEdit->execute();

        if ($stmtEdit) {
            session_start();
            $_SESSION['usuario-registrado-firs'] = 'exito';
            unset($_SESSION['primer-ingreso']);
            header('location:../admin.php');
        }else{
            echo 'Error al editar los datos';
        }
    }
?>