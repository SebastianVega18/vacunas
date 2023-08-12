<?php
    require_once ("bd/conexion.php");

    $db = new database();
    $conec = $db -> conectar();

    if ((isset($_POST["registro"]))&&($_POST["registro"]=="reg"))
    {
        $id = $_POST['docu'];
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $genero = $_POST['genero'];
        $dire = $_POST['dire'];
        $tel = $_POST['tel'];
        $enfer = $_POST['enfer'];

        $validar="SELECT * FROM usuarios WHERE documento = '$id' AND nombre = '$nombre' ";
        $queryi=$conec->prepare($validar);
        $queryi->execute();
        $fila1=$queryi->fetchAll(PDO::FETCH_ASSOC);
        
        if ($id=="" || $nombre=="" || $fecha == "" || $genero == "" || $dire == "" || $tel=="" || $enfer == "" )
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        
        else if ($fila1){
            echo '<script> alert ("EL USUARIO YA EXISTE");</script>';
            echo '<script> windows.location= "index.php"</script>';

        }
        else
        {
            $insertsql=$conec->prepare("INSERT INTO usuarios(documento,nombre,fecha_na,genero,direccion,telefono,enfermedades) VALUES (?,?,?,?,?,?,?);");
            $insertsql->execute([$id,$nombre,$fecha,$genero,$dire,$tel,$enfer]);
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
    <title>Registro de Usuarios</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuarios</h2>
        <br>
        <div class="container">
        <form method="POST" name="formulario">
            <div class="mb-3">
                <label class="form-label">Documento</label>
                <input type="number" class="form-control" name="docu" placeholder="Ingresa tu documento">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Genero</label>
                <input type="text" class="form-control" name="genero" placeholder="Ingresa tu genero">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Direccion</label>
                <input type="text" class="form-control" name="dire" placeholder="Ingresa tu direccion">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="number" class="form-control" name="tel" placeholder="Ingresa tu telefono">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Enfermedades</label>
                <input type="text" class="form-control" name="enfer" placeholder="Ingresa tu enfermedad">
            </div>
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
