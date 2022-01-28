<?php 
    include("../class/inventario.class.php");
    include("../class/producto.class.php");
    include("../class/proveedor.class.php");
    $action = (isset($_GET["action"]))?$_GET["action"]: null;

    switch($action){
        case 'new':
            $datos = [
                "id_proveedor"=> (isset($_POST["id_proveedor"]))?$_POST["id_proveedor"]:"XXAX000000XXX",
                "folio"=> (isset($_POST["folio"]))?$_POST["folio"]:"XXXXXXXX",
                "fecha"=> (isset($_POST["fecha"]))?$_POST["fecha"]:"0000-00-00",
                "id_producto"=> (isset($_POST["id_producto"]))?$_POST["id_producto"]:"0",
                "cantidad"=> (isset($_POST["cantidad"]))?$_POST["cantidad"]:"0",
                "precio_referencia"=> (isset($_POST["precio_referencia"]))?$_POST["precio_referencia"]:"0",
            ];
            $inventario->setIdProveedor($datos['id_proveedor']);
            $inventario->setFolio($datos['folio']);
            $inventario->setFecha($datos['fecha']);
            $inventario->setIdProducto($datos['id_producto']);
            $inventario->setCantidad($datos['cantidad']);
            $inventario->setPrecio($datos['precio_referencia']);
            $inventario->transaccion();
            header("Location:inventario.php");
            break;

        case 'form':
            $id_cliente=(isset($_GET["id_cliente"]))?$_GET["id_cliente"]:null;
            $script = "inventario.php?action=new"; 
            $data_proveedor = $proveedor->LeerProveedor();
            $data_producto = $producto->LeerProducto();
            include("view/form.php");  
            
            break;
        case 'show':
            default:
            $data = $inventario->leerTransaccion();
            include("view/index.php");
            break;
    }
?>