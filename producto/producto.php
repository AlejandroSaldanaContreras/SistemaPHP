<?php 
    include("../class/producto.class.php");
    include("../class/proveedor.class.php");
    $action = (isset($_GET["action"]))?$_GET["action"]: null;
    $sistema->VerificarPermiso('Producto');
    switch($action){
        case 'new':
            $datos = [
                "producto"=> (isset($_POST["producto"]))?$_POST["producto"]:"algun producto",
                "id_proveedor"=> (isset($_POST["id_proveedor"]))?$_POST["id_proveedor"]:"XXAX000000XXX",
                "precio"=> (isset($_POST["precio"]))?$_POST["precio"]:"algun precio"
                
            ];
            $producto ->setProducto($datos['producto']);
            $producto ->setIdProveedor($datos['id_proveedor']);
            $producto ->setPrecio($datos['precio']);
            $producto->CrearProducto();
            header("Location:producto.php");
            break;

        case 'modify':
            $datos = [
                "producto"=> (isset($_POST["producto"]))?$_POST["producto"]:"algun producto",
                "id_proveedor"=> (isset($_POST["id_proveedor"]))?$_POST["id_proveedor"]:"XXAX000000XXX",
                "precio"=> (isset($_POST["precio"]))?$_POST["precio"]:"algun precio",
                "id_producto" =>($_POST["id_producto"])
            ];
            $producto ->setIdProducto($datos['id_producto']);
            $producto ->setProducto($datos['producto']);
            $producto ->setIdProveedor($datos['id_proveedor']);
            $producto ->setPrecio($datos['precio']);
            $producto->modificarProducto();
            header("Location:producto.php");
            break;
            
        case 'form':
                $id_producto=(isset($_GET["id_producto"]))?$_GET["id_producto"]:null;
                $data = [
                    "producto"=>"",
                    "id_proveedor"=>"",
                    "precio"=>""
                ];

                $data_proveedor = $proveedor->LeerProveedor();
                if(is_numeric($id_producto)){
                    $producto->setIdProducto($id_producto);
                    $data = $producto->LeerUnProducto();
                    $script = "producto.php?action=modify";
                    include("view/form.php");
    
                }else{
    
                    $script = "producto.php?action=new"; 
                    include("view/form.php");
                }
            break;
        
        case 'delete':
                $id_producto=(isset($_GET["id_producto"]))?$_GET["id_producto"]:null;
                if(is_numeric($id_producto)){
                    $producto->setIdProducto($id_producto);
                    $producto->BorrarProducto();
                }
                header("Location:producto.php");    
                break;   
                
        case 'show':
        default:
            $data = $producto->LeerProducto();
            include("view/index.php");
            break;        
    }           
?>