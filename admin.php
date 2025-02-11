
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
        $bienvenido = $_SESSION['bienvenido'];
        unset($_SESSION['bienvenido']);
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

    <div id="body" class="margin-left-width me-0">
   
        <div class="text-center container-fluid rounded align-items-center h-100">
            
            <br>

            <div>
                <h1 class="display-6 text-light">Panel de Control</h1>
            </div>

            <div class="row mx-auto container justify-content-center pt-3 border-1 border-top">

                <div class="items-hover-dash m-md-4 m-3 p-2 col-md-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="bnsNcn.php">
                        <img src="icons\bandera-edificio-dash.svg" style="width: 40px; height:40px">    
                        <h4 class="ms-2 my-auto">| Bienes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3"><?= $rowBien ?></p>
                    </a>
                </div>

                <div class="items-hover-dash m-md-4 m-3 p-2 col-md-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidDoc.php">
                        <img src="icons/pizzarron-user-dash.svg" style="width: 40px; height:40px">
                        <h4 class="ms-2 my-auto">| Docentes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3"><?= $rowDocentes ?></p>
                    </a>
                </div>

                <div class="items-hover-dash m-md-4 m-3 p-2 col-md-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="entidAlmn.php">
                        <img src="icons\gorro-graduacion.svg" style="width: 40px; height:40px">
                        <h4 class="ms-2 my-auto">| Alumnos</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3"><?= $rowAlumnos ?></p>
                    </a>
                </div>

                <div class="items-hover-dash m-md-4 m-3 p-2 col-md-3">
                    <a class="dropdown-item d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="mensajes.php">
                        <img src="icons\atencion_client-dash.svg" style="width: 40px; height:40px">
                        <h4 class="ms-2 my-auto">| Mensajes</h4>
                        <p class="my-auto fw-bolt fs-1 mx-3"><?= $rowMensajes ?></p>
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
            let nombre = '<?php echo $bienvenido; ?>';
            window.onload = function(){
                swal.fire({
                    title : "¡Bienvenido(a) " + nombre +"!",
                    icon : "success",
                    timer : "1700",
                    text : "¡Acceso Concedido!",
                    showConfirmButton : false
                });
            }
        </script>
    <?php  } ?>
</body>
</html>