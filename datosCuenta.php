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
    
    <div id="body" class="rounded margin-left">
   
        <div class=" container bg-footer rounded">

            <br>
            
            <div class="d-flex container-fluid justify-content-between align-items-center px-3">
                <h1 class="display-6 text-light fw-light"><img src="icons/user.svg"  style="width: 60px; height:60px"> | <?php echo $userDate['nombre'] . ' ' . $userDate['apellido'] ; ?></h1>  
                <label class="display-6 text-light fw-light d-flex"><?php echo $userDate['usertype']; ?> |</label>
            </div>

            <hr class="border"><br>

            <div class="container d-flex px-5 justify-content-center">
            
                <div class="mx-auto mod-hover ps-5">
                    <a class="dropdown-item rounded d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="#">
                        <img src="icons/tarjeta-personal.svg"  style="width: 70px; height:70px;">
                        <h5 class="ps-4 fw-light"> | Información Personal</h5>
                    </a>
                </div>

                <hr class="vr border">

                <div class="mx-auto mod-hover pe-5">
                    <a class="dropdown-item rounded d-flex align-items-center justify-content-between pb-2 pt-2 ps-3 pe-3" href="#">
                        <img src="icons/escudo.svg"  style="width: 70px; height:70px">
                        <h5 class="ps-4 fw-light">| Seguridad de la Cuenta</h5>
                    </a>
                </div>

            </div>

            <br><br>

        </div>

    </div>

    <div id="body1" class="shadow margin-left"></div>
    <div id="body2" class="shadow margin-left"></div>

    <?php include("footer.html"); ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>
</body>
</html>