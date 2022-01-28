<?php
    $id_proveedor = $_POST["id_proveedor"];
    $razon_social = $_POST["razon_social"];
    $rfc= $_POST["rfc"];
    $domicilio = $_POST["domicilio"];

    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("UPDATE proveedor SET razon_social=?, rfc = ?, domicilio = ? WHERE id_proveedor = ?")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("sssi", $razon_social, $rfc, $domicilio, $id_proveedor);
    
        /* ejecutar la consulta */
        $stmt->execute();
        
    
        /* cerrar sentencia */
        $stmt->close();

    }
    

    $mysqli->close();

    header("Location: proveedor.php");
?>