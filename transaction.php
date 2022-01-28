<?php 
    include_once("class/database.class.php");
    
    class Transaction extends Database{

        function transaccion(){
            $this->connect();
            $this->con->beginTransaction();
            $sql = "INSERT INTO inventario(folio, fecha, id_proveedor) VALUES('12345678','19-07-1999','1')";
            $sql_sel = "SELECT id_inventario FROM inventario WHERE folio = '12345678'";
            $sql_ins = "INSERT INTO inventario_detalle(id_inventario, id_producto, cantidad, precio_referencia) VALUES (?,?,?,?)";

            if($stmt = $this->con->prepare($sql)){
                $stmt -> execute();
                if($stmt = $this->con->prepare($sql_sel)){
                    $stmt-> execute();
                    $id_inventario = $stmt->fetchAll();
                    $id_inventario = $id_inventario[0]['id_inventario'];
                    
                    if($stmt = $this->con->prepare($sql_ins)){
                        $stmt->bindValue(1, $id_inventario);
                        $stmt->bindValue(2, 1);
                        $stmt->bindValue(3, 100);
                        $stmt->bindValue(4, 12.50);
                        $stmt->execute();

                        $stmt->bindValue(1, $id_inventario);
                        $stmt->bindValue(2, 2);
                        $stmt->bindValue(3, 50);
                        $stmt->bindValue(4, 18);
                        $stmt->execute();

                        $stmt->bindValue(1, $id_inventario);
                        $stmt->bindValue(2, 3);
                        $stmt->bindValue(3, 120);
                        $stmt->bindValue(4, 22);
                        $stmt->execute();

                        $this->con->commit(); 
                        $this->close();
                        return true;
                    }
                }       

            }
            $this->con->rollback();
            $this->close();
        }

    }

    $transaccion = new Transaction();
    $transaccion->transaccion();
    

?>