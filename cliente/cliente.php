<?php 
    include("../class/cliente.class.php");
    $action = (isset($_GET["action"]))?$_GET["action"]: null;
    $sistema->VerificarPermiso('Cliente');
    switch($action){
        case 'new':
            $datos = [
                "apaterno"=> (isset($_POST["apaterno"]))?$_POST["apaterno"]:"algun apaterno",
                "amaterno"=> (isset($_POST["amaterno"]))?$_POST["amaterno"]:"algun amaterno",
                "nombre"=> (isset($_POST["nombre"]))?$_POST["nombre"]:"algun nombre",
                "nacimiento"=> (isset($_POST["nacimiento"]))?$_POST["nacimiento"]:"xxxx-xx-xx",
                "rfc"=> (isset($_POST["rfc"]))?$_POST["rfc"]:"XXXXX000XX",
                "domicilio"=> (isset($_POST["domicilio"]))?$_POST["domicilio"]:"algun domicilio",

            ];
            $cliente->setApaterno($datos['apaterno']);
            $cliente->setAmaterno($datos['amaterno']);
            $cliente->setNombre($datos['nombre']);
            $cliente->setNacimiento($datos['nacimiento']);
            $cliente->setRfc($datos['rfc']);
            $cliente->setDomicilio($datos['domicilio']);
            $cliente->CrearCliente();
            header("Location:cliente.php");
            break;

        case 'modify':
            $datos = [
                "apaterno"=> (isset($_POST["apaterno"]))?$_POST["apaterno"]:"algun apaterno",
                "amaterno"=> (isset($_POST["amaterno"]))?$_POST["amaterno"]:"algun amaterno",
                "nombre"=> (isset($_POST["nombre"]))?$_POST["nombre"]:"algun nombre",
                "nacimiento"=> (isset($_POST["nacimiento"]))?$_POST["nacimiento"]:"xxxx-xx-xx",
                "rfc"=> (isset($_POST["rfc"]))?$_POST["rfc"]:"XXXXX000XX",
                "domicilio"=> (isset($_POST["domicilio"]))?$_POST["domicilio"]:"algun domicilio",
                "id_cliente"=> ($_POST["id_cliente"])

            ];

            $cliente->setApaterno($datos['apaterno']);
            $cliente->setAmaterno($datos['amaterno']);
            $cliente->setNombre($datos['nombre']);
            $cliente->setNacimiento($datos['nacimiento']);
            $cliente->setRfc($datos['rfc']);
            $cliente->setDomicilio($datos['domicilio']);
            $cliente->setIdCliente($datos['id_cliente']);
            
            $cliente->modificarCliente();
            header("Location:cliente.php");
            break;     

        case 'form':
            $id_cliente=(isset($_GET["id_cliente"]))?$_GET["id_cliente"]:null;
            $data = [
                "apaterno"=> "",
                "amaterno"=> "",
                "nombre"=> "",
                "nacimiento"=> "",
                "rfc"=> "",
                "domicilio"=> ""
            ];
            
            if(is_numeric($id_cliente)){
                $cliente->setIdCliente($id_cliente);
                $data = $cliente->LeerUnCliente();
                $script = "cliente.php?action=modify";
                include("view/form.php");

            }else{

                $script = "cliente.php?action=new"; 
                include("view/form.php");
            }
            break;   

        case 'delete':
            $id_cliente=(isset($_GET["id_cliente"]))?$_GET["id_cliente"]:null;
            if(is_numeric($id_cliente)){
                $cliente->setIdCliente($id_cliente);
                $cliente->BorrarCliente();
            }
            header("Location:cliente.php");    
            break;

        case 'show':
            default:
                $data = $cliente->LeerCliente();
                include("view/index.php");
                break;
    }
?>
