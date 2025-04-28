<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bienes Nacionales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 10px;
        }
        .header img {
            max-width: 700px;
            height: auto;
        }
        .header h5 {
            margin: 2px 0;
            font-size: 8pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        th, td {
            border: 1px solid black;
            padding: 2px;
            font-size: 9pt;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .w-100 {
            width: 100%;
        }
        .mb-1 {
            margin-bottom: 5px;
        }
        h5 {
            margin: 5px 0;
            font-size: 10pt;
        }
        .w-25 {
            width: 25%;
        }
        .w-4{
            width: 4%;
        }
        .border {
            border: 1px solid black;
        }
        .border-2 {
            border-width: 2px;
        }
        .border-black {
            border-color: black;
        }
        .signature-section {
            margin-top: 20px;
        }
        .signature-line {
            border-top: 1px solid black;
            width: 200px;
            margin: 20px auto;
        }
        p{
            margin: 2px 0;
        }
        table {
            margin-bottom: 10px;
        }
        .gris{
            color: gray;
            text-align: center;
        }
        .justify-content-between{
            display:flex;
            justify-content: space-between;
            align-items:center;
        }
        .mx-5{
            margin-left: 2rem;
            margin-right: 2rem;
        }
        .d-flex{
            display: flex;
        }
    </style>
</head>
<body>

    <div class="justify-content-between w-100 mx-5">
        <h5>Oficina de Bienes Públicos</h5>
        <p>Fecha: <?=  DateTime::createFromFormat('Y-m-d', $fecha)->format('d-m-Y');  ?></p>
    </div>

    <h4>Inventario de Bienes Nacinales</h4>

    <div class="text-center d-flex">
        <h5>BIENES MUEBLES ( <?= $bnNcn === 'bienesmbls' ? 'X' : '' ?> )</h5>
        <h5>BIENES MATERIALES ( <?= $bnNcn !== 'bienesmbls' ? 'X' : '' ?> )</h5>
    </div>
    
    <h5>Ministerio de finanzas Sistema de SIGECOF</h5>
    <table>
        <tr>
            <th>CANTIDAD</th>
            <th>CODIGO DE CATALAGO</th>
            <th>N^ DEL INVENTARIO DEL BIEN</th>
            <th>DESCRIPCION</th>
            <th>VALOR UNITARIO</th>
            <th>VALOR TOTAL</th>
        </tr>
        <?php foreach ($stmtBnNcn as $bienNacional) :?>
            <tr>
                <td><?= $bienNacional['cantidad'] ?></td>
                <td><?= $bienNacional['codCat'] ?></td>
                <td><?= $bienNacional['n_Inv'] ?></td>
                <td><?= $bienNacional['descripcion'] ?></td>
                <td><?= $bienNacional['precioUni'] ?></td>
                <td><?= $bienNacional['cantidad'] * $bienNacional['precioUni']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html> 