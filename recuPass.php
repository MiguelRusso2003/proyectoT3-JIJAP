<?php

    include("dataBase/conn.php");

    session_start();

    $mensaje = "";
    $mensajeError = "";

    if (isset($_SESSION['incorrecto'])) {
        $mensaje = "Miguel";
        unset($_SESSION['incorrecto']);
    }

    if (isset($_SESSION['error'])) {
        $mensajeError = "12345";
        unset($_SESSION['error']);
    }

    if (isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];

        $sql = "SELECT * FROM usuarios WHERE user = :usuario";
        $resultado = $conn -> prepare($sql);
        $resultado -> bindParam(':usuario', $usuario);
        $resultado -> execute();

        $user = $resultado -> fetch(PDO::FETCH_ASSOC);

        if (empty($user["user"])){ 
            header("location:dataBase/verUser.php");
        }
    }
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
                <div class="col col-xl-8 h-75">
                    <div class="card h-100 border-2 border-primary bg-light" style="border-radius: 1rem; box-shadow:0px 0px 20px -5px blue;">
                        <div class="row g-0 h-100">
                            <!-- Carusel de imagenes -->
                            <div class="col-md-6 col-lg-6 d-none d-md-block border-end border-1 border-primary h-100">
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

                            <!-- Formularios -->
                            <div class="col-md-6 col-lg-6 d-flex align-items-center h-100">
                                <div class="card-body p-2 p-lg-5 text-black">

                                    <?php if (!isset($_POST["usuario"])) :?>

                                        <form action="" method="post">
                                            
                                            <div class="form-floating mb-4">
                                                <input type="text" name="usuario" id="floatingInput" class="border border-secondary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-secondary" for="floatingInput"><?php echo 'Ingresar Nombre de Usuario'; ?></label>
                                            </div>

                                            <div class="d-flex pt-1 mb-3 justify-content-center">
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn border-2 btn-outline-primary btn-block" type="submit">Siguiente</button>
                                            </div>

                                        </form>

                                        <div class="d-flex mb-2 mt-3 justify-content-center align-items-center">
                                            <a href="login.php" id="olviPass">Volver al Inicio de Sesion</a>
                                        </div>

                                    <?php endif; ?>

                                    <?php if (!empty($user["user"])){ ?>

                                        <form action="dataBase/recPass.php" method="post">

                                            <div class="form-floating mb-4">
                                                <input type="password" name="resp1" id="floatingInput" class="border border-secondary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-secondary" for="floatingInput"><?php echo $user["pregunta1"]; ?></label>
                                            </div>

                                            <div class="form-floating mb-4">
                                                <input type="password" name="resp2" id="floatingInput" class="border border-secondary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-secondary" for="floatingInput"><?php echo $user["pregunta2"]; ?></label>
                                            </div>

                                            <div class="d-flex pt-1 mb-3 justify-content-center">
                                                <input type="hidden" name="usuario" value="<?php echo $user["user"]; ?>">
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn border-2 btn-outline-primary btn-block" type="submit">Verificar</button>
                                            </div>

                                        </form>

                                        <div class="d-flex mb-2 mt-3 justify-content-center align-items-center">
                                            <a href="login.php" id="olviPass">Volver al Inicio de Sesion</a>
                                        </div>

                                    <?php }?>
                                    
                                </div>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- footer -->
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0 text-light">© 2024-25 Jardín de Infancia "José Antonio Páez"</span>
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

    <!-- Mensajes Presentes -->
    <?php
        if (!empty($mensaje)) :
            echo '
                <script>
                    window.onload = function mensaje(){
                                        const swalWithBootstrapButtons = Swal.mixin({
                                            customClass: {
                                            confirmButton: "btn btn-primary"
                                            },
                                            buttonsStyling: false
                                        });
                                        swalWithBootstrapButtons.fire({
                                                text: "⚠️ Nombre de Usuario no Registrado en la base de Datos del Sistema ⚠️",
                                                icon: "info"
                                            });
                                    };
                    ;
                </script>
            '; 
        endif; 
    ?>
    <?php
        if (!empty($mensajeError)) :
            echo '
                <script>
                    window.onload = function mensaje(){
                                        const swalWithBootstrapButtons = Swal.mixin({
                                            customClass: {
                                            confirmButton: "btn btn-primary"
                                            },
                                            buttonsStyling: false
                                        });
                                        swalWithBootstrapButtons.fire({
                                                text: "⚠️ Respuesta(s) Incorrecta(s) ⚠️",
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
</body>
</html>

