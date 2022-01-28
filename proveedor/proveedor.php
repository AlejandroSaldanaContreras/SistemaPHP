<?php 
    include("../class/proveedor.class.php");
    $action = (isset($_GET["action"]))?$_GET["action"]: null;
    
    switch($action){
        case 'new':
            $sistema->VerificarPermiso('Crear Proveedor');
            $datos = [
                "razon_social"=> (isset($_POST["razon_social"]))?$_POST["razon_social"]:"alguna razon social",
                "rfc"=> (isset($_POST["rfc"]))?$_POST["rfc"]:"XXAX000000XXX",
                "domicilio"=> (isset($_POST["domicilio"]))?$_POST["domicilio"]:"algun domicilio"
            ];
            $proveedor->setRazonSocial($datos["razon_social"]);
            $proveedor->setRfc($datos["rfc"]);
            $proveedor->setDomicilio($datos["domicilio"]);
            $proveedor->CrearProveedor();
            header("Location:proveedor.php");
            break;
        case 'modify':
            $sistema->VerificarPermiso('Actualizar Proveedor');
            $datos = [
                "razon_social"=> (isset($_POST["razon_social"]))?$_POST["razon_social"]:"alguna razon social",
                "rfc"=> (isset($_POST["rfc"]))?$_POST["rfc"]:"XXAX000000XXX",
                "domicilio"=> (isset($_POST["domicilio"]))?$_POST["domicilio"]:"algun domicilio",
                "id_proveedor"=> ($_POST["id_proveedor"])
            ];
            $proveedor->setIdProveedor($datos["id_proveedor"]);
            $proveedor->setRazonSocial($datos["razon_social"]);
            $proveedor->setRfc($datos["rfc"]);
            $proveedor->setDomicilio($datos["domicilio"]);
            $proveedor->modificarProveedor();
            header("Location:proveedor.php");
            break;  

        case 'form':
            $id_proveedor=(isset($_GET["id_proveedor"]))?$_GET["id_proveedor"]:null;
            $data = [
                "razon_social"=>"",
                "rfc"=>"",
                "domicilio"=>""
            ];
            if(is_numeric($id_proveedor)){
                $sistema->VerificarPermiso('Actualizar Proveedor');
                $proveedor->setIdProveedor($id_proveedor);
                $data = $proveedor->LeerUnProveedor();
                $script = "proveedor.php?action=modify";
                include("view/form.php");

            }else{
                $sistema->VerificarPermiso('Crear Proveedor');
                $script = "proveedor.php?action=new"; 
                include("view/form.php");
            }
            break;    

        case 'delete':
            $sistema->VerificarPermiso('Borrar Proveedor');
            $id_proveedor=(isset($_GET["id_proveedor"]))?$_GET["id_proveedor"]:null;
            if(is_numeric($id_proveedor)){
                $proveedor->setIdProveedor($id_proveedor);
                $proveedor->BorrarProveedor();
            }
            header("Location:proveedor.php");    
            break;

        case 'opinion_cumplimiento':
            $id_proveedor=(isset($_GET["id_proveedor"]))?$_GET["id_proveedor"]:null;
            if(is_numeric($id_proveedor)){
                $proveedor->setIdProveedor($id_proveedor);
                $proveedor->LeerOpinion();
            }
            break;

        case 'reporteproveedor':
            
            $sistema->VerificarPermiso('Leer Proveedor');
            $proveedor->reporteProveedor();
            break;    

        case 'show':
        default:
            $sistema->VerificarPermiso('Leer Proveedor');
            $data = $proveedor->LeerProveedor();
            include("view/index.php");
            break;    
    }
?>