<?php
    $razon_social = $_POST["razon_social"];
    $rfc = $_POST["rfc"];
    $domicilio = $_POST["domicilio"];
    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("INSERT INTO proveedor(razon_social, rfc, domicilio) VALUES (?,?,?)")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("sss", $razon_social, $rfc, $domicilio);
    
        /* ejecutar la consulta */
        $stmt->execute();
        
    
        /* cerrar sentencia */
        $stmt->close();

    }
    

    $mysqli->close();

    header("Location: proveedor.php");
?>