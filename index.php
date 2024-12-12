<?php
    $mensaje_env ='';

    if (isset($_SESSION['mensaje-enviado'])) {
        $mensaje_env = $_SESSION['mensaje-enviado'];
        unset($_SESSION['mensaje-enviado']);
    }
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
    <nav id="nav" class="navbar navbar-expand-lg fixed-top">
        
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
                    <a href="admin.php" class="fw-light mx-3 btn btn-outline-primary border-2">Admin</a>
                </div>
            </div>
        </div>
    </nav>
    
    <section id="hero" class="vh-100 h-100" style="background-image: url(img/hero.png); 
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

            <div class="d-flex w-100 justify-content-center container" style="height:62.8%;">
                <span class="mx-5">
                    <img src="img\niña-de-preescolar-aprendiendo.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid h-100" alt="">
                </span>

                <img src="img\un-niño-de-preescolar-saludando.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid mx-5" alt="">

                <span class="mx-5">
                    <img src="img\niño-de-preescolar-jugando.png" style="filter: drop-shadow(0px 0px 10px white); " class="img-fluid h-100" alt="">
                </span>
            </div>

        </div>

        

    </section>

    <section id="sobre_nosotros" class="pt-5 mx-3">

        <div class="text-center px-4 mt-2 pt-1">

            <p class="text-dark fw-light fs-1 mt-2">Sobre Nosotros</p>
            
            
            <br>

        </div>
        
        <div class="p-0 m-0" style="background-attachment:fixed;
                    background-image: url(img/bienvenido.jpg); 
                    background-size:cover; 
                    background-repeat:no-repeat;">

            <div class="row justify-content-center bg-dark-trans">

                <div class="col-lg-3 col-md-9 align-items-center bg-dark-trans ps-4 pt-4 pe-4 rounded text-light mx-5 my-2">

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

                <div class="col-lg-3 col-md-9 align-items-center bg-dark-trans ps-4 pt-4 pe-4 rounded text-light mx-5 my-2">

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
                                    Sección "F"
                                    </strong>
                                </p>
                                <p>
                                    <strong>
                                    Sección "G"
                                    </strong>
                                </p>
                                <p>
                                    <strong>
                                    Sección "H"
                                    </strong>
                                </p>
                            </div>

                            <hr class="vr">

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
                                    Sección "C"
                                    </strong>
                                </p>
                                <p>
                                    <strong>
                                    Sección "D"
                                    </strong>
                                </p>    
                            </div>

                        </div>
                        
                    </div>

                </div>

                <div class="col-lg-3 col-md-9 align-items-center bg-dark-trans ps-4 pt-4 pe-4 rounded text-light mx-5 my-2">

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

        </div>
    </section>

    <section id="eligenos" class="vh-100 pt-5 rounded">

        <div class="text-center rounded container-fluid ps-4 pt-1 pe-4">

            <p class="text-dark fw-light fs-1 mt-2">¿Porque Elegirnos?</p>
            
            
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
    </section>

    <section id="equipo" class="pt-5">
        <div class="my-4">
            <div class="text-center rounded container-fluid ps-4 pt-1 pe-4 h-100">

                <p class="text-dark fw-light fs-1 mt-2">Conoce a Nuestro Equipo</p>
                
                
                <br>

            </div>

            <div class="container row row-cols-md-1 mx-auto justify-content-center">

                <div class="col-md-3 col-sm-7 col-9 shadow border-top my-3 mx-5 rounded">
                    <img src="img/equipo/Ejemplo.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-dark fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. Flor Maldonado</p>
                    <p class="text-dark fw-light">Directora</p>
                </div>

                <div class="col-md-3 col-sm-7 col-9 shadow border-top my-3 mx-5 rounded">
                    <img src="img/equipo/Ejemplo3.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-dark fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-dark fw-light">Cargo de Prueba</p>
                </div>

                <div class="col-md-3 col-sm-7 col-9 shadow border-top my-3 mx-5 rounded">
                    <img src="img/equipo/Ejemplo4.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-dark fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-dark fw-light">Cargo de Prueba</p>
                </div>

                <div class="col-md-3 col-sm-7 col-9 shadow border-top my-3 mx-5 rounded">
                    <img src="img/equipo/Ejemplo5.png" class="img-fluid w-100" style="height: 280px;">
                    <p class="text-dark fw-bolt mb-0 fs-5 pt-2 border-top border-2 border-primary">Lcda. de Ejemplo</p>
                    <p class="text-dark fw-light">Cargo de Prueba</p>
                </div>

            </div>
        </div>
    </section>

    <section id="contacto" class="text-center rounded container-fluid ps-4 pt-5 pe-4">
        
        <br>
        <p class="text-dark fw-light pt-1 fs-1 mt-2">Contáctanos</p>
        
        
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
                            
                            <div class="col-md-6 form-floating">
                                <input type="text" placeholder="nombre" class="form-control border-2 border-primary" required name="correo">
                                <label>(Correo, Teléfono o WhatsApp)</label>
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

    </section>

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

    <script> // Script para añadir o remover fondo al hacer scroll 
        window.addEventListener('scroll', function() { 
            var navbar = document.getElementById('nav'); 
            if (window.scrollY > 0) { 
                navbar.classList.add('bg-black', 'shadow-blue', 'border-bottom', 'border-primary', 'border-2'); 
            } else { 
            navbar.classList.remove('bg-black', 'shadow-blue', 'border-bottom', 'border-primary', 'border-2'); 
            } 
        }); 
    </script>

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