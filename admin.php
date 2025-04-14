
<?php
    include('dataBase/conn.php');
    session_start();

    $mensaje="";
    $bienvenido = '';

    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION['bienvenido'])) {
        $bienvenido = $_SESSION['mensaje'];
        unset($_SESSION['bienvenido']);
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }

    $pagAct = basename($_SERVER['PHP_SELF']);

    $sqlMtls = "SELECT * FROM bienesmtls";
    $sqlMbls = "SELECT * FROM bienesmbls";
    // $sqlPersonal = "SELECT * FROM ";
    $sqlDocentes = "SELECT * FROM docentes";
    $sqlAlumnos = "SELECT * FROM alumnos";
    $sqlMensajes = "SELECT * FROM mensajes";

    $stmtMtls = $conn->query($sqlMtls);
    $stmtMbls = $conn->query($sqlMbls);
    $stmtDocentes = $conn->query($sqlDocentes);
    $stmtAlumnos = $conn->query($sqlAlumnos);
    $stmtMensajes = $conn->query($sqlMensajes);

    $rowBien = $stmtMtls->rowCount() + $stmtMbls->rowCount();
    $rowDocentes = $stmtDocentes->rowCount();
    $rowAlumnos = $stmtAlumnos->rowCount();
    $rowMensajes = $stmtMensajes->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
</head>
<body class="bg-dark">
    <?php include("menuDes.html"); ?>

    <br><br>

    <div id="body" class="margin-left-width shadow mt-3" style="border-radius: 10px; background-image : url(img/dashboard.png); background-size : cover">
   
        <div class="container-fluid text-center rounded bg-dark-trans align-items-center h-100">
            
            <br>

            <div>
                <h1 class="display-6 text-light">Panel de Control</h1>
            </div>

            <!-- modulos estadisticos -->
            <div class="row mx-auto container justify-content-center pt-3 border-1 border-top">

                <!-- bienes nacionales -->
                <div class="items-hover-dash bg-gradiente bg-gradiente-blue m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="bnsNcn.php">
                        <img src="icons\bandera-edificio-dash.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Bienes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowBien ?></p>
                    </a>
                </div>

                <!-- docentes -->
                <div class="items-hover-dash bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidDoc.php">
                        <img src="icons/pizzarron-user-dash.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Docentes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowDocentes ?></p>
                    </a>
                </div>

                <!-- alumnos -->
                <div class="items-hover-dash bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidAlmn.php">
                        <img src="icons\gorro-graduacion.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Alumnos</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowAlumnos ?></p>
                    </a>
                </div>

                <!-- mesajes -->
                <div class="items-hover-dash bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="mensajes.php">
                        <img src="icons\atencion_client-dash.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Mensajes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowMensajes ?></p>
                    </a>
                </div>

            </div>

            <br>
            <br>
            <br>
        
        </div>
    </div>
    
    
    <div id="body1" class="shadow margin-left-width"></div>
    <div id="body2" class="shadow margin-left-width"></div>

    <?php include("footer.html"); ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script>
        let table = new DataTable("#myTable");
    </script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>

    <!-- Modal Registro de Datos de Usuario por primera vez -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-nuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRO DE USUARIO</h1>
                </div>
                <div class="modal-body">
                    <form method="POST" action="dataBase/editUser.php">
                        <div class="d-sm-flex justify-content-center">
                            <div class="form-floating mx-2 mb-3">
                                <input type="text" name="nombre" class="transition border border-secondary border-2 form-control" placeholder="Ingresar nombre" required>
                                <label class="text-secondary" for="floatingInput">Nombre</label>
                            </div>
                            <div class="form-floating mx-2 mb-3">
                                <input type="text" name="apellido" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Apellido</label>
                            </div>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input type="mail" name="correo" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                            <label class="text-secondary">Correo Electrónico</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input type="text" name="pgt1" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" value="¿?" required>
                            <label class="text-secondary">Pregunta de Seguridad 1</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input type="text" name="pgt2" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" value="¿?" required>
                            <label class="text-secondary">Pregunta de Seguridad 2</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input type="text" name="resp1" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                            <label class="text-secondary">Respuesta Pregunta 1</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input type="text" name="resp2" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                            <label class="text-secondary">Respuesta Pregunta 2</label>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['idUser']; ?>">
                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mensaje de Bienvenida al Iniciar Sesion -->
    <?php if(!empty($primerIngre)){ ?> 
        <script>
            window.onload = ()=> {
                $('#modal-nuevo').modal('show');
            }
        </script>
    <?php  } ?>

    <!-- Mensaje de Bienvenida al Iniciar Sesion -->
    <?php if(!empty($bienvenido)){ ?> 
        <script>
            let userTipo = '<?php echo $bienvenido; ?>';
            window.onload = function(){
                swal.fire({
                    title : "¡Bienvenido(a)!",
                    icon : "success",
                    timer : "1700",
                    text : "¡Acceso "+ userTipo +" Concedido!",
                    showConfirmButton : false
                });
            }
        </script>
    <?php  } ?>
</body>
</html>