<?php 
    require_once("database.class.php");

    class Inventario extends Database{
        var $id_inventario;
        var $id_proveedor;
        var $folio;
        var $fecha;
        
        var $id_producto;
        var $cantidad;
        var $precio_referencia;

        function getIdInventario(){return $this->id_inventario;}
        function getFolio(){return $this->folio;}
        function getFecha(){return $this->fecha;}
        function getIdProveedor(){return $this->id_proveedor;}
        function getIdProducto(){return $this->id_producto;}
        function getCantidad(){return $this->cantidad;}
        function getPrecio(){return $this->precio_referencia;}

        function setIdInventario($id_inventario){return $this->id_inventario = $id_inventario;}
        function setFolio($folio){return $this->folio = $folio;}
        function setFecha($fecha){return $this->fecha = $fecha;}
        function setIdProveedor($id_proveedor){return $this->id_proveedor = $id_proveedor;}
        function setIdProducto($id_producto){return $this->id_producto = $id_producto;}
        function setCantidad($cantidad){return $this->cantidad = $cantidad;}
        function setPrecio($precio_referencia){return $this->precio_referencia = $precio_referencia;}

        function transaccion(){
            $this->connect();
            $this->con->beginTransaction();
            $folio = substr(md5(rand(1,1000)), 0, 8);
            $sql = "INSERT INTO inventario(folio, fecha, id_proveedor) VALUES (?,?,?)";
            $sql_sel = "SELECT id_inventario FROM inventario WHERE folio = ?";
            $sql_ins = "INSERT INTO inventario_detalle(id_inventario, id_producto, cantidad, precio_referencia) VALUES (?,?,?,?)";

            if($stmt = $this->con->prepare($sql)){
                $fecha = $this->getFecha();
                $id_proveedor = $this->getIdProveedor();
                $stmt->bindParam(1,$folio);
                $stmt->bindParam(2,$fecha);
                $stmt->bindParam(3,$id_proveedor);
                $stmt->execute();

                if($stmt = $this->con->prepare($sql_sel)){
                    $stmt->bindParam(1,$folio);
                    $stmt->execute();
                    $id_inventario = $stmt->fetchAll();
                    $id_inventario = $id_inventario[0]['id_inventario'];
                    
                    if($stmt = $this->con->prepare($sql_ins)){
                        $id_producto = $this->getIdProducto();
                        $cantidad = $this->getCantidad();
                        $precio_referencia = $this->getPrecio();
                        $stmt->bindValue(1,$id_inventario);
                        $stmt->bindValue(2,$id_producto);
                        $stmt->bindValue(3,$cantidad);
                        $stmt->bindValue(4,$precio_referencia);
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

        function leerTransaccion(){
            $this->connect();
            $datos = array();
            $result = $this->con->query("SELECT i.folio, i.fecha, i.id_proveedor, id.id_producto, id.cantidad, id.precio_referencia FROM
                                        inventario i INNER JOIN inventario_detalle id ON i.id_inventario = id.id_inventario");
            $datos = $result->fetchAll();
            $this->close();
            return $datos;
        }
        
    }

    $inventario = new Inventario;
?>