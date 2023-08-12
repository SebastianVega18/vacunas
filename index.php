<?php
    require_once ("bd/conexion.php");

    $db = new database();
    $conec = $db -> conectar();

    $vacunacion = $conec -> prepare ("SELECT * FROM vacunacion INNER JOIN usuarios ON vacunacion.documento = usuarios.documento");
    $vacunacion -> execute();

    $fecha1 = $conec -> prepare("SELECT * FROM vacunacion");
    $fecha1 -> execute();
    $fecha2 = $fecha1 -> fetch(PDO::FETCH_ASSOC);

?>
<?php

$fechaActual = $fecha2['fecha_va'];

$fecha = new DateTime($fechaActual);

$fecha->modify('+1 year');

$fechaVencimiento = $fecha->format('Y-m-d');

$fecha_sistema = date("y-m-d");;

if ($fecha_sistema > $fechaVencimiento) {
    echo '<br><div class="container alert alert-danger" role="alert">
    Debe de volver a aplicar la vacuna.
    </div>';
} elseif ($fechaVencimiento == $fecha_sistema) {
    echo '<br><div class="container alert alert-warning" role="alert">
    La vacuna se vence hoy.
    </div>';
} elseif ($fecha_sistema < $fechaVencimiento){ 
    echo '<br><div class="container alert alert-success" role="alert">
    La vacuna tiene vigencia.
    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacunaciones</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registros de Vacunación</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha de Vacunación</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Vacuna</th>
                    <th>Lote de Vacuna</th>
                    <th>Enfermero/a</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach ($vacunacion as $datos){ ?>
                    <td><?php echo $datos['nombre']; ?></td>
                    <td><?php echo $datos['fecha_va']?></td>
                    <td><?php echo $fechaVencimiento?></td>
                    <td><?php echo $datos['tip_vacuna']?></td>
                    <td><?php echo $datos['lote_va']?></td>
                    <td><?php echo $datos['enfermero']?></td>
                <?php }?>
            </tbody>
        </table>
        <br>
        <a href="registro.php" class="btn btn-primary">Registro Usuarios</a>
        <a href="registro_va.php" class="btn btn-primary">Registro Vacunas</a>
    </div>

    <!-- Agrega el enlace al archivo JavaScript de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>