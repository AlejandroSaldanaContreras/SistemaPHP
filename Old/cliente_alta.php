<?php
    
    $apaterno = $_POST["apaterno"];
    $amaterno = $_POST["amaterno"];
    $nombre= $_POST["nombre"];
    $nacimiento = date('Y-m-d', strtotime($_POST['nacimiento']));
    $rfc = $_POST["rfc"];
    $domicilio = $_POST["domicilio"];

    $mysqli = new mysqli("localhost", "administrador", "alex130798", "sistema");

    if ($stmt = $mysqli->prepare("INSERT INTO cliente(apaterno, amaterno, nombre, nacimiento, rfc, domicilio) VALUES (?,?,?,?,?,?)")) {

        /* ligar parámetros para marcadores */
        $stmt->bind_param("ssssss", $apaterno, $amaterno, $nombre, $nacimiento, $rfc, $domicilio);
    
        /* ejecutar la consulta */
        $stmt->execute();
        
    
        /* cerrar sentencia */
        $stmt->close();

    }
    

    $mysqli->close();

    header("Location: cliente.php");
?>