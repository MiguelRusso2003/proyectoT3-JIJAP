<?php
    session_start();

    $bienvenido = '';

    if (isset($_SESSION['bienvenido'])) {
        $bienvenido = $_SESSION['bienvenido'];
        unset($_SESSION['bienvenido']);
    }
    $mensaje = "";

    if (isset($_SESSION['mensaje'])) {
        $mensaje = $_SESSION['mensaje'];
    }else {
        header('location:login.php');
    }

    $pagAct = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
</head>
<body class="bg-dark">

    <?php include('menuDes.html'); ?>

    <br><br><br>
    
    <div id="body" class="rounded margin-left">
    
        <div class="text-center rounded container-fluid ps-4 pt-1 pe-4 h-100">

            <p class="text-light fw-light fs-3 mt-5">Jardín de Infancia | "José Antonio Páez"</p>

            <hr class="border">

            <p class="fw-light text-light display-2 w-50 mx-auto" style="font-family: Georgia, 'Times New Roman', Times, serif;">Sembrando Semillas de Futuro</p>

            <br>

        </div>
        
        <div class="d-flex container-fluid ps-4 pt-4 pe-4 h-100">

            <div class="d-block  w-50 align-items-center bg-dark-trans ps-4 pt-4 pe-4 my-auto rounded text-light">

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
                <img src="img/logoP.png" alt="" style="width: 50vh; height:50vh; filter:drop-shadow(0px 0px 10px white);">
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

    <div id="body1" class="margin-left">
    </div>

<br><br><br><br>

    <div id="body2" class="margin-left" style="border-radius:20px; height:80vh;">
    
        <div class="rounded p-3">
            
            <div id="CarruselDeImagenes" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="text-center carousel-item active" data-bs-interval="4000">
                        <img  src="img/galeria-1.jpg" class="img-fluid w-100 rounded opacity-50" style="height: 80vh;" alt="..." >
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
                        <img src="img/galeria-2.jpg" class="img-fluid w-100 rounded opacity-50" style="height: 80vh;" alt="..." >
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
                        <img src="img/galeria-3.jpg" class="img-fluid w-100 rounded opacity-50" style="height: 80vh;" alt="..." >
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
                    <span class="carousel-control-prev-icon p-4 btn btn-primary" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#CarruselDeImagenes" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-4 btn btn-primary" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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
</body>
</html>