
<?php
    include("dataBase/conn.php");
        
    session_start();

    $mensaje='';
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }

    if(isset($_POST['secion'])) :
        
        $seccion = $_POST['secion'];
        $fechaEscolar = $_POST['fechaEscolar'];
        $fechaMatricula = $_POST['fechaMatricula'];
        $tipoMatricula = $_POST['tpMatricula'];

        $sqlAlumnos = 'SELECT * FROM alumnos WHERE seccion = :seccion';
        $sqlDocentes = 'SELECT * FROM docentes WHERE seccion = :seccion';

        $stmtAlumnos = $conn->prepare($sqlAlumnos);
        $stmtAlumnos->bindParam(':seccion', $seccion);
        $stmtAlumnos->execute();

        $stmtDocentes = $conn->prepare($sqlDocentes);
        $stmtDocentes->bindParam(':seccion', $seccion);
        $stmtDocentes->execute();

        $docente = $stmtDocentes->fetch(PDO::FETCH_ASSOC);

        $numAlumnos = $stmtAlumnos->rowCount();

    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rpt Rsm Fnl</title>
    <link rel="shortcut icon" href="img/logoP.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
</head>
<body class="mx-1">

    <header class="d-flex justify-content-between m-3">
        <img src="img/logo-ministerio.png" width="700" height="70">
        <div class="text-center" style="width: 100;">
            <h5 class="mb-0">MATRÍCULA FINAL EDUCACIÓN INICIAL</h5>
            <h5 class="mb-0">(Maternal y Preescolar)</h5>
            <h5 class="mb-0">Código del Formato: RR-DEA-07-04</h5>
            <p class="mb-0">Matrícula de Tipo: <?= $tipoMatricula  ?></p>
            <p class="mb-0">Año Escolar: <?= $fechaEscolar ?> </p>
            <p class="mb-0">Mes y Año de la Matrícula: <?= $fechaMatricula ?></p>
        </div>
    </header>

<center>
    <h5>Datos del Plantel:</h5>

    <table class="w-100 mb-1">

        <tr>
            <th class="border border-2 border-black text-center">Cod de Plantel:</th>
            <th class="border border-2 border-black text-center">Nombre:</th>
            <th class="border border-2 border-black text-center">Distrito Escolar:</th>
            <th class="border border-2 border-black text-center">Teléfono:</th>
        </tr>

        <tr>
            <td class="border border-2 border-black"> OD01771401</td>
            <td class="border border-2 border-black">Jardín de Infancia "José Antonio Páez"</td>
            <td class="border border-2 border-black">06</td>
            <td class="border border-2 border-black">0424-7763963</td>
        </tr>

    </table>

    <table class="w-100 mb-1">
        
         <tr>
            <th class="border border-2 border-black text-center">Dirección:</th>
            <th class="border border-2 border-black text-center">Municipio:</th>
            <th class="border border-2 border-black text-center">Entidad Federal:</th>
            <th class="border border-2 border-black text-center">Zona Educativa:</th>
        </tr>

        <tr>
            <td class="border border-2 border-black"> Final Calle Principal, Urb. Páez - Sector II</td>
            <td class="border border-2 border-black">Alberto Adriani</td>
            <td class="border border-2 border-black">Mérida</td>
            <td class="border border-2 border-black">14</td>
        </tr>

    </table>


   
    <h5>Identificación del Curso:</h5>

    <table class="w-100 mb-1">

        <tr>
            <th class="border border-2 border-black text-center">Sección:</th>
            <th class="border border-2 border-black text-center">N° de Niños(as) de la Sección:</th>
            <th class="border border-2 border-black text-center">N° de Niños(as) en esta Página:</th>
        </tr>

        <tr>
            <td class="border border-2 border-black"><?= $seccion ?></td>
            <td class="border border-2 border-black"><?= $numAlumnos ?></td>
            <td class="border border-2 border-black"><?= $numAlumnos ?></td>
        </tr>

    </table>


    <h5>Matricula Final:</h5>

    <table class="w-100 mb-1">

        <tr>
            <th class="border border-2 border-black text-center" rowspan="2">Nro:</th>
            <th class="border border-2 border-black text-center" rowspan="2">Cédula de identidad o cédula escolar</th>
            <th class="border border-2 border-black text-center" rowspan="2">Lugar de Nacimiento</th>
            <th class="border border-2 border-black text-center" rowspan="2">EF</th>
            <th class="border border-2 border-black text-center" rowspan="2">Sexo</th>
            <th class="border border-2 border-black text-center" rowspan="2">Fecha de nacimiento</th>
            <th class="border border-2 border-black text-center" colspan="4">Maternal</th>
            <th class="border border-2 border-black text-center" colspan="3">Preescolar</th>
        </tr>

        <tr>
            <th class="border border-2 border-black text-center">0 a 11 m</th>
            <th class="border border-2 border-black text-center">1 a 11 m</th>
            <th class="border border-2 border-black text-center">2 a 11 m</th>
            <th class="border border-2 border-black text-center">3 a 11 m</th>
            <th class="border border-2 border-black text-center">4 a 11 m</th>
            <th class="border border-2 border-black text-center">5 a 11 m</th>
            <th class="border border-2 border-black text-center">IB</th>
        </tr>

        <?php
            $numero = 1;
            while ($alumno = $stmtAlumnos->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <tr>
            <td class="border border-2 border-black"><?= $numero ?></td>
            <td class="border border-2 border-black"><?= $alumno['cedula'] ?></td>
            <td class="border border-2 border-black"><?= $alumno['lugarNac'] ?></td>
            <td class="border border-2 border-black"><?= $alumno['entFed'] ?></td>
            <td class="border border-2 border-black"><?= $alumno['sexo'] ?></td>
            <td class="border border-2 border-black"><?= $alumno['fechaNac'] ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
            <td class="border border-2 border-black"><?= '' ?></td>
        </tr>

        <?php
            $numero++;
            }
        ?>

        <tr>
            <th class="border border-2 border-black text-center" colspan="15">Totales</th>
        </tr>

        <tr>
            <th class="border border-2 border-black text-center">Nro:</th>
            <th class="border border-2 border-black text-center" colspan="7">Apellidos:</th>
            <th class="border border-2 border-black text-center" colspan="7">Nombres:</th>
        </tr>

        <?php
            $numero = 1; // Reiniciar el contador
            $stmtAlumnos->execute();
            while ($alumnos = $stmtAlumnos->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <tr>
            <td class="border border-2 border-black"><?php echo $numero ?></td>
            <td class="border border-2 border-black" colspan="7"><?= $alumnos['apellido'] ?></td>
            <td class="border border-2 border-black" colspan="7"><?= $alumnos['nombre'] ?></td>
        </tr>

        <?php
            $numero++;
            }
        ?>


    </table>


    <h5>Datos del Docente:</h5>

    <table class="w-100 mb-1">

        <tr>
            <th class="border border-2 border-black text-center">Apellido(s):</th>
            <th class="border border-2 border-black text-center">Nombre(s):</th>
            <th class="border border-2 border-black text-center">Cédula de Identidad:</th>
            <th class="border border-2 border-black" rowspan="2">Firma del Docente:</th>
        </tr>

        <tr>
            <td class="border border-2 border-black"><?= $docente['apellido'] ?></td>
            <td class="border border-2 border-black"><?= $docente['nombre'] ?></td>
            <td class="border border-2 border-black"><?= $docente['cedula'] ?></td>
        </tr>

        <tr>
            <th class="border border-2 border-black" colspan="4">Observaciones:</th>
        </tr>

        <tr>
            <th class="border border-2 border-black" colspan="4">.</th>
        </tr>

    </table>
</center>

    <table class="w-100 mb-1">

        <tr>
            <td class="border border-2 border-black" colspan="2">Fecha de Remisión:</td>
            <td class="border border-2 border-black" colspan="2">Fecha de Remisión:</td>
        </tr>

        <tr>
            <th class="w-25 border border-2 border-black text-center">Director(a)</th>
            <td class="w-25 border border-2 border-black text-center" rowspan="10">SELLO DEL PLANTEL</td>
            <th class="w-25 border border-2 border-black text-center">Funcionario(a) Receptor(a)</th>
            <td class="w-25 border border-2 border-black text-center" rowspan="10">SELLO DE ZONA EDUCATIVA</td>
        </tr>

        <tr>
            <td class="w-25 border border-2 border-black text-center">Apellidos y Nombre</td>
            <td class="w-25 border border-2 border-black text-center">Apellidos y Nombre</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

        <tr>
            <td class="w-25 border border-2 border-black text-center">Nro de Cédula de Identidad</td>
            <td class="w-25 border border-2 border-black text-center">Nro de Cédula de Identidad</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

        <tr>
            <td class="w-25 border border-2 border-black">Firma</td>
            <td class="w-25 border border-2 border-black">Firma</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

        <tr>
            <td class="w-25 border-start border-black">.</td>
            <td class="w-25 border-start border-black">.</td>
        </tr>

    </table>


    



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable();
    </script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/js.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script>
        window.onload = function imprimir(){
            window.print();
        }
    </script>

</body>
</html>