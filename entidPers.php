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

    if (isset($_SESSION['mensaje-registro'])) {
        $mensajeRegistro = "verdadero";
        unset($_SESSION['mensaje-registro']);
    }

    if (isset($_POST['editar'])) {
        $idEdit = $_POST["id"];

        $sqlEdit = "SELECT * FROM bienesMbls WHERE id = :id";
        $ejecutarSql = $conn -> prepare($sqlEdit);
        $ejecutarSql -> bindParam(':id', $idEdit);
        $ejecutarSql -> execute();

        $datosEdit = $ejecutarSql -> fetch(PDO::FETCH_ASSOC); 
    }

    $sql = "SELECT * FROM bienesMbls";
    $resultado = $conn -> query($sql);

    $tabla = 'bienesMbls';

    $pagAct = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
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

    <div id="body" class="rounded margin-left" style="background-image:url(img/bg-personal.jpg); background-size:cover; background-attachment: fixed;">

        <div class="container-fluid bg-white-trans rounded">
            <div class="container">
                
                <br>

                <div class="d-flex justify-content-between align-items-center px-3">
                    <h1 class="display-4"><img src="icons/personal.svg"  style="width: 70px; height:70px"> | Personal</h1>
                    <form action="formBnMu.php" method="post">
                        <button type="button" class="btn btn-outline-success border-3" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Nuevo Registro</button>
                    </form>
                </div>
                
                <hr>
                
                <!-- Tabla DataTable -->
                <table id="myTable" class="display compact" style="width:80%">
                    
                    <thead>
                        <tr>
                            <th class="text-start">Cod. Catálogo</th>
                            <th class="text-start">N° Inventario del Bien</th>
                            <th class="text-start">Descripción</th>
                            <th class="text-start">Cantidad</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        <?php foreach ($resultado as $key) {?>
                        
                        <tr>
                            <td> <?php echo $key['codCat']; ?> </td>
                            <td class="text-start"> <?php echo $key['n_Inv']; ?> </td>
                            <td> <?php echo $key['descripcion']; ?> </td>
                            <td class="text-center"> <?php echo $key['cantidad']; ?> </td>
                            <td style="background: none" class="d-flex">
                                <div class="ms-1 me-1">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                        <button name="editar" type="submit" class="btn shadow btn-outline-primary border-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar">
                                            <img src="icons/editar.svg" style="width: 20px; height: 20px;">  
                                        </button>
                                    </form>
                                </div>
                                <div class="ms-1 me-1">
                                    <form action="dataBase/eliminar.php" method="post" id="formDataDelete<?php echo $key['id'];?>">
                                        <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                        <input type="hidden" name="tabla" value="<?php echo $tabla ?>">
                                        <input type="hidden" name="ubicacion" value="bnsMbls.php">
                                        <button onclick="alertDelete('<?php echo $key['descripcion']; ?>', '<?php echo $key['id']; ?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar" class="btn shadow btn-outline-primary border-3">
                                            <img src="icons/delete.svg" style="width: 20px; height: 20px;">
                                        </button>
                                    </form>
                                </div>
                                <div class="ms-1 me-1">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                        <button onclick="modalVer('<?php echo $key['id'];?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver Precio" class="btn shadow btn-outline-primary border-3">
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Descripcion - Precio</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="mb-3">
                                                <label class="text-black fs-5">Descripcion:</label>
                                                <input type="text" class=" text-center border border-secondary border-2 form-control form-control-lg" value="<?php echo $key['descripcion']; ?>" required disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-black fs-5">Precio Unitario:</label>
                                                <input type="text" class="text-success text-center border border-secondary border-2 form-control form-control-lg" value="$<?php echo $key['precioUni']; ?>" required disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-black fs-5">Precio Total por Cantidad (<?php echo $key['cantidad']; ?>):</label>
                                                <input type="text" class="text-success text-center border border-secondary border-2 form-control form-control-lg" value="$<?php $precioTotal = $key['precioUni'] * $key['cantidad']; echo $precioTotal; ?>" required disabled readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn border-2 btn-outline-primary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                    </tbody>
                </table>

                <!-- Modal Editar -->
                <?php if (!empty($idEdit)) : ?>
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR BIEN MUEBLE</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="dataBase/editBns.php">
                                        <div class="form-floating mb-4">
                                            <input value="<?php echo $datosEdit["cantidad"] ; ?>" type="number" name="cantidad" id="floatingInput" class="border border-primary border-3 form-control form-control-lg" placeholder="cantidad" required>
                                            <label class="text-secondary" for="floatingInput">Cantidad</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input value="<?php echo $datosEdit["codCat"] ; ?>" type="text" name="codCat" id="floatingInput" class="border border-primary border-3 form-control form-control-lg" placeholder="cantidad" required>
                                            <label class="text-secondary" for="floatingInput">Codigo de Catálago</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input value="<?php echo $datosEdit["n_Inv"] ; ?>" type="number" name="inv" id="floatingInput" class="border border-primary border-3 form-control form-control-lg" placeholder="cantidad" required>
                                            <label class="text-secondary" for="floatingInput">Número de Inventario</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input value="<?php echo $datosEdit["descripcion"] ; ?>" type="text" name="desc" id="floatingInput" class="border border-primary border-3 form-control form-control-lg" placeholder="cantidad" required>
                                            <label class="text-secondary" for="floatingInput">Descripción</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input value="<?php echo $datosEdit["precioUni"] ; ?>" type="text" name="precio" id="floatingInput" class="border border-primary border-3 form-control form-control-lg" placeholder="cantidad" required>
                                            <label class="text-secondary" for="floatingInput">Precio Unitario</label>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <input type="hidden" name="id" value="<?php echo $datosEdit["id"]; ?>">
                                            <input type="hidden" name="tipoBn" value="<?php echo 'bienesMbls'; ?>">
                                            <input type="hidden" name="ubicacion" value="<?php echo 'bnsMbls'; ?>">
                                            <a class="dropdown-items" href="bnsMbls.php">    
                                                <button type="button" class="btn btn-2 shadow border-3 btn-outline-danger">Cancelar</button>
                                            </a>
                                            <button type="submit" class="btn btn-2 shadow border-3 btn-outline-success">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Modal Insertar -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Bien Mueble</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="dataBase/insertBns.php">
                                    <div class="container-fluid d-flex">
                                        <div class="form-floating mb-4 me-1">
                                            <input type="number" name="cant" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Cantidad</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" name="codCat" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Codigo de Catalago</label>
                                        </div>
                                    </div>
                                    <div class="container-fluid d-flex">
                                        <div class="form-floating mb-4 me-1">
                                            <input type="number" name="inv" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Numero de Inventario</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" name="precio" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Precio Unitario</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4 container-fluid d-flex">
                                        <input type="text" name="desc" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                        <label class="text-dark">Descripcion</label>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <input type="hidden" name="ubicacion" value="bnsMbls">
                                        <input type="hidden" name="tabla" value="bienesMbls">
                                        <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                
            </div>
        </div>
    </div>
    
    <div id="body1" class="shadow margin-left"></div>
    <div id="body2" class="shadow margin-left"></div>

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
    <!-- Modal Editar -->
    <script>
        window.onload = function verModal(){
            $('#modal').modal('show');
        }
    </script>
    <!-- Modal Ver -->
     <script>
        function modalVer(idModal) {
            $('#modalVer'+idModal).modal('show');
        }
     </script>

<!-- Mensajes Presentes -->

<!-- Eliminado -->
<?php if (!empty($mensajeEliminar)) :?>
    <script>
        window.onload = function mensaje(){
            swal.fire({
                    title: "Registro Eliminado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1300
            });
        };
    </script>
<?php endif; ?>

<!-- Editado -->
<?php if (!empty($mensajeEdit)) : ?>
    <script>
        window.onload = function mensajeEdit(){
            swal.fire({
                    title: "Registro Editado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1300
            });
        };
    </script>
<?php endif; ?>

<!-- Registrado -->
<?php if (!empty($mensajeRegistro)) :?>
    <script>
        window.onload = function mensajeRegistro(){
            swal.fire({
                    title: "Datos Registrados Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1300
            });
        };
    </script>
<?php endif; ?>
</body>
</html>