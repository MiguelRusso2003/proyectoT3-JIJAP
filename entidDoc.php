<?php
    include("dataBase/conn.php");

    $pagAct = basename($_SERVER['PHP_SELF']);
    
    session_start();

    $mensaje="";
    $mensajeEliminar="";
    $mensajeEdit="";
    $mensajeRegistro="";
    $idEdit ="";
    $mensajeSeccion='';
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION['mensaje-eliminar'])) {
        $mensajeEliminar = "verdadero";
        unset($_SESSION['mensaje-eliminar']);
    }

    if (isset($_SESSION['mensaje-seccion'])) {
        $mensajeSeccion = $_SESSION['mensaje-seccion'];
        unset($_SESSION['mensaje-seccion']);
    }

    if (isset($_SESSION["mensaje-editar"])) {
        $mensajeEdit = "verdadero";
        unset($_SESSION['mensaje-editar']);
    }

    if (isset($_SESSION['mensaje-registro'])) {
        $mensajeRegistro = "verdadero";
        unset($_SESSION['mensaje-registro']);
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }

    if (isset($_POST['editar'])) {
        $idEdit = $_POST["id"];

        $sqlEdit = "SELECT * FROM docentes WHERE id = :id";
        $ejecutarSql = $conn -> prepare($sqlEdit);
        $ejecutarSql -> bindParam(':id', $idEdit);
        $ejecutarSql -> execute();

        $datosEdit = $ejecutarSql -> fetch(PDO::FETCH_ASSOC); 
    }

    $sql = "SELECT * FROM docentes";
    $resultado = $conn -> query($sql);

    function mesesServ($fechaIngre) {
        // 1. Verificar si la fecha de nacimiento es válida
        $fechaIngreObj = DateTime::createFromFormat('Y-m-d', $fechaIngre);
        if (!$fechaIngreObj) {
            return "Fecha de ingreso inválida";
        }
    
        // 2. Obtener la fecha actual
        $fechaActual = new DateTime();
    
        // 3. Calcular la diferencia entre las fechas
        $diferencia = $fechaIngreObj->diff($fechaActual);
    
        // 4. Calcular el número total de meses
        $meses = ($diferencia->y * 12) + $diferencia->m;
    
        return $meses;
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
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

    <div id="body" class="rounded margin-left-width" style="background-image:url(img/bg-docente2.jpg); background-size:cover;background-attachment: fixed; ">

        <div class="container-fluid bg-white-trans rounded">
            <div class="container">
                
                <br>

                <!-- header -->
                <div class="d-md-flex text-center justify-content-between align-items-center">
                    <div class="d-md-flex d-block">
                        <img src="icons/pizzarron-user.svg" style="width: 70px;"><hr class="d-md-none w-25 mx-auto border-primary border"><div class="vr mx-3 d-md-block d-none border-primary"></div>
                        <h1 class="display-5">Docentes </h1>
                    </div>
                    <form action="formBnMu.php" method="post">
                        <button type="button" class="btn btn-outline-success border-3 mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#modal_insertar">+ Nuevo Registro</button>
                    </form>
                </div>
                
                <hr>
                
                <!-- Tabla DataTable -->
                <div class="table-responsive-md">
                    <table id="myTable" class="display compact" style="width:90%">
                        
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Apellido</th>
                                <th class="text-start">Cédula</th>
                                <th class="text-start">Status</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php foreach ($resultado as $key) {?>
                            
                            <tr>
                                <td> <?php echo $key['nombre']; ?> </td>
                                <td class="text-start"> <?php echo $key['apellido']; ?> </td>
                                <td> <?php echo $key['cedula']; ?> </td>
                                <td class="text-center">
                                    <?php if($key['status'] === 'activo') { echo 'Activo(a) 🟢';} ?> 
                                    <?php if($key['status'] === 'reposo') { echo 'de Reposo 🟡';} ?> 
                                    <?php if($key['status'] === 'incapacitado') { echo 'Incapacitado(a) 🟠';} ?> 
                                    <?php if($key['status'] === 'renuncia') { echo 'Renuncia 🔴';} ?> 
                                    <?php if($key['status'] === 'proceso_jub') { echo 'Proceso de jubilación(a) 🟠';} ?> 
                                    <?php if($key['status'] === 'jubilado') { echo 'Jubilado(a) 🔵';} ?> 
                                </td>
                                <td style="background: none" class="d-flex">
                                    <div class="ms-1 me-1">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                            <button name="editar" type="submit" class="btn shadow btn-outline-primary border-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar">
                                                <img src="icons/editar.svg" style="width: 20px; height: 20px;">  
                                            </button>
                                        </form>
                                    </div>
                                    <div class="ms-1 me-1">
                                        <form action="dataBase/eliminarDoc.php" method="post" id="formDataDelete<?php echo $key['id'];?>">
                                            <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                            <button onclick="alertDelete('<?php echo $key['nombre'].' '.$key['apellido']; ?>', '<?php echo $key['id']; ?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar" class="btn shadow btn-outline-primary border-3">
                                                <img src="icons/delete.svg" style="width: 20px; height: 20px;">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="ms-1 me-1">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                                            <button onclick="modalVer('<?php echo $key['id'];?>')" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver Datos" class="btn shadow btn-outline-primary border-3">
                                                <img src="icons/lupa.svg" style="width: 20px; height: 20px;">
                                            </button>
                                        </form>
                                    </div>
                                </td> 
                            </tr>

                            <!-- Modal Ver -->
                            <div class="modal fade" id="modalVer<?php echo $key['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">

                                            <div class="d-md-flex">
                                                <div class="col-md-6">
                                                    <div class="col-md-6 mx-4 mx-md-auto d-flex justify-content-center align-items-center">
                                                        <img src="<?= $key['foto'] ?>" class="img-fluid rounded">
                                                    </div>
                                                    <p class="fw-light my-1 fs-4 text-center"><?= $key['nombre'].' '.$key['apellido'] ?></p>
                                                    <p class="fw-light fs-5 text-center">
                                                        <strong>
                                                            <?= $key['areaForm']?>
                                                        </strong> 
                                                        <?php if($key['status'] === 'activo') { echo '(Activo(a) 🟢)';} ?> 
                                                        <?php if($key['status'] === 'reposo') { echo '(de Reposo 🟡)';} ?> 
                                                        <?php if($key['status'] === 'incapacitado') { echo '(Incapacitado(a) 🟠)';} ?> 
                                                        <?php if($key['status'] === 'renuncia') { echo '(Renuncia 🔴)';} ?> 
                                                        <?php if($key['status'] === 'proceso_jub') { echo '(Proceso de Jubilación 🟠)';} ?> 
                                                        <?php if($key['status'] === 'jubilado') { echo '(Jubilado(a) 🔵)';} ?> 
                                                    </p>
                                                </div>

                                                <div class="container-fluid col-md-6">
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Cédula de identidad:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['cedula']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Número de Teléfono:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['telefono']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Correo Electrónico:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['correo']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Sección Asignada:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?= $key['seccion'] === '-' ? 'Administrativo' : $key['seccion'] ?>" disabled readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="d-md-flex">

                                                <div class="container-fluid col-md-6">
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Fecha de Nacimiento:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['fechaNac']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Fecha de Ingreso:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['fechaIngre']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Código de Dependencia:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['codDep']; ?>" disabled readonly>
                                                    </div>
                                                </div>

                                                <div class="container-fluid col-md-6">
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Grado de Instrucción:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['gdoInst']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Meses de Servicio:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?= mesesServ($key['fechaIngre']) ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Clasificación:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['clasif']; ?>" disabled readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="d-md-flex">
                                                <div class="mb-3 col-md-6 container">
                                                    <label class="text-black fw-light">Horas de Trabajo:</label>
                                                    <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['horas']; ?>" disabled readonly>
                                                </div>
                                                <div class="mb-3 col-md-6 container">
                                                    <label class="text-black fw-light">Matrícula:</label>
                                                    <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?= $key['matricula'];?>" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn border-2 btn-outline-primary" data-bs-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

                <!-- Modal Editar -->
                <?php if (!empty($idEdit)) : ?>
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR DATOS DOCENTE</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="dataBase/editDoc.php" enctype="multipart/form-data">

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="mb-4 mx-2 col-md-4 text-center">
                                                <img src="<?= $datosEdit["foto"] ?>" id="vista-previa" class="img-fluid rounded col-md-9 col-7 border border-2 border-info mb-1">
                                                <input onchange="mostrarVistaPrevia(event)" type="file" accept="image/*" multiple name="foto" id="inputFile" style="visibility: hidden; position:absolute" placeholder="usuario">
                                                <label class="btn btn-outline-info border-2 col-7" for="inputFile">Cambiar Foto</label>
                                            </div>

                                            <div class="justify-content-center mx-2 col-md-4">

                                                <div class="form-floating mb-4">
                                                    <input  value="<?php echo $datosEdit["nombre"] ; ?>" type="text" name="nombre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                    <label class="text-dark" for="floatingInput">Nombre</label>
                                                </div>

                                                <div class="form-floating mb-4">
                                                    <input value="<?php echo $datosEdit["apellido"] ; ?>" type="text" name="apellido" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                    <label class="text-dark">Apellido</label>
                                                </div>

                                                <div class="form-floating mb-4">
                                                    <input value="<?php echo $datosEdit["cedula"] ; ?>" type="text" name="cedula" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                    <label class="text-dark" for="floatingInput">Numero de Cédula</label>
                                                </div>

                                            </div>

                                            <div class="justify-content-center mx-2 col-md-4">

                                                <div class="form-floating mb-4">
                                                    <input value="<?php echo $datosEdit["fechaNac"] ; ?>" type="date" name="fechaNac" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                    <label class="text-dark" for="floatingInput">Fecha de Nacimiento</label>
                                                </div>

                                                <div class="form-floating mb-4">
                                                    <input value="<?php echo $datosEdit["correo"] ; ?>" type="email" name="correo" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                    <label class="text-dark">Correo Electrónico</label>
                                                </div>

                                                <div class="form-floating mb-4">
                                                    <input value="<?php echo $datosEdit["telefono"] ; ?>" type="text" name="telefono" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                    <label class="text-dark" for="floatingInput">Numero de Teléfono</label>
                                                </div>

                                            </div>
                                            
                                        </div>

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["fechaIngre"] ; ?>" type="date" name="fechaIngre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Fecha de Ingreso</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["codDep"] ; ?>" type="text" name="codDep" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Código de Dependencia</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["gdoInst"] ; ?>" type="text" name="gdoInst" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Grado de Instrucción</label>
                                            </div>
                                        
                                        </div>

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <select class="form-control me-1 border border-2 border-primary" name="seccion">
                                                    <option value="A" <?= 'A' === $datosEdit["seccion"] ? 'selected' : '' ?>>A</option>
                                                    <option value="B" <?= 'B' === $datosEdit["seccion"] ? 'selected' : '' ?>>B</option>
                                                    <option value="C" <?= 'C' === $datosEdit["seccion"] ? 'selected' : '' ?>>C</option>
                                                    <option value="D" <?= 'D' === $datosEdit["seccion"] ? 'selected' : '' ?>>D</option>
                                                    <option value="E" <?= 'E' === $datosEdit["seccion"] ? 'selected' : '' ?>>E</option>
                                                    <option value="F" <?= 'F' === $datosEdit["seccion"] ? 'selected' : '' ?>>F</option>
                                                    <option value="-" <?= '-' === $datosEdit["seccion"] ? 'selected' : '' ?>>Administrativo</option>
                                                </select>
                                                <label class="text-dark">Sección</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <select class="form-control me-1 border border-2 border-primary" name="clasif" required>
                                                    <option value="Doc/I" <?= $datosEdit['clasif'] === 'Doc/I' ? 'selected' : '' ?> >Doc/I</option>
                                                    <option value="Doc/II" <?= $datosEdit['clasif'] === 'Doc/II' ? 'selected' : '' ?> >Doc/II</option>
                                                    <option value="Doc/III" <?= $datosEdit['clasif'] === 'Doc/III' ? 'selected' : '' ?> >Doc/III</option>
                                                    <option value="Doc/IV" <?= $datosEdit['clasif'] === 'Doc/IV' ? 'selected' : '' ?> >Doc/IV</option>
                                                    <option value="Doc/V" <?= $datosEdit['clasif'] === 'Doc/V' ? 'selected' : '' ?> >Doc/V</option>
                                                    <option value="Doc/VI" <?= $datosEdit['clasif'] === 'Doc/VI' ? 'selected' : '' ?> >Doc/VI</option>
                                                </select>
                                                <label class="text-dark">Clasificación</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["horas"] ; ?>" type="text" name="horas" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Horas de Trabajo</label>
                                            </div>

                                        </div>

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <select class="form-control me-1 border border-2 border-primary" name="areaForm" required>
                                                    <option value="Director(a)" <?= 'Director(a)' === $datosEdit["areaForm"] ? 'selected' : '' ?>>Director(a)</option>
                                                    <option value="Docente de Aula" <?= 'Docente de Aula' === $datosEdit["areaForm"] ? 'selected' : '' ?>>Docente de Aula</option>
                                                    <option value="Deporte" <?= 'Deporte' === $datosEdit["areaForm"] ? 'selected' : '' ?>>Deporte</option>
                                                    <option value="Secretario(a)" <?= 'Secretario(a)' === $datosEdit["areaForm"] ? 'selected' : '' ?>>Secretario(a)</option>
                                                </select>
                                                <label class="text-dark">Area de Formación</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["matricula"] ; ?>" type="text" name="matricula" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Matrícula</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <select class="form-control me-1 border border-2 border-primary" name="status">
                                                    <option value="activo" <?= 'activo' === $datosEdit["status"] ? 'selected' : '' ?>>Activo(a)</option>
                                                    <option value="reposo" <?= 'reposo' === $datosEdit["status"] ? 'selected' : '' ?>>de Reposo</option>
                                                    <option value="incapacitado" <?= 'incapacitado' === $datosEdit["status"] ? 'selected' : '' ?>>Incapacitado(a)</option>
                                                    <option value="renuncia" <?= 'renuncia' === $datosEdit["status"] ? 'selected' : '' ?>>Renuncia</option>
                                                    <option value="proceso_jub" <?= 'proceso_jub' === $datosEdit["status"] ? 'selected' : '' ?>>en Proceso de jubilación</option>
                                                    <option value="jubilado" <?= 'jubilado' === $datosEdit["status"] ? 'selected' : '' ?>>Jubilado(a)</option>
                                                </select>
                                                <label class="text-dark">Status</label>
                                            </div>

                                        </div>
                                        
                                        <div class="modal-footer d-flex justify-content-center">
                                            <input type="hidden" name="id" value="<?= $datosEdit["id"] ?>">
                                            <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Guardar</button>
                                        </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Modal Insertar -->
                <div class="modal fade" id="modal_insertar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Docente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="dataBase/insertDoc.php" enctype="multipart/form-data">

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="nombre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Nombre</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="apellido" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Apellido</label>
                                        </div>

                                        <div class="d-flex mb-4 mx-2 col-md-4">
                                            <select class="w-25 form-control me-1 border border-2 border-primary" name="cod_cedula">
                                                <option value="V-">V-</option>
                                                <option value="E-">E-</option>
                                            </select>
                                            <div class="form-floating w-75">
                                                <input type="number" name="cedula" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Numero de Cédula</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="date" name="fechaNac" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Fecha de Nacimiento</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="email" name="correo" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Correo Electrónico</label>
                                        </div>

                                        <div class="d-flex mb-4 mx-2 col-md-4">
                                            <select class="w-25 form-control me-1 border border-2 border-primary" name="cod_telefono">
                                                <option value="0414-">0414-</option>
                                                <option value="0424-">0424-</option>
                                                <option value="0416-">0416-</option>
                                                <option value="0426-">0426-</option>
                                                <option value="0412-">0412-</option>
                                                <option value="0275-">0275-</option>
                                                <option value="0212-">0212-</option>
                                            </select>
                                            <div class="form-floating w-75">
                                                <input type="number" name="telefono" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Numero de Teléfono</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="date" name="fechaIngre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Fecha de Ingreso</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="codDep" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Código de Dependencia</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="gdoInst" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Grado de Instrucción</label>
                                        </div>
                                    
                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="seccion">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="-">Administrativo</option>
                                            </select>
                                            <label class="text-dark">Sección</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="clasif" required>
                                                <option value="Doc/I">Doc/I</option>
                                                <option value="Doc/II">Doc/II</option>
                                                <option value="Doc/III">Doc/III</option>
                                                <option value="Doc/IV">Doc/IV</option>
                                                <option value="Doc/V">Doc/V</option>
                                                <option value="Doc/VI">Doc/VI</option>
                                            </select>
                                            <label class="text-dark">Clasificación</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="status">
                                                <option value="activo">Activo(a)</option>
                                                <option value="reposo">de Reposo</option>
                                                <option value="incapacitado">Incapacitado(a)</option>
                                                <option value="renuncia">Renuncia</option>
                                                <option value="proceso_jub">en Proceso de jubilación</option>
                                                <option value="jubilado">Jubilado(a)</option>
                                            </select>
                                            <label class="text-dark">Status</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="horas" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Horas de Trabajo</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="areaForm" required>
                                                <option value="Director(a)">Director(a)</option>
                                                <option value="Docente de Aula">Docente de Aula</option>
                                                <option value="Deporte">Deporte</option>
                                                <option value="Secretario(a)">Secretario(a)</option>
                                            </select>
                                            <label class="text-dark">Area de Formación</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="matricula" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Matrícula</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="file" accept="image/*" multiple name="foto" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario">
                                            <label class="text-dark" for="floatingInput">Seleccionar Foto del Docente</label>
                                        </div>

                                    </div>
                                    
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-2 shadow border-2 btn-outline-success">Guardar</button>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                
            </div>
        </div>
    </div>
    
    <div id="body1" class="shadow margin-left-width"></div>
    <div id="body2" class="shadow margin-left-width"></div>

    <?php include("footer.html"); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable();
    </script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>

    <!-- Tooltips -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <!-- Modal Editar -->
    <script>
        window.onload = function verModal(){
            $('#modal').modal('show');
        }
    </script>

    <!-- Modal Ver -->
     <script>
        function modalVer(idModal) {
            $('#modalVer'+idModal).modal('show');
        }
     </script>

                <!-- Mensajes Presentes -->

    <!-- Eliminado -->
    <?php if (!empty($mensajeEliminar)) :?>
        <script>
            window.onload = function mensaje(){
                swal.fire({
                        title: "Registro Eliminado",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1300
                });
            };
        </script>
    <?php endif; ?>

    <!-- Editado -->
    <?php if (!empty($mensajeEdit)) : ?>
        <script>
            window.onload = function mensajeEdit(){
                swal.fire({
                        title: "Registro Editado",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1300
                });
            };
        </script>
    <?php endif; ?>

    <!-- Registrado -->
    <?php if (!empty($mensajeRegistro)) :?>
        <script>
            window.onload = function mensajeRegistro(){
                swal.fire({
                        title: "Datos Registrados Exitosamente",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1300
                });
            };
        </script>
    <?php endif; ?>

    <!-- Registrado -->
    <?php if (!empty($mensajeSeccion)) :?>
        <script>
            let seccion = '<?= $mensajeSeccion ?>';
            window.onload = ()=>{
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-primary"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Registro Fallido❗",
                    text: "⚠️ La sección '"+seccion+"', se encuentra asignada a un docente ⚠️",
                    icon: "error"
                });
            }
        </script>
    <?php endif; ?>

    </body>
</html>