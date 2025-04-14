<?php
    include("dataBase/conn.php");
    
    session_start();

    $mensaje="";
    $mensajeEliminar="";
    $mensajeEdit="";
    $mensajeRegistro="";
    $idEdit ="";
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION['mensaje-eliminar'])) {
        $mensajeEliminar = "verdadero";
        unset($_SESSION['mensaje-eliminar']);
    }

    if (isset($_SESSION["mensaje-editar"])) {
        $mensajeEdit = "verdadero";
        unset($_SESSION['mensaje-editar']);
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }

    if (isset($_SESSION['mensaje-registro'])) {
        $mensajeRegistro = "verdadero";
        unset($_SESSION['mensaje-registro']);
    }

    $sql = "SELECT * FROM mensajes";
    $resultado = $conn -> query($sql);

    $sql2 = 'SELECT * FROM mensajes WHERE '.'status = 0';
    $resultado2 = $conn -> query($sql2);

    $pagAct = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
</head>
<body class="bg-dark">
    <?php include("menuDes.html"); ?>

    <br><br><br>

    <div id="body" class="rounded margin-left-width" style="background-image:url(img/bg-mensajes.png); background-size:cover;background-attachment: fixed; ">

        <div class="container-fluid bg-white-trans rounded">
            <div class="container">
                
                <br>

                <div class="d-md-flex text-center justify-content-between align-items-center">
                    <div class="d-md-flex d-block">
                        <img src="icons\atencion_client.svg" style="width: 70px;"><hr class="d-md-none w-25 mx-auto border-primary border"><div class="vr mx-3 d-md-block d-none border-primary"></div>
                        <h1 class="display-5">Mensajes </h1>
                    </div>
                    <div class="alert alert-info mt-3 mt-md-0" role="alert">
                        <?= $resultado2->rowCount(); ?> Mensajes sin abrir
                    </div>
                </div>
                
                <hr>
                
                <!-- Tabla DataTable -->
                <div class="table-responsive-md">
                    <table id="myTable" class="display compact" style="width:90%">
                        
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Medio de Contacto</th>
                                <th class="text-start">Asunto</th>
                                <th class="text-start">Status</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php foreach ($resultado as $key) {?>
                            
                            <tr>
                                <td> <?php echo $key['nombre']; ?> </td>
                                <td class="text-start"> <?php echo $key['contacto']; ?> </td>
                                <td> <?php echo $key['asunto']; ?> </td>
                                <td class="text-start"><img src="icons/<?= $key['status'] === 0 ? 'mensaje.svg' : 'mensaje_abierto.svg' ?>" style="width: 30px; height: 30px;" class="<?= $key['status'] === 0 ? 'shadow-mens' : 'shadow-mens-open' ?>"> <?= $key['status'] === 0 ? ' Sin Leer' : ' Leído' ?></td>
                                <td style="background: none" class="d-flex">
                                    <div class="ms-1 me-1">
                                        <form action="dataBase/eliminar.php" method="post" id="formDataDelete<?php echo $key['id'];?>">
                                            <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                            <input type="hidden" name="ubicacion" value="mensajes.php">
                                            <input type="hidden" name="tabla" value="mensajes">
                                            <button onclick="alertDelete('<?php echo $key['nombre']; ?>', '<?php echo $key['id']; ?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar" class="btn shadow btn-outline-primary border-3">
                                                <img src="icons/delete.svg" style="width: 20px; height: 20px;">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="ms-1 me-1">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                            <button onclick="modalVer('<?php echo $key['id'];?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Abrir Mensaje" class="btn shadow btn-outline-primary border-3">
                                                <img src="icons/lupa.svg" style="width: 20px; height: 20px;">
                                            </button>
                                        </form>
                                    </div>
                                </td> 
                            </tr>

                            <!-- Modal Ver -->
                            <div class="modal fade" id="modalVer<?php echo $key['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fw-light fs-5" id="exampleModalLabel">De: <?= ' '.$key['nombre'] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="d-flex">
                                                    <h4 class="fw-bolt">Asunto: </h4><h4 class="fw-light"><?= ' '.$key['asunto'] ?></h4>
                                                </div>
                                                <h4 class="fw-bolt">Mensaje: </h4><h4 class="fw-light"><?= $key['mensaje'] ?></h4>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn border-2 btn-outline-primary" data-bs-dismiss="modal">OK</button>
                                                
                                                <?php if($key['status'] === 0) : ?>
                                                    
                                                    <form action="dataBase/status.php" method="post">
                                                        <input type="hidden" name="id" value="<?=$key['id']?>">
                                                        <button type="submit" class="btn border-2 btn-outline-success" data-bs-dismiss="modal">Marcar como leído</button>
                                                    </form>

                                                <?php endif; ?>                                     
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

                <br>
                
            </div>
        </div>
    </div>
    
    <div id="body1" class="shadow margin-left-width"></div>
    <div id="body2" class="shadow margin-left-width"></div>

    <?php include("footer.html"); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable();
    </script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>

    <!-- Tooltips -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <!-- Modal Ver -->
     <script>
        function modalVer(idModal) {
            $('#modalVer'+idModal).modal('show');
        }
     </script>

    <!-- Mensajes Presentes -->

    <!-- mensaje registro eliminado -->
    <?php
        if (!empty($mensajeEliminar)) :
            echo '
                <script>
                    window.onload = function mensaje(){
                                        swal.fire({
                                                title: "Registro Eliminado",
                                                icon: "success",
                                                showConfirmButton: false,
                                                timer: 1300
                                            });
                                    };
                    ;
                </script>
            '; 
        endif; 
    ?>
</body>
</html>