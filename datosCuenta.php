<?php
    include('dataBase/conn.php');
    
    session_start();

    $mensaje="";
    $mensajeErrorPass='';
    $mensajeRegistro='';
    $mensajeUsuarioExist='';

    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION["mensaje-clave-mal"])) {
        $mensajeErrorPass="contraseñas no coinciden";
        unset($_SESSION["mensaje-clave-mal"]);
    }

    if (isset($_SESSION["mensaje-registro"])) {
        $mensajeRegistro="contraseñas no coinciden";
        unset($_SESSION["mensaje-registro"]);
    }

    if (isset($_SESSION["mensaje-usuario-exist"])) {
        $mensajeUsuarioExist="contraseñas no coinciden";
        unset($_SESSION["mensaje-usuario-exist"]);
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }
    
    

    $idUser = $_SESSION['idUser'];

    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $procesar = $conn -> prepare($sql);
    $procesar -> bindParam(':id', $idUser);
    $procesar -> execute();

    $userDate = $procesar -> fetch(PDO::FETCH_ASSOC);

    $pagAct = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas de Usuario</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
</head>
<body class="bg-dark">

    <?php include("menuDes.html"); ?>
    
    <br><br><br>
    
    <div id="body" class="rounded margin-left-width">
   
        <div class="bg-footer rounded">

            <br>
            
            <div class="d-block d-md-flex text-center justify-content-md-between justify-content-center align-items-center px-md-3 px-0">
                <h1 class="fs-3 text-light fw-light"><img src="icons/user.svg"  style="width: 40px; height:40px"> | ...</h1>  
                <label class="d-none d-sm-flex fs-3 text-light fw-light">... |</label>
            </div>

            <hr class="border">

            <div class="d-sm-flex px-md-5 justify-content-center">
            
                <div class="mx-auto mod-hover my-3 ps-md-5" data-bs-toggle="modal" data-bs-target="#modal_registrar">
                    <a class="justify-content-center text-center dropdown-item rounded d-md-flex align-items-center py-2 px-3" href="#">
                        <img src="icons/tarjeta-personal.svg" style="width: 70px; height:70px;">
                        <h5 class="ps-sm-4 fw-light py-2"> | Crear Nueva Cuenta</h5>
                    </a>
                </div>

                <div class="mx-auto mod-hover my-3 pe-md-5">
                    <a class="justify-content-center text-center dropdown-item rounded d-md-flex align-items-center py-2 px-3" href="#">
                        <img src="icons/escudo.svg" style="width: 70px; height:70px;">
                        <h5 class="ps-sm-4 fw-light py-2">| Seguridad de Mi Cuenta</h5>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal Registrar Usuario -->
    <div class="modal fade" id="modal_registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="dataBase/insertUser.php">

                        <div class="container-fluid justify-content-center">

                            <div class="form-floating mb-4">
                                <input type="text" name="nombre" id="floatingInput" class="border border-secondary border-2 form-control" placeholder="usuario" required>
                                <label class="text-secondary" for="floatingInput">Nombre de Usuario</label>
                            </div>

                            <div class="form-floating mb-4 input-group">
                                <input type="password" name="pass1" id="pass1" class="border border-secondary border-2 form-control" placeholder="usuario" required>
                                <label class="text-secondary" for="floatingInput">Contraseña</label>
                                <span class="input-group-text">
                                    <img id="iconEye" src="icons/eye.svg" class="cursor-pointer">
                                    <img id="iconEye2" src="icons/eye-slash.svg" class="cursor-pointer visually-hidden">
                                </span>
                            </div>

                            <div class="form-floating mb-3 input-group">
                                <input type="password" name="pass2" id="pass2" placeholder="Contraseña" class="border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Repetir Contraseña</label>
                                <span class="input-group-text">
                                    <img id="iconEye3" src="icons/eye.svg" class="cursor-pointer">
                                    <img id="iconEye4" src="icons/eye-slash.svg" class="cursor-pointer visually-hidden">
                                </span>
                            </div>

                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Registrar</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="body1" class="shadow margin-left-width"></div>
    <div id="body2" class="shadow margin-left-width"></div>

    <!-- Alerta Contraseña no coinciden -->
    <?php if (!empty($mensajeErrorPass)) :?>
        <script>
            window.onload = function mensaje(){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                        title: "Las Contraseñas no Coinciden",
                        text: "Vuelve a Intentarlo",
                        icon: "error"
                    });
            }
        </script>
    <?php endif; ?>

    <!-- Alerta Usuario ya Existente -->
    <?php if (!empty($mensajeUsuarioExist)) : ?>
        <script>
            window.onload = function mensaje(){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                        title: "Nombre de Usuario Ya Registrado",
                        text: "Vuelve a Intentarlo",
                        icon: "error"
                    });
            }
        </script>
    <?php endif; ?>

    <?php include("footer.html"); ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>

    <!-- interaccion ver o ocultar contrasenha -->
    <script>
        const Pass1 = document.getElementById("pass1");
        const Pass2 = document.getElementById("pass2");
        const iconEye = document.getElementById("iconEye");
        const iconEye2 = document.getElementById("iconEye2");
        const iconEye3 = document.getElementById("iconEye3");
        const iconEye4 = document.getElementById("iconEye4");

        iconEye.addEventListener('click', function () {
            Pass1.type = 'text';
            iconEye2.classList.remove("visually-hidden");
            iconEye.classList.add("visually-hidden");
        });
        iconEye2.addEventListener('click', function () {
            Pass1.type = 'password';  
            iconEye.classList.remove("visually-hidden");
            iconEye2.classList.add("visually-hidden");
        });
        iconEye3.addEventListener('click', function () {
            Pass2.type = 'text';
            iconEye4.classList.remove("visually-hidden");
            iconEye3.classList.add("visually-hidden");
        });
        iconEye4.addEventListener('click', function () {
            Pass2.type = 'password';  
            iconEye3.classList.remove("visually-hidden");
            iconEye4.classList.add("visually-hidden");
        });
    </script>

    <!-- usuario Registrado -->
    <?php if (!empty($mensajeRegistro)) :?>
        <script>
            window.onload = function mensajeRegistro(){
                swal.fire({
                        title: "Usuario Registrado Exitosamente",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1300
                });
            };
        </script>
    <?php endif; ?>
</body>
</html>