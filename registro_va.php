<?php
    require_once ("bd/conexion.php");

    $db = new database();
    $conec = $db -> conectar();

    $queryi = $conec -> prepare("SELECT * FROM usuarios");
    $queryi -> execute();

    if ((isset($_POST["registro"]))&&($_POST["registro"]=="reg"))
    {
        $documento = $_POST['docu'];
        $fecha = $_POST['fecha'];
        $vacuna = $_POST['vac'];
        $lote = $_POST['lote'];
        $enfermero = $_POST['enfermero'];
        
        if ($documento == "" || $fecha == "" || $vacuna == "" || $lote == "" || $enfermero == "")
        {
            echo '<script> alert ("EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        else
        {
            $insertsql=$conec->prepare("INSERT INTO vacunacion(documento,fecha_va,tip_vacuna,lote_va,enfermero) VALUES (?,?,?,?,?);");
            $insertsql->execute([$documento,$fecha,$vacuna,$lote,$enfermero]);
            echo '<script>alert ("Registro Exitoso, Gracias");</script>';
            echo '<script> window.location="index.php"</script>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vacunacion</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Vacunacion</h2>
        <br>
        <div class="container">
        <form method="POST" name="formulario">
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="docu" required class="form-control" >
                    <option class="form-control" value="">Seleccione</option>
                    <?php
                        foreach ($queryi as $paciente){ 
                    ?>
                    <option value="<?php echo($paciente['documento'])?>"><?php echo($paciente['nombre'])?></option
                    <?php 
                        } 
                    ?>
                </select></select>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Fecha de vacunacion</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Vacunas</label>
                <input type="text" class="form-control" name="vac" placeholder="Ingresa tu vacuna">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Lote de vacuna</label>
                <input type="text" class="form-control" name="lote" placeholder="Ingresa el lote de tu vacuna">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Enfermero</label>
                <input type="text" class="form-control" name="enfermero" placeholder="Ingresa tu nombre">
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Registrarme">
            <input type="hidden" name="registro" value="reg">
            
            <a href="index.php" class="btn btn-primary">Regresar</a>
        </form>
        </div>
    </div>

    <!-- Agrega el enlace al archivo JavaScript de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
