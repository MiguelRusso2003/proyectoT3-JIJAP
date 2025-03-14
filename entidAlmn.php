<?php
    include("dataBase/conn.php");
    
    session_start();

    $mensaje="";
    $mensajeEliminar="";
    $mensajeEdit="";
    $mensajeRegistro="";
    $idEdit ="";

    $pagAct = basename($_SERVER['PHP_SELF']);
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if (isset($_SESSION['mensaje-eliminar'])) {
        $mensajeEliminar = "verdadero";
        unset($_SESSION['mensaje-eliminar']);
    }

    if (isset($_SESSION["mensaje-editar"])) {
        $mensajeEdit = "verdadero";
        unset($_SESSION['mensaje-editar']);
    }

    if (isset($_SESSION['mensaje-registro'])) {
        $mensajeRegistro = "verdadero";
        unset($_SESSION['mensaje-registro']);
    }

    if (isset($_POST['editar'])) {
        $idEdit = $_POST["id"];

        $sqlEdit = "SELECT * FROM alumnos WHERE id = :id";
        $ejecutarSql = $conn -> prepare($sqlEdit);
        $ejecutarSql -> bindParam(':id', $idEdit);
        $ejecutarSql -> execute();

        $datosEdit = $ejecutarSql -> fetch(PDO::FETCH_ASSOC); 
    }

    $sql = "SELECT * FROM alumnos";
    $resultado = $conn -> query($sql);

    $sqlSA = "SELECT * FROM docentes WHERE seccion = 'A'";
    $sqlSB = "SELECT * FROM docentes WHERE seccion = 'B'";
    $sqlSC = "SELECT * FROM docentes WHERE seccion = 'C'";
    $sqlSD = "SELECT * FROM docentes WHERE seccion = 'D'";
    $sqlSE = "SELECT * FROM docentes WHERE seccion = 'E'";
    $sqlSF = "SELECT * FROM docentes WHERE seccion = 'F'";
    $sqlSG = "SELECT * FROM docentes WHERE seccion = 'G'";
    
    $resultadoSA = $conn -> query($sqlSA);
    $resultadoSB = $conn -> query($sqlSB);
    $resultadoSC = $conn -> query($sqlSC);
    $resultadoSD = $conn -> query($sqlSD);
    $resultadoSE = $conn -> query($sqlSE);
    $resultadoSF = $conn -> query($sqlSF);
    $resultadoSG = $conn -> query($sqlSG);

    $docenteA = $resultadoSA -> fetch(PDO::FETCH_ASSOC);
    $docenteB = $resultadoSB -> fetch(PDO::FETCH_ASSOC);
    $docenteC = $resultadoSC -> fetch(PDO::FETCH_ASSOC);
    $docenteD = $resultadoSD -> fetch(PDO::FETCH_ASSOC);
    $docenteE = $resultadoSE -> fetch(PDO::FETCH_ASSOC);
    $docenteF = $resultadoSF -> fetch(PDO::FETCH_ASSOC);
    $docenteG = $resultadoSG -> fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
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

    <div id="body" class="rounded margin-left-width" style="background-image:url(img/bg-parke2.jpg); background-size:cover;background-attachment: fixed;">

        <div class="container-fluid bg-white-trans rounded">
            <div class="container">
                
                <br>

                <div class="d-md-flex text-center justify-content-between align-items-center">
                    <div class="d-md-flex d-block">
                        <img src="icons/graduacion.svg" style="width: 70px;"><hr class="d-md-none w-25 mx-auto border-primary border"><div class="vr mx-3 d-md-block d-none border-primary"></div>
                        <h1 class="display-5">Alumnos </h1>
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
                                <th class="text-start col">Nombre y Apellido</th>
                                <th class="text-start col">Cedula Estudiantil</th>
                                <th class="text-start col">Seccion</th>
                                <th class="text-start col">Sexo</th>
                                <th class="text-center col">Acción</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php foreach ($resultado as $key) {?>
                            
                            <tr>
                                <td> <?php echo $key['nombre'].' '.$key['apellido'] ?> </td>
                                <td class="text-start"> <?php echo $key['cedula']; ?> </td>
                                <td> <?php echo $key['seccion']; ?> </td>
                                <td class="text-start align-items-center">

                                    <?php if($key['sexo'] === 'm') : ?> 
                                        Masculino <img src="icons/masculino.svg" style="width: 20px; height: 20px">
                                    <?php endif; ?>

                                    <?php if($key['sexo'] === 'f') : ?> 
                                        Femenino <img src="icons/femenino.svg" style="width: 20px; height: 20px">
                                    <?php endif; ?>

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
                                        <form action="dataBase/eliminarAlmn.php" method="post" id="formDataDelete<?php echo $key['id'];?>">
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

                                            <div class="d-md-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="col-md-6 mx-4 mx-md-auto d-flex justify-content-center align-items-center">
                                                        <img src="<?= $key['foto'] ?>" class="img-fluid rounded">
                                                    </div>
                                                    <p class="fw-light my-1 fs-4 text-center"><strong><?= $key['nombre'].' '.$key['apellido'] ?></strong></p>
                                                    <p class="fw-light fs-5 text-center">
                                                        <?php if($key['sexo'] === 'm') { echo 'Masculino ♂️';} ?> 
                                                        <?php if($key['sexo'] === 'f') { echo 'Femenino ♀️';} ?>
                                                    </p>
                                                </div>

                                            </div>

                                            <div class="d-md-flex">

                                                <div class="container-fluid col-md-6">
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Entidad Federal:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['entFed']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Sección:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['seccion']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Docente:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php  
                                                                if($key['seccion'] === 'A'){
                                                                    echo $docenteA['nombre']." ".$docenteA['apellido']; 
                                                                }else if($key['seccion'] === 'B'){
                                                                    echo $docenteB['nombre']." ".$docenteB['apellido'];
                                                                }else if($key['seccion'] === 'C'){
                                                                    echo $docenteC['nombre']." ".$docenteC['apellido'];
                                                                }else if($key['seccion'] === 'D'){
                                                                    echo $docenteD['nombre']." ".$docenteD['apellido'];
                                                                }else if($key['seccion'] === 'E'){
                                                                    echo $docenteE['nombre']." ".$docenteE['apellido'];
                                                                }else if($key['seccion'] === 'F'){
                                                                    echo $docenteF['nombre']." ".$docenteF['apellido'];
                                                                }else if($key['seccion'] === 'G'){
                                                                    echo $docenteG['nombre']." ".$docenteG['apellido'];
                                                                }  
                                                            ?>" 
                                                        disabled readonly>
                                                    </div>
                                                </div>

                                                <div class="container-fluid col-md-6">
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Cédula Escolar:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['cedula']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Fecha de Nacimiento:</label>
                                                        <input type="text" class=" text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['fechaNac']; ?>" disabled readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="text-black fw-light">Lugar de Nacimiento:</label>
                                                        <input type="text" class="text-center fw-light border border-secondary border-2 form-control" value="<?php echo $key['lugarNac']; ?>" disabled readonly>
                                                    </div>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR DATOS ALUMNO</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="dataBase/editAlmn.php" enctype="multipart/form-data">

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input  value="<?php echo $datosEdit["nombre"] ; ?>" type="text" name="nombre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Nombre</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["apellido"] ; ?>" type="text" name="apellido" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Apellido</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["cedula"] ; ?>" type="text" name="cedula" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Cédula Estudiantil</label>
                                            </div>

                                        </div>

                                        <div class="container-fluid d-md-flex justify-content-center">

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["fechaNac"] ; ?>" type="date" name="fechaNac" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                                <label class="text-dark" for="floatingInput">Fecha de Nacimiento</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["lugarNac"] ; ?>" type="text" name="lugarNac" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Lugar de Nacimiento</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <select class="form-control me-1 border border-2 border-primary" name="sexo">
                                                    <option value="m" <?= 'm' === $datosEdit["sexo"] ? 'selected' : '' ?>>Masculino ♂️</option>
                                                    <option value="f" <?= 'f' === $datosEdit["sexo"] ? 'selected' : '' ?>>Femenino ♀️</option>
                                                </select>
                                                <label class="text-dark">Sexo</label>
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
                                                </select>
                                                <label class="text-dark">Sección</label>
                                            </div>

                                            <div class="form-floating mb-4 mx-2 col-md-4">
                                                <input value="<?php echo $datosEdit["entFed"] ; ?>" type="text" name="entFed" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                                <label class="text-dark">Entidad Federal</label>
                                            </div>
                                        
                                        </div>
                                        
                                        <div class="modal-footer d-flex justify-content-center">
                                            <input type="hidden" name="id" value="<?= $datosEdit["id"] ?>">
                                            <button type="button" class="btn btn-2 shadow border-2 btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Alumno</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="dataBase/insertAlmn.php" enctype="multipart/form-data">

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="nombre" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Nombre</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="apellido" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Apellido</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="number" name="cedula" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Cédula Estudiantil</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="date" name="fechaNac" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Fecha de Nacimiento</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="lugarNac" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Lugar de Nacimiento</label>
                                        </div>

                                        <!-- <div class="d-flex mb-4 mx-2 col-md-4">
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
                                        </div> -->

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="entFed" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Entidad Federal</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="sexo" required>
                                                <option value="m">Masculino ♂️</option>
                                                <option value="f">Femenino ♀️</option>
                                            </select>
                                            <label class="text-dark">Sexo</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <select class="form-control me-1 border border-2 border-primary" name="seccion">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                            </select>
                                            <label class="text-dark">Sección</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="file" accept="image/*" multiple name="foto" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario">
                                            <label class="text-dark" for="floatingInput">Foto del Alumno</label>
                                        </div>
                                    
                                    </div>

                                    <!-- <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="seccion" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Sección</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="clasif" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Clasificación</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="number" name="mesesServ" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Meses de Servicio</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="horas" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario" required>
                                            <label class="text-dark" for="floatingInput">Horas de Trabajo</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="areaForm" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Area de Formación</label>
                                        </div>

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="text" name="matricula" placeholder="Contraseña" class="border border-primary border-2 form-control form-control-lg" required>
                                            <label class="text-dark">Matrícula</label>
                                        </div>

                                    </div>

                                    <div class="container-fluid d-md-flex justify-content-center">

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

                                        <div class="form-floating mb-4 mx-2 col-md-4">
                                            <input type="file" accept="image/*" multiple name="foto" id="floatingInput" class="border border-primary border-2 form-control form-control-lg" placeholder="usuario">
                                            <label class="text-dark" for="floatingInput">Seleccionar Foto del Docente</label>
                                        </div>

                                    </div> -->
                                    
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
</body>
</html>