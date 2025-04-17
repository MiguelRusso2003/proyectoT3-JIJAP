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

    $passExit='';

    if (isset($_SESSION['pass-exito'])) {
        $passExit="contraseña coincide";
        unset($_SESSION['pass-exito']);
    }

    $registroUser = '';
    
    if (isset($_SESSION['usuario-registrado-firs'])) {
        $registroUser = 'no vacio';
        unset($_SESSION['usuario-registrado-firs']);
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
                <h1 class="fs-5 text-light fw-light"><img src="icons/user.svg"  style="width: 40px; height:40px"> | <?= $userDate['nombre'].' '.$userDate['apellido'] ?></h1>  
            </div>

            <hr class="border">

            <div class="d-md-flex px-md-5 justify-content-center">
            
                <div class="<?= $mensaje === 'Usuario' ? 'visually-hidden' : '' ?> bg-gradiente bg-gradiente-green text-light rounded border-light border-2 border cursor-pointer mx-3 mx-md-auto my-3 px-md-5 text-center" style="box-shadow: 0px 0px 15px -5px #ffffff;" data-bs-toggle="modal" data-bs-target="#modal_registrar">
                    <img src="icons/person-add.svg" style="width: 70px; height:70px;">
                    <a class="justify-content-center text-center dropdown-item rounded align-items-center py-2 px-3" href="#">
                        <hr class="w-25 my-1 mx-auto">
                        <h5 class="fw-light py-1 my-1">Generar Cuenta</h5>
                    </a>
                </div>

                <div class="bg-gradiente bg-gradiente-green text-light rounded border-light border-2 border cursor-pointer mx-3 mx-md-auto my-3 px-md-5 text-center" style="box-shadow: 0px 0px 15px -5px #ffffff;" onclick="abrirModal()">
                    <img src="icons/person-gear.svg" style="width: 70px; height:70px;">
                    <a class="justify-content-center text-center dropdown-item rounded align-items-center py-2 px-3" href="#">
                        <hr class="w-25 my-1 mx-auto">
                        <h5 class="fw-light py-1 my-1">Modificar Mis Datos</h5>
                    </a>
                </div>

                <div class="bg-gradiente bg-gradiente-green text-light rounded border-light border-2 border cursor-pointer mx-3 mx-md-auto my-3 px-md-5 text-center" style="box-shadow: 0px 0px 15px -5px #ffffff;" onclick="abrirModalClave()">
                    <img src="icons/person-lock.svg" style="width: 70px; height:70px;">
                    <a class="justify-content-center text-center dropdown-item rounded align-items-center py-2 px-3" href="#">
                        <hr class="w-25 my-1 mx-auto">
                        <h5 class="fw-light py-1 my-1">Cambiar Contraseña</h5>
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

                            <div class="form-floating mb-4">
                                <select name="roll" id="floatingInput" class="border border-secondary border-2 form-select" placeholder="usuario" required>
                                    <option value="Usuario" selected>Usuario</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                                <label class="text-secondary" for="floatingInput">Roll de Usuario</label>
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

    <!-- Modal Editar Datos de Usuario -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR DATOS DE USUARIO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="dataBase/editUser.php">
                        <div class="d-sm-flex justify-content-center">
                            <div class="form-floating mx-2 mb-3">
                                <input value="<?= $userDate['nombre'] ?>" type="text" name="nombre" class="transition border border-secondary border-2 form-control" placeholder="Ingresar nombre" required>
                                <label class="text-secondary" for="floatingInput">Nombre</label>
                            </div>
                            <div class="form-floating mx-2 mb-3">
                                <input value="<?= $userDate['apellido'] ?>" type="text" name="apellido" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Apellido</label>
                            </div>
                        </div>
                        <div class="d-sm-flex justify-content-center">
                            <div class="form-floating mx-2 mb-3">
                                <input value="<?= $userDate['user'] ?>" type="text" name="user" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Nombre de Usuario</label>
                            </div>
                            <div class="form-floating mx-2 mb-3">
                                <input value="<?= $userDate['correo'] ?>" type="mail" name="correo" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Correo Electrónico</label>
                            </div>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input value="<?= $userDate['pregunta1'] ?>" type="text" name="pgt1" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" value="¿?" required>
                            <label class="text-secondary">Pregunta de Seguridad 1</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input value="<?= $userDate['pregunta2'] ?>" type="text" name="pgt2" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" value="¿?" required>
                            <label class="text-secondary">Pregunta de Seguridad 2</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input value="<?= $userDate['resp1'] ?>" type="text" name="resp1" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                            <label class="text-secondary">Respuesta Pregunta 1</label>
                        </div>
                        <div class="form-floating mx-2 mb-3">
                            <input value="<?= $userDate['resp2'] ?>" type="text" name="resp2" placeholder="Ingresar Apellido" class="transition border border-secondary border-2 form-control" required>
                            <label class="text-secondary">Respuesta Pregunta 2</label>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['idUser']; ?>">
                            <input type="hidden" name="pagAc" value="<?= $pagAct ?>">
                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Guardar</button>
                            <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cambiar contrasenha -->
    <div class="modal fade" id="modal-clave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="dataBase/editUser.php">

                        <div class="container-fluid justify-content-center">

                            <div class="alert alert-info mt-3 mt-md-0" role="alert">Al cambiar de contraseña, se cerrará la sesión de forma automática</div>

                            <div class="form-floating mb-4 input-group">
                                <input type="password" name="clave" id="clave1" class="border border-secondary border-2 form-control" placeholder="usuario" required>
                                <label class="text-secondary" for="floatingInput">Nueva Contraseña</label>
                                <span class="input-group-text">
                                    <img id="iconOjo" src="icons/eye.svg" class="cursor-pointer">
                                    <img id="iconOjo2" src="icons/eye-slash.svg" class="cursor-pointer visually-hidden">
                                </span>
                            </div>

                            <div class="form-floating mb-3 input-group">
                                <input type="password" name="clave2" id="clave2" placeholder="Contraseña" class="border border-secondary border-2 form-control" required>
                                <label class="text-secondary">Repetir Contraseña</label>
                                <span class="input-group-text">
                                    <img id="iconOjo3" src="icons/eye.svg" class="cursor-pointer">
                                    <img id="iconOjo4" src="icons/eye-slash.svg" class="cursor-pointer visually-hidden">
                                </span>
                            </div>

                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">
                            <input type="hidden" name="id" value="<?= $_SESSION['idUser'] ?>">
                            <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Cambiar</button>
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

    <!-- funcion de javascript para activar modal editar -->
    <script>
        function abrirModal(){
            $('#modalEdit').modal('show');
        }
    </script>

    <!-- funcion de javascript para activar modal clave -->
    <script>
        function abrirModalClave(){
            $('#modal-clave').modal('show');
        }
    </script>

    <!-- Mensaje de modificacion de Datos de usuario exitoso -->
    <?php if(!empty($passExit)){ ?> 
        <script>
            window.onload = function(){
                swal.fire({
                    icon : "success",
                    timer : "1700",
                    showConfirmButton : false
                });
            }

            setTimeout(()=>{
                window.location.href = 'dataBase/logout.php';
            }, 1800);
        </script>
    <?php  } ?>

    <!-- Mensaje de modificacion de Datos de usuario exitoso -->
    <?php if(!empty($registroUser)){ ?> 
        <script>
            window.onload = function(){
                swal.fire({
                    icon : "success",
                    timer : "1700",
                    showConfirmButton : false
                });
            }
        </script>
    <?php  } ?>

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

    <!-- interaccion ver o ocultar contrasenha 2 -->
    <script>
        const clave1 = document.getElementById("clave1");
        const clave2 = document.getElementById("clave2");
        const iconOjo = document.getElementById("iconOjo");
        const iconOjo1 = document.getElementById("iconOjo2");
        const iconOjo3 = document.getElementById("iconOjo3");
        const iconOjo4 = document.getElementById("iconOjo4");

        iconOjo.addEventListener('click', function () {
            clave1.type = 'text';
            iconOjo1.classList.remove("visually-hidden");
            iconOjo.classList.add("visually-hidden");
        });
        iconOjo1.addEventListener('click', function () {
            clave1.type = 'password';  
            iconOjo.classList.remove("visually-hidden");
            iconOjo1.classList.add("visually-hidden");
        });
        iconOjo3.addEventListener('click', function () {
            clave2.type = 'text';
            iconOjo4.classList.remove("visually-hidden");
            iconOjo3.classList.add("visually-hidden");
        });
        iconOjo4.addEventListener('click', function () {
            clave2.type = 'password';  
            iconOjo3.classList.remove("visually-hidden");
            iconOjo4.classList.add("visually-hidden");
        });
    </script>

    <!-- mensaje usuario Registrado -->
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