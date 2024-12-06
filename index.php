<?php
    session_start();

    $bienvenido = '';
    $mensaje = "";
    $mensaje_env ='';

    if (isset($_SESSION['mensaje'])) {
        $mensaje = $_SESSION['mensaje'];
    }else {
        header('location:login.php');
    }

    if (isset($_SESSION['bienvenido'])) {
        $bienvenido = $_SESSION['bienvenido'];
        unset($_SESSION['bienvenido']);
    }

    if (isset($_SESSION['mensaje-enviado'])) {
        $mensaje_env = $_SESSION['mensaje-enviado'];
        unset($_SESSION['mensaje-enviado']);
    }

    $pagAct = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
</head>
<body class="bg-dark">

    <?php include('menuDes.html'); ?>

    <br><br><br>
    
    <div id="body" class="rounded margin-left" style="background-attachment: fixed;
                                                      background-image: url(img/bg-estadistica.jpg); 
                                                      background-size:cover; 
                                                      background-repeat:no-repeat;">
    
        <div class="text-center container-fluid bg-dark-trans ps-4 pt-1 pe-4 h-100">

            <p class="text-light fw-light fs-3 mt-2">Jardín de Infancia | "José Antonio Páez"</p>

            <hr class="border">

            <p class="fw-light text-light display-2 w-75 mx-auto" style="font-family: Georgia, 'Times New Roman', Times, serif;">Sembrando Semillas de Futuro</p>

            <br>

        </div>
        
        <div class="d-flex container-fluid bg-dark-trans p-4 h-100">

            <div class="d-block  w-50 align-items-center bg-dark-trans ps-4 pt-4 pe-4 my-auto text-light">

                <div class="d-block">
                    <h2>Nuestra Misión</h2>
                    <hr>
                    <p class="text-justify">
                        <strong>
                            Favorecer las potencialidades de los niños y las niñas; orientados en el
                            respeto a la condición humana, desde una perspectiva social como actores activos
                            de sus experiencias, en relación a lo sociocultural y en equilibrio con los elementos
                            de afectividad e inteligencia, iniciando la formación integral de los niños y las niñas.
                        </strong>
                    </p>
                </div>

            </div>

            <div class="w-50 h-100 d-flex align-items-center justify-content-center">
                <img src="img/logoP.png" alt="" style="width: 40vh; height:40vh; filter:drop-shadow(0px 0px 10px white);">
            </div>

            <div class="d-block  w-50 align-items-center bg-dark-trans ps-4 pt-4 pe-4 my-auto rounded text-light">
                <div class="d-block">
                    <h2>Nuestra Visión</h2>
                    <hr>
                    <p>
                        <strong>
                            Consiste en rescatar, mantener, promocionar y perpetuar los derechos de
                            los niños y niñas; fundamentalmente aquellos que se refieren a su formación integral
                            y asistida dada su condición de seres humanos, y a lograr su pleno desarrollo físico,
                            mental, espiritual y afectivo asegurándonos de que crezcan como seres
                            concientizados de los valores familiares, morales y sociales.
                        </strong>
                    </p>
                </div>
            </div>

        </div>
    </div>

<br><br>

    <div id="body2" class="margin-left vh-100" style="border-radius:20px;">
        <div class="text-center rounded container-fluid ps-4 pt-1 pe-4">

            <p class="text-light fw-light fs-1 mt-2">¿Porque Elegirnos?</p>
            <hr class="border border-primary border-2 w-75 mx-auto">
            <hr class="border border-primary border-2 w-25 mx-auto">
            <br>

        </div>

        <div class="rounded mx-auto" style="width: 85%;">
            
            <div id="CarruselDeImagenes" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <div class="text-center carousel-item active" data-bs-interval="4000">
                        <img  src="img/galeria-1.jpg" class="img-fluid w-100 rounded" style="height: 80vh;">
                        <div class="carousel-caption bg-dark-trans rounded mx-auto p-5 text-center w-100">
                            <h1 class="fw-lighter display-1">Experiencia y Trayectoria</h1>
                            <div>
                                <h3 class="fw-light opacity-75 py-3">
                                    Con años de experiencia en la educación infantil, en el jardín de infancia José Antonio Páez contamos con una
                                    sólida reputación de excelencia en la formación de los más pequeños.
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="text-center carousel-item" data-bs-interval="4000">
                        <img src="img/galeria-2.jpg" class="img-fluid w-100 rounded" style="height: 80vh;">
                        <div class="carousel-caption bg-dark-trans rounded mx-auto p-5 text-center w-100">
                            <h1 class="fw-lighter display-1">Enfoque Integral</h1>
                            <div>
                                <h3 class="fw-light opacity-75 py-3">
                                    Nos centramos en el desarrollo emocional, social y académico de los niños, ofreciendo una educación equilibrada que fomenta 
                                    habilidades esenciales desde una edad temprana.
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="text-center carousel-item" data-bs-interval="4000">
                        <img src="img/galeria-3.jpg" class="img-fluid w-100 rounded" style="height: 80vh;">
                        <div class="carousel-caption bg-dark-trans rounded mx-auto p-5 text-center w-100">
                            <h1 class="fw-lighter display-1">Actividades Extracurriculares</h1>
                            <div>
                                <h3 class="fw-light opacity-75 py-3">
                                    Ofrece una variedad de actividades extracurriculares que enriquecen el aprendizaje y permiten a
                                    los niños explorar sus intereses y talentos.
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon p-4" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-4" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>

        </div>
    </div>

<br><br>

    <div id="body1" class="margin-left me-3">
        <div class="">
            <div class="text-center rounded container-fluid ps-4 pt-1 pe-4 h-100">

                <p class="text-light fw-light fs-1 mt-2">Conoce a Nuestro Equipo</p>
                <hr class="border border-primary border-2 w-75 mx-auto">
                <hr class="border border-primary border-2 w-25 mx-auto">
                <br>

            </div>

            <div class="container row mx-auto">

                <div class="d-block bg-footer col-3 w-25 mx-5 h-100 p-2 my-3 rounded">
                    <img src="img/equipo/Ejemplo.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-light fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. Flor Maldonado</p>
                    <p class="text-light fw-light">Directora</p>
                </div>

                <div class="d-block bg-footer col-3 w-25 mx-5 h-100 p-2 my-3 rounded">
                    <img src="img/equipo/Ejemplo3.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-light fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-light fw-light">Cargo de Prueba</p>
                </div>

                <div class="d-block bg-footer col-3 w-25 mx-5 h-100 p-2 my-3 rounded">
                    <img src="img/equipo/Ejemplo4.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-light fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-light fw-light">Cargo de Prueba</p>
                </div>

                <div class="d-block bg-footer col-3 w-25 mx-5 h-100 p-2 my-3 rounded">
                    <img src="img/equipo/Ejemplo5.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-light fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-light fw-light">Cargo de Prueba</p>
                </div>

            </div>
        </div>

        <div id="contacto" class="text-center rounded container-fluid ps-4 pt-1 pe-4 h-100">
            
            <br>
            <p class="text-light fw-light fs-1 mt-2">Contáctanos</p>
            <hr class="border border-primary border-2 w-75 mx-auto">
            <hr class="border border-primary border-2 w-25 mx-auto">
            <br>

            <div class="bg-footer rounded p-3 w-50 mx-auto">
                <div class="container">
                    
                    <form action="dataBase/mensaje.php" method="post">
                        <div class="d-flex mb-2 ">
                            <div class="form-floating w-50 mx-1">
                                <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="nombre">
                                <label>Nombre y Apellido</label>
                            </div>
                            <div class="form-floating w-50 mx-1">
                                <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="correo">
                                <label>(Correo, Teléfono o WhatsApp)</label>
                            </div>
                        </div>    
                        
                        <div class="form-floating mb-2 mx-1">
                            <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="asunto">
                            <label>Asunto</label>
                        </div>

                        <div class="mb-2 mx-1">
                            <textarea type="text" placeholder="Mensaje" rows="4" class="form-control border-2 border-primary" required name="mensaje"></textarea>
                        </div>

                        <button type="submit" class="mt-2 btn btn-primary border-2">Enviar Mensaje</button>
                    </form>
                
                </div>
            </div>

        </div>
    </div>

<br><br><br>

    <?php include("footer.html"); ?>

    <script src="js/sweetalert2.js"></script>
    <script src="js/js.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>

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

    <!-- Alert mensaje enviado -->
    <?php if(!empty($mensaje_env)){ ?> 
        <script>
            window.onload = function(){
                swal.fire({
                    title : "¡Mensaje Enviado!",
                    icon : "success",
                    timer : "1800",
                    showConfirmButton : false
                });
            }
        </script>
    <?php  } ?>
     
</body>
</html>