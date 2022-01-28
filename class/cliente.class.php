<?php 
    require_once("database.class.php");
    Class Cliente extends Database{
        var $id_cliente;
        var $apaterno; 
        var $amaterno;
        var $nombre; 
        var $nacimiento;
        var $rfc;
        var $domicilio;

        //? GETTERS
        function getIdCliente(){return $this->id_cliente;}
        function getApaterno(){return $this->apaterno;}
        function getAmaterno(){return $this->amaterno;}
        function getNombre(){return $this->nombre;}
        function getNacimiento(){return $this->nacimiento;}
        function getRfc(){return $this->rfc;}
        function getDomicilio(){return $this->domicilio;}

        //? SETTERS
        function setIdCliente($id_cliente){return $this->id_cliente = $id_cliente;}
        function setApaterno($apaterno){return $this->apaterno = $apaterno;}
        function setAmaterno($amaterno){return $this->amaterno = $amaterno;}
        function setNombre($nombre){return $this->nombre = $nombre;}
        function setNacimiento($nacimiento){return $this->nacimiento = $nacimiento;}
        function setRfc($rfc){return $this->rfc = $rfc;}
        function setDomicilio($domicilio){return $this->domicilio = $domicilio;}

        function CrearCliente(){
            $this-> connect();
            $_FILES['foto']['name'] = preg_replace('([^A-Za-z0-9_.])', '', $_FILES['foto']['name']);
            if(move_uploaded_file($_FILES['foto']['tmp_name'],'C://xampp/htdocs/sistema/fotos/'.$_FILES['foto']['name'])){
                if ($stmt = $this->con->prepare("INSERT INTO cliente(apaterno, amaterno, nombre, nacimiento, rfc, domicilio, foto) VALUES (?,?,?,?,?,?,?)")) {
                    $apaterno = $this->getApaterno();
                    $amaterno = $this->getAmaterno();
                    $nombre = $this->getNombre();
                    $nacimiento = $this->getNacimiento();
                    $rfc = $this->getRfc();
                    $domicilio = $this->getDomicilio();
                    $stmt->bindParam(1, $apaterno);
                    $stmt->bindParam(2, $amaterno);
                    $stmt->bindParam(3, $nombre);
                    $stmt->bindParam(4, $nacimiento);
                    $stmt->bindParam(5, $rfc);
                    $stmt->bindParam(6, $domicilio);
                    $stmt->bindParam(7,  $_FILES['foto']['name']);
                    $stmt->execute();
                    
                }
            }
            
            $this->close();
        }

        function LeerCliente(){
            $this->connect();
            $datos = array();
            $result = $this->con->query("SELECT * FROM cliente");
            $datos = $result->fetchAll();  
            $this->close();
            return $datos;
        }
    
        function BorrarCliente(){
            $this->connect();
            if ($stmt = $this->con->prepare("DELETE FROM cliente WHERE id_cliente=?")) {
                $id_cliente = $this->getIdCliente();
                $stmt->bindParam(1,$id_cliente);
                $stmt->execute();
            }    
            $this->close();
            
        }
        
        function modificarCliente(){
            
            $this->connect();
            $sql = "";
            if($_FILES['foto']['name']){
                $_FILES['foto']['name'] = preg_replace('([^A-Za-z0-9_.])', '', $_FILES['foto']['name']);
                if(move_uploaded_file($_FILES['foto']['tmp_name'],'C://xampp/htdocs/sistema/fotos/'.$_FILES['foto']['name'])){
                    $sql = "UPDATE cliente SET apaterno=?, amaterno=?, nombre=?, nacimiento=?, rfc=?, domicilio=?, foto=? WHERE id_cliente=?";
                    if ($stmt = $this->con->prepare($sql)){
                        $datos=[
                            'id_cliente' => $this->getIdCliente(),
                            'apaterno' => $this->getApaterno(),
                            'amaterno' => $this->getAmaterno(),
                            'nombre' => $this->getNombre(),
                            'nacimiento' => $this->getNacimiento(),
                            'rfc' => $this->getRfc(),
                            'domicilio' => $this->getDomicilio(),
                            'foto' => $_FILES['foto']['name']
                        ];
                        
                        $stmt->bindParam(1, $datos['apaterno']);
                        $stmt->bindParam(2, $datos['amaterno']);
                        $stmt->bindParam(3, $datos['nombre']);
                        $stmt->bindParam(4, $datos['nacimiento']);
                        $stmt->bindParam(5, $datos['rfc']);
                        $stmt->bindParam(6, $datos['domicilio']);
                        $stmt->bindParam(7, $datos['foto']);
                        $stmt->bindParam(8, $datos['id_cliente']);
                        
                        $stmt->execute();
                        //$stmt->close();
                    }
                }
            }else{
                if ($stmt = $this->con->prepare("UPDATE cliente SET apaterno=?, amaterno=?, nombre=?, nacimiento=?, rfc=?, domicilio=? WHERE id_cliente=?")){
                    $datos=[
                        'id_cliente' => $this->getIdCliente(),
                        'apaterno' => $this->getApaterno(),
                        'amaterno' => $this->getAmaterno(),
                        'nombre' => $this->getNombre(),
                        'nacimiento' => $this->getNacimiento(),
                        'rfc' => $this->getRfc(),
                        'domicilio' => $this->getDomicilio()
                    ];
                    
                    $stmt->bindParam(1, $datos['apaterno']);
                    $stmt->bindParam(2, $datos['amaterno']);
                    $stmt->bindParam(3, $datos['nombre']);
                    $stmt->bindParam(4, $datos['nacimiento']);
                    $stmt->bindParam(5, $datos['rfc']);
                    $stmt->bindParam(6, $datos['domicilio']);
                    $stmt->bindParam(7, $datos['id_cliente']);
                    $stmt->execute();
                    //$stmt->close();
                }
            }

            
            $this->close();
        }

        function LeerUnCliente(){
            $this-> connect();
            $datos = array();
            
            if($stmt = $this->con->prepare("SELECT * FROM cliente WHERE id_cliente = ?")){
                $id = $this->getIdCliente();
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $datos = $stmt->fetchAll();
                return $datos[0];
                //$stmt->close(); 
            }
            $this->close();
        }
    }

    $cliente = new Cliente;

?>
    
