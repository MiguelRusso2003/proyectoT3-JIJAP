
<?php
    session_start();

    $mensaje="";
    $mensajeEliminar="";

    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    $pagAct = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Nacionales</title>
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

    <div id="body" class="shadow margin-left-width" style="border-radius: 10px; background-image: url(img/bandera.jpg); background-size:cover;">
   
        <div class="container-fluid text-center bg-dark-trans rounded align-items-center h-100">
            
            <br>

            <div>
                <h1 class="display-6 text-light">Bienes Nacionales</h1>
            </div>

            <div class="container d-md-flex justify-content-center mt-2 pt-5 border-1 border-top">

                <div class="items-hover mx-auto bg-trans-items">
                    <a class="dropdown-item d-md-flex align-items-center justify-content-md-between py-2 px-3" href="bnsMbls.php">
                        <h3 class="pe-md-4">Bienes Muebles |</h3>
                        <img src="icons/mueble.svg"  style="width: 70px; height:70px">
                    </a>
                </div>

                <hr class="vr shadow" style="color: white;">

                <div class="items-hover mx-auto bg-trans-items">
                    <a class="dropdown-item d-md-flex align-items-center justify-content-md-between py-2 px-3" href="bnsMtls.php">
                        <img src="icons/herramientas.svg"  style="width: 70px; height:70px">
                        <h3 class="ps-md-4"> | Bienes Materiales</h3>
                    </a>
                </div>
                
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
    <script>
        let table = new DataTable("#myTable");
    </script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>
</body>
</html>