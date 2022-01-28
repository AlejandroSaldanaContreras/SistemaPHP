<?php
    
    $id_cliente = $_GET["id_cliente"];
    print_r($id_cliente);
    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("DELETE FROM cliente WHERE id_cliente=?")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id_cliente);    
    
        /* ejecutar la consulta */
        $stmt->execute();
    
        /* cerrar sentencia */
        $stmt->close();

    }

    $mysqli->close();

    header("Location: cliente.php");
?>