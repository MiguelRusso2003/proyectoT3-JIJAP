<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Matrícula Final</title>
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
    </style>
</head>
<body>
    <div class="header">
        <img src="img/logo-ministerio.png">
        <div style="text-align: right; margin-top: -55px;">
            <h5>MATRÍCULA FINAL EDUCACIÓN INICIAL</h5>
            <h5>(Maternal y Preescolar)</h5>
            <h5>Código del Formato: RR-DEA-07-04</h5>
            <p>Matrícula de Tipo: <?= $tipoMatricula ?></p>
            <p>Año Escolar: <?= $fechaEscolar ?></p>
            <p>Mes y Año de la Matrícula: <?= $fechaMatricula ?></p>
        </div>
    </div>

    <h5>Datos del Plantel:</h5>
    <table>
        <tr>
            <th>Cod de Plantel:</th>
            <th>Nombre:</th>
            <th>Distrito Escolar:</th>
            <th>Teléfono:</th>
        </tr>
        <tr>
            <td>OD01771401</td>
            <td>Jardín de Infancia "José Antonio Páez"</td>
            <td>06</td>
            <td>0424-7763963</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Dirección:</th>
            <th>Municipio:</th>
            <th>Entidad Federal:</th>
            <th>Zona Educativa:</th>
        </tr>
        <tr>
            <td>Final Calle Principal, Urb. Páez - Sector II</td>
            <td>Alberto Adriani</td>
            <td>Mérida</td>
            <td>14</td>
        </tr>
    </table>

    <h5>Identificación del Curso:</h5>
    <table>
        <tr>
            <th>Sección:</th>
            <th>N° de Niños(as) de la Sección:</th>
            <th>N° de Niños(as) en esta Página:</th>
        </tr>
        <tr>
            <td><?= $seccion ?></td>
            <td><?= $numAlumnos ?></td>
            <td><?= $numAlumnos ?></td>
        </tr>
    </table>

    <h5>Matricula Final:</h5>
    <table>
        <tr>
            <th rowspan="2">Nro:</th>
            <th rowspan="2">Cédula de identidad o cédula escolar</th>
            <th rowspan="2">Lugar de Nacimiento</th>
            <th rowspan="2">EF</th>
            <th rowspan="2">Sexo</th>
            <th rowspan="2">Fecha de nacimiento</th>
            <th colspan="4">Maternal</th>
            <th colspan="3">Preescolar</th>
        </tr>
        <tr>
            <th>0 a 11 m</th>
            <th>1 a 11 m</th>
            <th>2 a 11 m</th>
            <th>3 a 11 m</th>
            <th>4 a 11 m</th>
            <th>5 a 11 m</th>
            <th>IB</th>
        </tr>
        <?php
            $numero = 1;
            while ($alumno = $stmtAlumnos->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?= $numero ?></td>
            <td><?= $alumno['cedula'] ?></td>
            <td><?= $alumno['lugarNac'] ?></td>
            <td><?= $alumno['entFed'] ?></td>
            <td><?= $alumno['sexo'] ?></td>
            <td><?= DateTime::createFromFormat('Y-m-d', $alumno['fechaNac'])->format('d-m-Y');  ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 12 ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 24 && edadMeses($alumno['fechaNac']) > 11  ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 36 && edadMeses($alumno['fechaNac']) > 23  ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 48 && edadMeses($alumno['fechaNac']) > 35  ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 60 && edadMeses($alumno['fechaNac']) > 47  ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 72 && edadMeses($alumno['fechaNac']) > 59  ? 'X' : ''; ?></td>
            <td><?= edadMeses($alumno['fechaNac']) < 84 && edadMeses($alumno['fechaNac']) > 71  ? 'X' : ''; ?></td>
        </tr>
        <?php
            $numero++;
            }
        ?>
    </table>

    <table>
        <tr>
            <th colspan="15">Totales</th>
        </tr>
        <tr>
            <th>Nro:</th>
            <th colspan="7">Apellidos:</th>
            <th colspan="7">Nombres:</th>
        </tr>
        <?php
            $numero = 1;
            $stmtAlumnos->execute();
            while ($alumnos = $stmtAlumnos->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td class="w-4"><?= $numero ?></td>
            <td colspan="7"><?= $alumnos['apellido'] ?></td>
            <td colspan="7"><?= $alumnos['nombre'] ?></td>
        </tr>
        <?php
            $numero++;
            }
        ?>
    </table>

    <h5>Datos del Docente:</h5>
    <table>
        <tr>
            <th>Apellido(s):</th>
            <th>Nombre(s):</th>
            <th>Cédula de Identidad:</th>
            <td rowspan="2" class="w-25" style="text-align: start; justify-content: start; border-right: 1px solid black;"><strong>Firma:</strong></td>
        </tr>
        <tr>
            <td><?= $docente['apellido'] ?></td>
            <td><?= $docente['nombre'] ?></td>
            <td><?= $docente['cedula'] ?></td>
        </tr>
        <tr>
            <th colspan="4" style="text-align: start; justify-content: start;">Observaciones:</th>
        </tr>
        <tr>
            <td style="border-bottom: none;" colspan="4">.</td>
        </tr>
        <tr>
            <td style="border-top: none;" colspan="4">.</td>
        </tr>
    </table>

    <div class="signature-section">
        <table>
            <tr>
                <td colspan="2"><strong>Fecha de Remisión:</strong></td>
                <td colspan="2"><strong>Fecha de Remisión:</strong></td>
            </tr>
            <tr>
                <th class="w-25">Director(a)</th>
                <td class="w-25 gris" rowspan="10">SELLO DEL PLANTEL</td>
                <th class="w-25">Funcionario(a) Receptor(a)</th>
                <td class="w-25 gris" rowspan="10">SELLO DE ZONA EDUCATIVA</td>
            </tr>
            <tr>
                <th>Apellidos y Nombre</th>
                <th>Apellidos y Nombre</th>
            </tr>
            <tr>
                <td>- <?= $director['apellido'] ?></td>
                <td>- </td>
            </tr>
            <tr>
                <td>- <?= $director['nombre'] ?></td>
                <td>-</td>
            </tr>
            <tr>
                <th>Nro de Cédula de Identidad</th>
                <th>Nro de Cédula de Identidad</th>
            </tr>
            <tr>
                <td style="border-bottom: none;"></td>
                <td style="border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="border-top: none;"><?= $director['cedula'] ?></td>
                <td style="border-top: none;"></td>
            </tr>
            <tr>
                <th>Firma</th>
                <th>Firma</th>
            </tr>
            <tr>
                <td style="border-bottom: none;">.</td>
                <td style="border-bottom: none;">.</td>
            </tr>
            <tr>
                <td style="border-top: none;">.</td>
                <td style="border-top: none;">.</td>
            </tr>
        </table>
    </div>
</body>
</html> 