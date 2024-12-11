<?php

    include("dataBase/conn.php");

    session_start();
    $mensaje='';
    $mensajeErrorPass='';

    if (isset($_SESSION['correcto'])) {
        $mensaje = $_SESSION['correcto'];
        unset($_SESSION['correcto']);
    }
    if (isset($_SESSION["passError"])) {
        $mensajeErrorPass="contraseñas no coinciden";
        unset($_SESSION["passError"]);
    }
    $usuario = $_SESSION["usuario"];

    $sql = "SELECT * FROM usuarios WHERE user = :usuario";
    $resultado = $conn -> prepare($sql);
    $resultado -> bindParam(":usuario", $usuario);
    $resultado -> execute();

    $user = $resultado -> fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
</head>
<body class="bg-dark">

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-8">
                    <div class="card h-100 border-2 border-primary bg-light" style="border-radius: 1rem; box-shadow:0px 0px 20px -5px blue;">
                        <div class="row g-0 h-100">

                            <div class="col-md-6 col-lg-6 d-none d-md-block border-end border-1 border-primary h-100">
                                <!-- Carrusel -->
                                <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner h-100" style="border-top-left-radius: 1rem; border-bottom-left-radius: 1rem">
                                        <div class="carousel-item active" data-bs-interval="3000">
                                            <img src="img/login1.jpg" class="w-100 h-100" alt="...">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="img/login2.jpg" class="w-100 h-100" alt="...">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="img/login4.jpg" class="w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                  
                            <div class="col-md-6 col-lg-6 d-flex align-items-center h-100 my-auto">
                                <div class="card-body p-2 p-lg-5 text-black">
                                    
                                    <!-- Opciones de Cambio de contraseña -->
                                    <div class="d-flex w-100 align-items-center justify-content-center">
                                        <button type="button" onclick="verPass('<?php echo $user['pass']; ?>')" class="btn btn-lg btn-outline-success border-2">Ver Contraseña</button>
                                        <hr class="vr me-3 ms-3">
                                        <button type="button" class="btn btn-lg btn-outline-primary border-2 " data-bs-toggle="modal" data-bs-target="#exampleModal">Cambiar Contraseña</button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CAMBIO DE CONTRASEÑA</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="dataBase/editPass.php">
                                                        <div class="form-floating mb-4">
                                                            <input type="password" name="newPass" id="floatingInput" class="border border-secondary border-2 form-control" placeholder="usuario" required>
                                                            <label class="text-secondary" for="floatingInput">Nueva Contraseña</label>
                                                        </div>
                                                        <div data-mdb-input-init class="form-floating mb-3">
                                                            <input type="password" name="confirmPass" placeholder="Contraseña" class="border border-secondary border-2 form-control" required>
                                                            <label class="text-secondary">Reescribir contraseña</label>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                                                            <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-2 mt-4 justify-content-center align-items-center">
                                        <a href="login.php" class="text-primary">Volver al Inicio de Sesion</a>
                                    </div>
                                
                                </div>
                            </div>                                                                                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0 text-light">© 2024 Jardín de Infancia "José Antonio Páez"</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    
                    <li class="ms-3">
                        <a class="text-light" style="cursor: pointer;" onclick="correo()">
                            <img src="icons/correo.svg" style="width:40px; height:40px;">
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="text-light" style="cursor: pointer;" onclick="ubicacion()">
                            <img src="icons/location.svg" style="width:40px; height:40px;">
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="text-light" style="cursor: pointer;" onclick="phone()">
                            <img src="icons/phone.svg" style="width:40px; height:40px;">
                        </a>
                    </li>
                </ul>
            </footer>
        </div>

    </section>

    <!-- Alerta Usuario verificado -->
    <?php
        if (!empty($mensaje)) :
            echo '
                <script>
                    window.onload = function mensaje(){
                                        const swalWithBootstrapButtons = Swal.mixin({
                                            customClass: {
                                            confirmButton: "btn btn-success"
                                            },
                                            buttonsStyling: false
                                        });
                                        swalWithBootstrapButtons.fire({
                                                title: "Usuario Verificado",
                                                text: "Tu Decides: Recordar la contraseña o Cambiarla.",
                                                icon: "success"
                                            });
                                    };
                    ;
                </script>
            '; 
        endif; 
    ?>

    <!-- Alerta Contraseña no coinciden -->
    <?php
        if (!empty($mensajeErrorPass)) :
            echo '
                <script>
                    window.onload = function mensaje(){
                                        const swalWithBootstrapButtons = Swal.mixin({
                                            customClass: {
                                            confirmButton: "btn btn-danger"
                                            },
                                            buttonsStyling: false
                                        });
                                        swalWithBootstrapButtons.fire({
                                                title: "Contraseña Sin Coincidencia",
                                                text: "las Contraseñas no Coinciden",
                                                icon: "error"
                                            });
                                    };
                    ;
                </script>
            '; 
        endif; 
    ?>

    <script src="js/js.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <!-- Modal -->
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.
        })
        }
    </script>
</body>
</html>

