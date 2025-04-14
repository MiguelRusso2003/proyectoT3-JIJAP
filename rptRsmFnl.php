<?php
    include("dataBase/conn.php");
    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;
        
    session_start();

    $mensaje='';
    
    if (isset($_SESSION["mensaje"])) {
        $mensaje=$_SESSION["mensaje"];
    }else{
        header("location:login.php");
    }
    $primerIngre = '';

    if (isset($_SESSION['primer-ingreso'])) {
        $primerIngre = 'no vacio';
    }

    if(isset($_POST['secion'])) :
        
        $seccion = $_POST['secion'];
        $fechaEscolar = $_POST['fechaEscolar'];
        $fechaMatricula = $_POST['fechaMatricula'];
        $tipoMatricula = $_POST['tpMatricula'];
        $Director = 'Director(a)';

        $sqlAlumnos = 'SELECT * FROM alumnos WHERE seccion = :seccion';
        $sqlDocentes = 'SELECT * FROM docentes WHERE seccion = :seccion';
        $sqlDirector = 'SELECT * FROM docentes WHERE areaForm = :areaForm';

        $stmtAlumnos = $conn->prepare($sqlAlumnos);
        $stmtAlumnos->bindParam(':seccion', $seccion);
        $stmtAlumnos->execute();

        $stmtDocentes = $conn->prepare($sqlDocentes);
        $stmtDocentes->bindParam(':seccion', $seccion);
        $stmtDocentes->execute();

        $stmtDirector = $conn->prepare($sqlDirector);
        $stmtDirector->bindParam(':areaForm', $Director);
        $stmtDirector->execute();

        $docente = $stmtDocentes->fetch(PDO::FETCH_ASSOC);
        $director = $stmtDirector->fetch(PDO::FETCH_ASSOC);

        $numAlumnos = $stmtAlumnos->rowCount();

        function edadMeses($fechaNacimiento) {
            // 1. Verificar si la fecha de nacimiento es válida
            $fechaNacimientoObj = DateTime::createFromFormat('Y-m-d', $fechaNacimiento);
            if (!$fechaNacimientoObj) {
                return "Fecha de nacimiento inválida";
            }
        
            // 2. Obtener la fecha actual
            $fechaActual = new DateTime();
        
            // 3. Calcular la diferencia entre las fechas
            $diferencia = $fechaNacimientoObj->diff($fechaActual);
        
            // 4. Calcular el número total de meses
            $meses = ($diferencia->y * 12) + $diferencia->m;
        
            return $meses;
        }

        // Configurar opciones de DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultPaperSize', 'legal');
        $options->set('defaultPaperOrientation', 'portrait');
        $options->set('chroot', $_SERVER['DOCUMENT_ROOT']);
        $options->set('margin_top', '10');
        $options->set('margin_right', '10');
        $options->set('margin_bottom', '10');
        $options->set('margin_left', '10');
        $options->set('defaultFont', 'Arial');
        $options->set('dpi', 150);

        // Crear instancia de DOMPDF
        $dompdf = new Dompdf($options);

        // Obtener el contenido HTML
        ob_start();
        include 'template_rptRsmFnl.php';
        $html = ob_get_clean();

        // Cargar HTML en DOMPDF
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream("Resumen_Final".$fechaMatricula.".pdf", array("Attachment" => false));
        exit;

    endif;
?>