<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Proveedores</title>
  </head>
  <body>
    <h1>Proveedores</h1>

    <?php
    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");
    $result = $mysqli->query("SELECT * FROM proveedor ");
    ?>
        <a class="btn btn-success" href="nuevo_proveedor.php" role="button">Nuevo Proveedor</a>
        <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Proveedor</th>
            <th scope="col">Razón Social</th>
            <th scope="col">RFC</th>
            <th scope="col">Domicilio</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr> 
        </thead>
        <tbody>
            <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {

            ?>
                <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $row["razon_social"]; ?></td>
                <td><?php echo $row["rfc"]; ?></td>
                <td><?php echo $row["domicilio"]; ?></td>
                <td><a class="btn btn-secondary" href="modificar_proveedor.php?id_proveedor= <?php echo $row["id_proveedor"]; ?>" role="button">Actualizar</a></td>
                <td><a class="btn btn-danger" href="borrar_proveedor.php?id_proveedor= <?php echo $row["id_proveedor"]; ?>" role="button">Eliminar</a></td>
                </tr>

            <?php
                $i++;  
                }
            ?>            
            
        </tbody>
        </table>
    

  </body> 
  
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
</html>




