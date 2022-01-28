<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/sistema/class/database.class.php");
    $action = (isset($_GET["action"]))?$_GET["action"]: null;

    switch($action){
        case 'validate':
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            if($sistema->Validar($correo, $contrasena)){
                header("Location: ../index.php");
            }else{
                $sistema->LogOut();
            }    
        break;
        
        case 'LogOut':
            $sistema->LogOut();
        break;

        case 'recuperar':
            include("view/recuperar.php");
        break;    

        case 'verificarCorreo':
            $correo = $_POST['correo'];
            if(!$sistema->verificarCorreo($correo)){
                $mensaje = "El correo electronico no se encuentra registrado";
                include("view/recuperar.php");
                die();
            }
            $sistema->recuperarContrasena($correo);
        break;

        case 'reestablecer':
            $correo = $_GET['correo'];
            $token = $_GET['token'];
            if($sistema->verificarToken($correo, $token)){
                include("view/reestablecer.php");
                die();
            }else{
                die("Error desconocido");
            }
        break;

        case 'cambiarcontrasena':
            $correo = $_POST['correo'];
            $token = $_POST['token'];
            $contrasena = $_POST['contrasena'];
            if($sistema->verificarToken($correo,  $token)){
                $sistema->cambiarContrasena($correo, $contrasena);
                die("La contraseña ha sido modificada");
            }else{
                die("Error desconocido");
            }
        break;
            
        default:
        include_once('view/login.php');
    }

?>    