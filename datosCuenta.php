<?php
    include('dataBase/conn.php');
    
    session_start();

    $mensaje="";
    $mensajeEliminar="";
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
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
    <title>Cuenta de Usuario</title>
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
                <h1 class="fs-3 text-light fw-light"><img src="icons/user.svg"  style="width: 40px; height:40px"> | <?php echo $userDate['nombre'] . ' ' . $userDate['apellido'] ; ?></h1>  
                <label class="d-none d-sm-flex fs-3 text-light fw-light"><?php echo $userDate['usertype']; ?> |</label>
            </div>

            <hr class="border">

            <div class="d-sm-flex px-md-5 justify-content-center">
            
                <div class="mx-auto mod-hover my-3 ps-md-5">
                    <a class="justify-content-center text-center dropdown-item rounded d-md-flex align-items-center py-2 px-3" href="#">
                        <img src="icons/tarjeta-personal.svg" style="width: 70px; height:70px;">
                        <h5 class="ps-sm-4 fw-light py-2"> | Información Personal</h5>
                    </a>
                </div>

                <div class="mx-auto mod-hover my-3 pe-md-5">
                    <a class="justify-content-center text-center dropdown-item rounded d-md-flex align-items-center py-2 px-3" href="#">
                        <img src="icons/escudo.svg" style="width: 70px; height:70px;">
                        <h5 class="ps-sm-4 fw-light py-2">| Seguridad de la Cuenta</h5>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <div id="body1" class="shadow margin-left-width"></div>
    <div id="body2" class="shadow margin-left-width"></div>

    <?php include("footer.html"); ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>
</body>
</html>