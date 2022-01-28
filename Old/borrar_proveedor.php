<?php
    
    $id_proveedor = $_GET["id_proveedor"];
    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("DELETE FROM proveedor WHERE id_proveedor=?")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id_proveedor);
    
        /* ejecutar la consulta */
        $stmt->execute();
    
        /* cerrar sentencia */
        $stmt->close();

    }

    $mysqli->close();

    header("Location: proveedor.php");
?>