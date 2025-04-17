<?php
    include('dataBase/conn.php');
    session_start();
    $mensaje_env ='';

    if (isset($_SESSION['mensaje-enviado'])) {
        $mensaje_env = $_SESSION['mensaje-enviado'];
        unset($_SESSION['mensaje-enviado']);
    }

    $sqlDocentes = "SELECT * FROM docentes";
    $docentes = $conn->query($sqlDocentes);
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
<body class="">

    <!-- NavBar -->
    <nav id="nav" class="navbar navbar-expand-lg fixed-top gx-5">
        
        <a href="index.php" class="nav-link text-light d-flex dropdown-items ps-3 justify-content-start align-items-center" style="cursor: pointer;">
            <img src="img/logoP.png" style="width: 50px; height:50px;">
            <div class="d-block text-center ms-2">
                <p class="fs-5 ms-2 fw-light my-auto">J.I. "José Antonio Páez"</p>
            </div>
            
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        
        <div class="collapse navbar-collapse align-items-center justify-content-end" id="navbarNavDropdown">
            <div class="navbar-nav align-items-center">
                <div class="nav-item">
                    <a href="#hero" class="fw-light fs-5 mx-3" style="text-decoration: none;">Inicio</a>
                </div>
                <div class="nav-item">
                    <a href="#sobre_nosotros" class="fw-light fs-5 mx-3" style="text-decoration: none;">Sobre Nosotros</a>
                </div>
                <div class="nav-item">
                    <a href="#eligenos" class="fw-light fs-5 mx-3" style="text-decoration: none;">Elígenos</a>
                </div>
                <div class="nav-item">
                    <a href="#equipo" class="fw-light fs-5 mx-3" style="text-decoration: none;">Equipo</a>
                </div>
                <div class="nav-item">
                    <a href="#contacto" class="fw-light fs-5 mx-3" style="text-decoration: none;">Contáctanos</a>
                </div>
                <div class="nav-item">
                    <a href="admin.php" class="fw-light mx-3 my-2 btn btn-outline-primary border-2">Admin</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- inicio -->
    <section id="hero" class="vh-100 h-100" style="background-image: url(img/hero-2.png); 
                                         background-size:cover; 
                                         background-repeat:no-repeat;">
    
        <div class="text-center bg-dark-trans ps-4 pt-1 pe-4 h-100">

            <br><br>

            <hr class="border my-4"><br>
            <div class="row">
                <p class="col-lg-12 fw-light text-light display-6 mx-auto" style="font-family: Georgia, 'Times New Roman', Times, serif;">Jardín de Infancia</p>
                <p class="col-lg-12 fw-light text-light display-6 mx-auto" style="font-family: Georgia, 'Times New Roman', Times, serif;">| "José Antonio Páez" |</p>
            </div>
    
            <br>

            <div class="d-flex w-100 justify-content-center container" style="height:62%;">
                <span class="mx-5">
                    <img src="img\niña-de-preescolar-aprendiendo.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid h-100" alt="">
                </span>

                <img src="img\un-niño-de-preescolar-saludando-2.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid mx-5" alt="">

                <span class="mx-5">
                    <img src="img\niño-de-preescolar-jugando.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid h-100" alt="">
                </span>
            </div>

        </div>

    </section>

    <!-- informacion acerca de la institucion  -->
    <section id="sobre_nosotros" class="my-md-5 pt-md-0 pt-2 my-2 mx-3">

        <div class="text-center px-4 mt-2 pt-1">

            <p class="text-dark fw-light fs-1 mt-2">Sobre Nosotros</p>
            <div class="border-bottom w-50 border-3 border-primary mx-auto my-2"></div>
            <div class="border-bottom w-25 border-3 border-primary mx-auto"></div>

            <br>

        </div>
        
        <div class="row justify-content-center">

            <div class="col-lg-3 col-md-9 align-items-center ps-4 pt-4 pe-4 rounded text-black mx-5 my-2" style="background-color: #44c1ff2b;">

                <div class="d-block">
                    <h2 class="fw-light text-center">Nuestra Misión</h2>
                    <hr>
                    <p style="text-align: justify;">
                        <strong>
                            Favorecer las potencialidades de los niños y las niñas; orientados en el
                            respeto a la condición humana, desde una perspectiva social como actores activos
                            de sus experiencias, en relación a lo sociocultural y en equilibrio con los elementos
                            de afectividad e inteligencia, iniciando la formación integral de los niños y las niñas.
                        </strong>
                    </p>
                </div>

            </div>

            <div class="col-lg-3 col-md-9 align-items-center ps-4 pt-4 pe-4 rounded text-black mx-5 my-2" style="background-color: #44c1ff2b;">

                <div class="d-block">
                    <h2 class="fw-light text-center">Módulos</h2>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <div class="d-block mx-2">
                            <p>
                                <strong>
                                    | Módulo IV:
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "D"
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "E"
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "F"
                                </strong>
                            </p>
                        </div>

                        <hr class="vr mx-3">

                        <div class="d-block mx-2">
                            <p>
                                <strong>
                                    | Módulo V:
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "A"
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "B"
                                </strong>
                            </p>
                            <p>
                                <strong>
                                Sección "C"
                                </strong>
                            </p>    
                        </div>

                    </div>
                    
                </div>

            </div>

            <div class="col-lg-3 col-md-9 align-items-center ps-4 pt-4 pe-4 rounded text-black mx-5 my-2" style="background-color: #44c1ff2b;">

                <div class="d-block">
                    <h2 class="fw-light text-center">Nuestra Visión</h2>
                    <hr>
                    <p style="text-align: justify;">
                        <strong>
                            Consiste en rescatar, mantener, promocionar y perpetuar los derechos de
                            los niños y niñas; fundamentalmente aquellos que se refieren a su formación integral
                            y asistida dada su condición de seres humanos, y a lograr su pleno desarrollo físico,
                            mental, espiritual y afectivo asegurándonos de que crezcan como seres
                            concientizados.
                        </strong>
                    </p>
                </div>
                
            </div>

        </div>
    </section>

    <!-- seccion mensaje lema o de reflexion -->
    <section class="pt-2 mt-2">
        <div class="my-3"></div>
            <div class="p-0 m-0 h-100" style="background-attachment:fixed;
                                              background-image: url(img/fondo.jpg); 
                                              background-size:cover; 
                                              background-repeat:no-repeat;">

                <div class="d-flex justify-content-center align-items-center px-2 bg-dark-trans" style="height: 40vh;">
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <p class="fs-1 fw-light text-light">No intentes ser el mejor de tu equipo, intenta que tu equipo sea el MEJOR.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer fs-5">
                            <cite class="text-primary"> Brian Tracy y Allen Iverson.</cite>
                        </figcaption>
                    </figure>
                </div>

            </div>
        <div class="my-3"></div>
    </section>

    <!-- seccion cualidades de la institucion -->
    <section id="eligenos" class="pt-1 mt-1 pt-md-4 mt-md-4 rounded">

        <div class="text-center rounded container-fluid ps-4 pt-1 pe-4">

            <p class="text-dark fw-light fs-1 mt-2">¿Porque Elegirnos?</p>
            <div class="border-bottom w-50 border-3 border-primary mx-auto my-2"></div>
            <div class="border-bottom w-25 border-3 border-primary mx-auto"></div>
            
            <br>

        </div>

        <div class="container row mt-3 mt-md-5 mx-auto justify-content-center">

            <div class="col-md-4 col-sm-6 col-12 px-2 px-md-5 mb-4 mb-md-0 item-eligenos">
                <div class="rounded-circle p-3 mx-auto shadow d-flex justify-content-center align-items-center" style="width: 110px; height:110px">
                    <img src="icons/experiencia.svg" style="width: 70px; height:70px">
                </div>
                <p class="text-dark text-center fw-bolt mb-0 fs-5 pt-2">Experiencia y Trayectoria</p>
                <div class="border-bottom border-2 border-primary w-hr mx-auto my-2"></div>
                <p class="text-dark fw-light text-center hover-bg p-2">
                    Con años de experiencia en la educación infantil, en el jardín de infancia José Antonio Páez contamos con una
                    sólida reputación de excelencia en la formación de los más pequeños.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-12 px-2 px-md-5 mb-4 mb-md-0 item-eligenos">
                <div class="rounded-circle p-3 mx-auto shadow d-flex justify-content-center align-items-center" style="width: 110px; height:110px">
                    <img src="icons/enfoque.svg" style="width: 70px; height:70px">
                </div>
                <p class="text-dark text-center fw-bolt mb-0 fs-5 pt-2">Enfoque Integral</p>
                <div class="border-bottom border-2 border-primary w-hr mx-auto my-2"></div>
                <p class="text-dark fw-light text-center hover-bg p-2">
                    Nos centramos en el desarrollo emocional, social y académico de los niños, ofreciendo una educación equilibrada que fomenta
                    habilidades esenciales desde una edad temprana.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-12 px-2 px-md-5 mb-md-0 item-eligenos">
                <div class="rounded-circle p-3 mx-auto shadow d-flex justify-content-center align-items-center" style="width: 110px; height:110px">
                    <img src="icons/actividad.svg" style="width: 70px; height:70px">
                </div>
                <p class="text-dark text-center fw-bolt mb-0 fs-5 pt-2">Actividades Extracurriculares</p>
                <div class="border-bottom border-2 border-primary w-hr mx-auto my-2"></div>
                <p class="text-dark fw-light text-center hover-bg p-2">
                    Ofrecemos una variedad de actividades extracurriculares que enriquecen el aprendizaje y permiten a
                    los niños explorar sus intereses y talentos.
                </p>
            </div>

        </div>
    </section>

    <!-- seccion equipo de docentes -->
    <section id="equipo" class="pt-1 mt-1 pt-md-3 mt-md-3">
        <div class="my-3">
            <div class="text-center rounded container-fluid ps-4 pt-1 pe-4 h-100">

                <p class="text-dark fw-light fs-1 mt-2">Conoce a Nuestro Equipo</p>
                <div class="border-bottom w-50 border-3 border-primary mx-auto my-2"></div>
                <div class="border-bottom w-25 border-3 border-primary mx-auto"></div>
                
                <br>

            </div>

            <div class="row row-cols-md-1 mx-auto mt-5 justify-content-center">

            <?php foreach ($docentes as $docente) { ?>

                <div class="mx-3 col-sm-7 col-9 shadow border-top my-3 rounded" style="width:250px">
                    <img src="<?= $docente['foto'] ?>" class="img-fluid" style="height: 250px; width:250px; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    <p class="text-dark px-2 fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary"><?= $docente['nombre'].' '.$docente['apellido'] ?></p>
                    <p class="text-dark px-2 fw-light"><?= $docente['areaForm'] ?></p>
                </div>

            <?php } ?>

            </div>
        </div>
    </section>

    <!-- seccion contactos -->
    <section id="contacto" class="text-center rounded container-fluid px-2 px-md-5 pt-1 mt-1 pt-md-4 mt-md-4">
        <div class="my-4">
            <br>
            <p class="text-dark fw-light pt-1 fs-1 mt-2">Contáctanos</p>
            <div class="border-bottom w-50 border-3 border-primary mx-auto my-2"></div>
            <div class="border-bottom w-25 border-3 border-primary mx-auto"></div>
            
            <br>

            <div class="bg-footer rounded p-3 mx-auto">
                    
                <form action="dataBase/mensaje.php" method="post">
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="row g-2 justify-content-center">
                                <div class="col-md-6 form-floating">
                                    <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="nombre">
                                    <label>Nombre y Apellido</label>
                                </div>

                                <input type="text" class="visually-hidden" name="apellido">
                                
                                <div class="col-md-6 form-floating">
                                    <input type="email" placeholder="nombre" class="form-control border-2 border-primary" required name="correo">
                                    <label>Correo Electrónico</label>
                                </div>
                                
                                <div class="col-md-12 form-floating control-group">
                                    <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="asunto">
                                    <label>Asunto</label>
                                </div>

                                <div class="col-md-12">
                                    <textarea type="text" placeholder="Mensaje" rows="6" class="form-control border-2 border-primary" required name="mensaje"></textarea>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 btn btn-primary border-2">Enviar Mensaje</button>

                </form>

            </div>
        </div>

    </section>

    <!-- footer -->
    <div class="d-flex justify-content-center w-100 mt-4">
        <p><a href="#"><img src="icons/chevron-double-up.svg" class="fa-bounce" width="50" height="50"></a></p>
    </div>
    <footer class="d-flex border-top border-2 border-primary flex-wrap container-fluid align-items-center justify-content-center py-3 bg-black">
        <div class="w-100">
            <ul class="nav list-unstyled d-flex justify-content-center w-100 container">
                <li>
                    <a class="text-light px-3" style="cursor: pointer;" onclick="correo()">
                        <img src="icons/correo.svg" style="width:40px; height:40px;">
                    </a>
                </li>
                <li>
                    <a class="text-light px-3" style="cursor: pointer;" onclick="ubicacion()">
                        <img src="icons/location.svg" style="width:40px; height:40px;">
                    </a>
                </li>
                <li>
                    <a class="text-light px-3" style="cursor: pointer;" onclick="phone()">
                        <img src="icons/phone.svg" style="width:40px; height:40px;">
                    </a>
                </li>
            </ul>
            <hr class="border border-primary">
            <div class="row container">
                <span class="mb-3 col-12 d-flex justify-content-center text-light mb-md-0">© 2024-25. Todos los derechos Reservados . Jardín de Infancia "José Antonio Páez" - Vilchez, Portillo, Nuñez y Pulgar.</span>
            </div>
        </div>
    </footer>

    <script src="js/sweetalert2.js"></script>
    <script src="js/js.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    
    <!-- Script para añadir estilos al ubicarse en ciertas secciones de la pagina por el id -->
    <script>
        let sections = document.querySelectorAll('section');
        let navLinks = document.querySelectorAll('nav a');
        window.onscroll = () => {
            sections.forEach(sec => {
                let top = window.scrollY;
                let offset = sec.offsetTop - 150;
                let height = sec.offsetHeight;
                let id = sec.getAttribute('id');
                if(top >= offset && top < offset + height) {
                    navLinks.forEach(links => {
                        links.classList.remove('shadowActive3');
                        document.querySelector('nav a[href*=' + id + ']').classList.add('shadowActive3');
                    });
                };
            });
        };
    </script>
    
    <!-- Script para añadir o remover estilos al hacer scroll  -->
    <script>
        window.addEventListener('scroll', function() { 
            var navbar = document.getElementById('nav'); 
            if (window.scrollY > 1) { 
                navbar.classList.add('bg-scroll', 'shadow-blue', 'border-bottom', 'border-primary', 'border-2'); 
            } else { 
                navbar.classList.remove('bg-scroll', 'shadow-blue', 'border-bottom', 'border-primary', 'border-2'); 
            } 
        }); 
    </script>

    <!-- Alert mensaje enviado -->
    <?php if(!empty($mensaje_env)){ ?> 
        <script>
            window.onload = function(){
                swal.fire({
                    title : "¡Mensaje Enviado!",
                    icon : "success"
                });
            }
        </script>
    <?php  } ?>
     
</body>
</html>
