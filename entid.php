
<?php
    session_start();

    $mensaje="";
    $mensajeEliminar="";

    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }

    $pagAct = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entidades</title>
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

    <div id="body" class="shadow margin-left-width " style="border-radius: 10px; background-image : url(img/img3.jpg); background-size : cover">
   
        <div class="container-fluid text-center rounded bg-dark-trans align-items-center h-100">
            
            <br>

            <div>
                <h1 class="display-6 text-light">Entidades</h1>
            </div>

            <div class="container d-md-flex justify-content-center pt-5 border-1 border border-start-0 border-end-0 border-bottom-0">

                <div class="items-hover mx-auto bg-trans-items">
                    <a class="dropdown-item d-md-flex align-items-center justify-content-between py-2 px-3" href="entidAlmn.php">
                        <h3 class="pe-md-4">Alumnos |</h3>
                        <img src="icons/graduacion.svg"  style="width: 70px; height:70px">
                    </a>
                </div>

                <hr class="vr shadow" style="color: white;">

                <div class="items-hover mx-auto bg-trans-items">
                    <a class="dropdown-item d-md-flex align-items-center justify-content-between py-2 px-3" href="entidDoc.php">
                        <h3 class="pe-md-4">Docentes |</h3>
                        <img src="icons/pizzarron-user.svg"  style="width: 70px; height:70px">
                    </a>
                </div>
<!-- 
                <hr class="vr shadow" style="color: white;">

                <div class="items-hover mx-auto bg-trans-items">
                    <a class="dropdown-item d-md-flex align-items-center justify-content-between py-2 px-3" href="entidPers.php">
                        <h3 class="pe-md-4">Personal |</h3>
                        <img src="icons/personal.svg"  style="width: 70px; height:70px">
                    </a>
                </div> -->

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
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>
</body>
</html>