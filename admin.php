
<?php
    include('dataBase/conn.php');
    session_start();

    $mensaje="";
    $bienvenido = '';
    $registroUser = '';

    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION['bienvenido'])) {
        $bienvenido = $_SESSION['mensaje'];
        unset($_SESSION['bienvenido']);
    }
    
    if (isset($_SESSION['usuario-registrado-firs'])) {
        $registroUser = 'no vacio';
        unset($_SESSION['usuario-registrado-firs']);
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
                <div class="items-hover-dash <?= $mensaje === 'Usuario' ? 'visually-hidden' : '' ?> bg-gradiente bg-gradiente-blue m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="bnsNcn.php">
                        <img src="icons\bandera-edificio-dash.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Bienes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowBien ?></p>
                    </a>
                </div>

                <!-- docentes -->
                <div class="items-hover-dash <?= $mensaje === 'Usuario' ? 'visually-hidden' : '' ?> bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidDoc.php">
                        <img src="icons/pizzarron-user-dash.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Docentes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowDocentes ?></p>
                    </a>
                </div>

                <!-- alumnos -->
                <div class="items-hover-dash <?= $mensaje === 'Usuario' ? 'visually-hidden' : '' ?> bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidAlmn.php">
                        <img src="icons\gorro-graduacion.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Alumnos</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3 shadow-text"><?= $rowAlumnos ?></p>
                    </a>
                </div>

                <!-- reportes -->
                <div class="items-hover-dash <?= $mensaje === 'Usuario' ? '' : 'visually-hidden' ?> bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="rptResFn.php">
                        <img src="icons\resumen.svg" style="width: 40px; height:40px" class="shadow-white">
                        <h4 class="ms-2 my-auto shadow-text">| Resumen Final</h4>
                    </a>
                </div>

                <!-- mesajes -->
                <div class="items-hover-dash <?= $mensaje === 'Usuario' ? 'visually-hidden' : '' ?> bg-gradiente bg-gradiente-blue  m-md-4 m-3 p-2 col-lg-3">
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

    <!-- Mensaje de Registro de Datos de usuario exitoso -->
    <?php if(!empty($registroUser)){ ?> 
        <script>
            window.onload = function(){
                swal.fire({
                    title : "¡Registro Exitoso!",
                    icon : "success",
                    timer : "1700",
                    text : "¡BIENVENIDO(a)!",
                    showConfirmButton : false
                });
            }
        </script>
    <?php  } ?>

</body>
</html>