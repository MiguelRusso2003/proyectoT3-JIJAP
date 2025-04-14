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

    if(isset($_POST['tpBnNc'])) :
        
        $bnNcn = $_POST['tpBnNc'];
        $fecha = $_POST['fecha'];

        $sqlBnNcn = 'SELECT * FROM '.$bnNcn;

        $stmtBnNcn = $conn->query($sqlBnNcn);

        // Configurar opciones de DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultPaperSize', 'letter');
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
        include 'template_rptBnsNcn.php';
        $html = ob_get_clean();

        // Cargar HTML en DOMPDF
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream("Formato_de_bienes_publicos_".$fecha.".pdf", array("Attachment" => false));
        exit;

    endif;
?>