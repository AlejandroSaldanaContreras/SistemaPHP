<?php
    $id_proveedor = $_GET['id_proveedor'];
    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");
    if ($stmt = $mysqli->prepare("SELECT * FROM proveedor WHERE id_proveedor = ?")){
        $stmt->bind_param("i", $id_proveedor);
         /* ejecutar la consulta */
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
         /* cerrar sentencia */
        $stmt->close();
    }
    $mysqli -> close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Actualizar Proveedor</title>
  </head>
<body>
    <h1>Actualizar Proveedor</h1>
    <form action="proveedor_guardar.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Razón Social</label>
        <input name="razon_social" value="<?php echo $fila["razon_social"]; ?>"  type="text" class="form-control" id="exampleInputEmail1">
        
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">RFC</label>
        <input name="rfc" value="<?php echo $fila["rfc"]; ?>" type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Domicilio</label>
        <input name="domicilio" value="<?php echo $fila["domicilio"]; ?>" type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <input type="hidden" name="id_proveedor" value="<?php echo $fila["id_proveedor"]; ?>">
    <input value="Actualizar" type="submit" class="btn btn-primary">
    </form>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
</html>

