<?php
    include("dataBase/conn.php");

    $pagAct = basename($_SERVER['PHP_SELF']);
    
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

        $sqlEdit = "SELECT * FROM docentes WHERE id = :id";
        $ejecutarSql = $conn -> prepare($sqlEdit);
        $ejecutarSql -> bindParam(':id', $idEdit);
        $ejecutarSql -> execute();

        $datosEdit = $ejecutarSql -> fetch(PDO::FETCH_ASSOC); 
    }

    $sql = "SELECT * FROM docentes";
    $resultado = $conn -> query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rpt Bns Ncn</title>
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

    <div id="body" class="rounded margin-left-width" style="background-image:url(img/bg-reporte4.jpg); background-size:cover;background-attachment: fixed; ">

        <div class="container-fluid bg-white-trans rounded">
            <div class="container">
                
                <br>

                <div class="d-md-flex text-center justify-content-between align-items-center">
                    <div class="d-md-flex d-block">
                        <img src="icons/bandera-edificio.svg" style="width: 70px;"><hr class="d-md-none w-25 mx-auto border-primary border"><div class="vr mx-3 d-md-block d-none border-primary"></div>
                        <h1 class="display-5">Reporte Bienes Nacionales </h1>
                    </div>

                    <div class="alert alert-info" role="alert">
                        Complete los datos del Formulario y presione "Generar Reporte"
                    </div>
                </div>
                
                <hr>

                <br><br>

                <form method="POST" action="rptBieNcn.php" enctype="multipart/form-data">

                    <div class="container-fluid d-md-flex justify-content-center">

                        <div class="form-floating mb-4 mx-2 col-md-3">
                            <input type="date" name="fecha" placeholder="date" class="border border-info border-2 form-control form-control-lg" required>
                            <label class="text-dark">Fecha:</label>
                        </div>

                        <div class="form-floating mb-4 mx-2 col-md-3">
                            <select class="form-control me-1 border border-2 border-info" name="tpBnNc">
                                <option value="bienesmbls" selected>Bienes Muebles</option>
                                <option value="bienesmtls">Bienes Materiales</option>
                            </select>
                            <label class="text-dark">Tipo de Bien Nacional</label>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center align-items-center fw-bolt">
                        <button type="submit" class="btn btn-primary border-2 mx-3" ><img src="icons/pdf.svg" width="30" alt=""><p class="m-0">Generar Reporte</p></button>
                    </div>
                    
                </form>

                <br><br>
                
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