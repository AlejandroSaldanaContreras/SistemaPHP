<?php 
    require_once("database.class.php");
    Class Producto extends Database{
        var $id_producto;
        var $producto;
        var $id_proveedor;
        var $precio;
        var $foto;

        function getIdProducto(){return $this->id_proveedor;}
        function getProducto(){return $this->producto;}
        function getIdProveedor(){return $this->id_proveedor;}
        function getPrecio(){return $this->precio;}
        function getFoto(){return $this->foto;}

        function setIdProducto($id_producto){return $this->id_producto = $id_producto;}
        function setProducto($producto){return $this->producto = $producto;}
        function setIdProveedor($id_proveedor){return $this->id_proveedor = $id_proveedor;}
        function setPrecio($precio){return $this->precio = $precio;}
        function setFoto($foto){return $this->foto = $foto;}

        function CrearProducto(){
            $this-> connect();
            $_FILES['foto']['name'] = preg_replace('([^A-Za-z0-9_.])', '', $_FILES['foto']['name'])
            
            if(move_uploaded_file($_FILES['foto']['tmp_name'],'C://xampp/htdocs/sistema/fotos/'.$_FILES['foto']['name'])){
                if ($stmt = $this->con->prepare("INSERT INTO producto(producto, id_proveedor, precio, foto) VALUES (?,?,?,?)")) {
                    $producto = $this->getProducto();
                    $id_proveedor = $this->getIdProveedor();
                    $precio = $this->getPrecio();
                    $stmt->bindParam(1, $producto);
                    $stmt->bindParam(2, $id_proveedor);
                    $stmt->bindParam(3, $precio);
                    $stmt->bindParam(4,  $_FILES['foto']['name']);
                    $stmt->execute();
                    
                }
            }
            
            
            
            $this->close();
        }

        function LeerProducto(){
            $this->connect();
            $datos = array();
            $result = $this->con->query("SELECT * FROM producto");
            $datos = $result->fetchAll();  
            $this->close();
            return $datos;
        }

        function BorrarProducto(){
            $this->connect();
            if ($stmt = $this->con->prepare("DELETE FROM producto WHERE id_producto=?")) {
                $id_producto = $this->getIdProducto();
                $stmt->bindParam(1,$id_producto);
                $stmt->execute();
            }    
            $this->close();
            
        }

        function LeerUnProducto(){
            $this-> connect();
            $datos = array();
            
            if($stmt = $this->con->prepare("SELECT * FROM producto WHERE id_producto = ?")){
                $id = $this->getIdProducto();
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $datos = $stmt->fetchAll(); 
                return $datos[0];
                //$stmt->close(); 
            }
            $this->close();
        }

        function modificarProducto(){
            $this->connect();
            $sql = "";
            if($_FILES['foto']['name']){
                $_FILES['foto']['name'] = preg_replace('([^A-Za-z0-9_.])', '', $_FILES['foto']['name']);
                if(move_uploaded_file($_FILES['foto']['tmp_name'],'C://xampp/htdocs/sistema/fotos/'.$_FILES['foto']['name'])){
                    $sql = "UPDATE producto SET producto=?, id_proveedor=?, precio=?, foto=? WHERE id_producto=?";
                    if ($stmt = $this->con->prepare($sql)){
                        $datos=[
                            'id_producto' => $this->getIdProducto(),
                            'producto' =>$this->getProducto(),
                            'id_proveedor' => $this->getIdProveedor(),
                            'precio' => $this->getPrecio(),
                            'foto' => $_FILES['foto']['name']
                        ];
                        
                        $stmt->bindParam(1, $datos['producto']);
                        $stmt->bindParam(2, $datos['id_proveedor']);
                        $stmt->bindParam(3, $datos['precio']);
                        $stmt->bindParam(4, $datos['foto']);
                        $stmt->bindParam(5, $datos['id_producto']);
                        $stmt->execute();
                        //$stmt->close();
                    }
                }
            }else{
                if ($stmt = $this->con->prepare("UPDATE producto SET producto=?, id_proveedor=?, precio=? WHERE id_producto=?")){
                    $datos=[
                        'id_producto' => $this->getIdProducto(),
                        'producto' =>$this->getProducto(),
                        'id_proveedor' => $this->getIdProveedor(),
                        'precio' => $this->getPrecio(),
                    ];
                    
                    $stmt->bindParam(1, $datos['producto']);
                    $stmt->bindParam(2, $datos['id_proveedor']);
                    $stmt->bindParam(3, $datos['precio']);
                    $stmt->bindParam(4, $datos['foto']);
                    $stmt->bindParam(5, $datos['id_producto']);
                    $stmt->execute();
                    //$stmt->close();
                }
            }

            
            $this->close();
        }
        

    }
    
    $producto = new Producto;

?>