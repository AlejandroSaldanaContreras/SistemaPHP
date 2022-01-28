<?php

    $id_cliente = $_POST["id_cliente"];
    $apaterno = $_POST["apaterno"];
    $amaterno = $_POST["amaterno"];
    $nombre = $_POST["nombre"];
    $nacimiento = date('Y-m-d', strtotime($_POST['nacimiento']));
    $rfc = $_POST["rfc"];
    $domicilio = $_POST["domicilio"];

    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("UPDATE cliente SET apaterno=?, amaterno=?, nombre=?, nacimiento=?, rfc=?, domicilio=? WHERE id_cliente= ?")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("ssssssi", $apaterno, $amaterno, $nombre, $nacimiento, $rfc, $domicilio, $id_cliente);
    
        /* ejecutar la consulta */
        $stmt->execute();
        
    
        /* cerrar sentencia */
        $stmt->close();

    }
    

    $mysqli->close();

    header("Location: cliente.php");
?>