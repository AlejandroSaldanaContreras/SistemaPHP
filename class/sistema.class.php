<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    Class Sistema extends Database{

        function VerificarPermiso($permiso){
            $mensaje = "";
            if(isset($_SESSION)){
                if($_SESSION['validado']){
                    $permisos = $_SESSION['permiso'];
                    /*echo ("<pre>");
                    print_r($_SESSION['permiso']);
                    echo ("</pre>");
                    die();*/
                    if(in_array($permiso, $permisos)){
                        print_r('find aguja en el pajar');
                    }else{
                        $mensaje = "Usted no tiene el permiso para realizar esta acción";
                        include($_SERVER['DOCUMENT_ROOT']."/sistema/login/login.php");
                        die();
                    }
                }else{
                    $this->LogOut();
                }
            }else{
                $this->LogOut();
            }
        }

        function Validar($correo, $contrasena){
            $contrasena = md5($contrasena);
            $this->connect();
            $_SESSION['validado']=false;
            $sql = 'SELECT id_usuario, correo FROM usuario WHERE correo=? AND contrasena=?';
            $datos = array();
            
            if($stmt = $this->con->prepare($sql)){
                
                $stmt->bindParam(1, $correo);
                $stmt->bindParam(2, $contrasena);
                $stmt->execute();
                $datos = $stmt->fetchAll();
                
                if(isset($datos[0])){
                    $_SESSION['validado']=true;
                    $_SESSION['id_usuario']=$datos[0]['id_usuario'];
                    $_SESSION['correo']=$datos[0]['correo'];
                    $rol=array();
                    $permiso=array();
                    $sql = 'SELECT r.id_rol, r.rol FROM rol r INNER JOIN usuario_rol ur ON r.id_rol = ur.id_rol WHERE ur.id_usuario = ?';
                    $sql_permiso = 'SELECT p.id_permiso, p.permiso 
                                        FROM permiso p INNER JOIN rol_permiso rp ON p.id_permiso = rp.id_permiso 
                                        INNER JOIN rol r ON rp.id_rol = r.id_rol
                                        INNER JOIN usuario_rol ur ON r.id_rol=ur.id_rol
                                        WHERE ur.id_usuario=?';


                    if($stmt = $this->con->prepare($sql)){
                        $stmt->bindParam(1, $datos[0]['id_usuario']);
                        $stmt->execute();
                        $rol = $stmt->fetchAll();
                        $_SESSION['rol']=$rol;
                    }   
                    
                    if($stmt = $this->con->prepare($sql_permiso)){
                        $stmt->bindParam(1, $datos[0]['id_usuario']);
                        $stmt->execute();
                        $permiso = $stmt->fetchAll();
                        $_SESSION['permiso']=$permiso;
                    }    


                    return true;
                }else{
                    return false;
                }
            }
            $this->close();

        }

        function LogOut(){
            session_destroy();
            $mensaje = "Usted ha salido del sistema, por favor vuelva a ingresar";
            echo $mensaje;
            header("Location: ../login/login.php?mensaje=1");
            //include("../login/login.php");
            die();
        }

        function verificarCorreo($correo){
            $this->connect();
            $datos=array();
            $sql="SELECT * FROM usuario WHERE correo=?";
            if($stmt = $this->con->prepare($sql)){
                $stmt->bindParam(1,$correo);
                $stmt->execute();
                $datos = $stmt->fetchAll();
            }
            if(!isset($datos[0])){
                return false;
            }
            $this->close();
            return true;
        }

        function VerificarToken($correo, $token){
            if($this->verificarCorreo($correo)&!is_null($token)){
                $this->connect();
                $sql = "SELECT * FROM usuario WHERE correo=? AND token=?";
                if($stmt= $this->con->prepare($sql)){
                    $stmt->bindParam(1,$correo);
                    $stmt->bindParam(2,$token);
                    $stmt->execute();
                    $fila = $stmt->fetchAll();
                    if(isset($fila[0])){
                        return true;
                    }
                }
                $this->close();
            }
            return false;
        }

        function recuperarContrasena($correo){
            $this->connect();
            $token = substr(md5($correo.sha1($correo."cruzazul").random_int(0, 1000000)),0,16);
            $sql = "UPDATE usuario SET token = ? WHERE correo = ?";
            if($stmt = $this->con->prepare($sql)){
                $stmt->bindParam(1, $token);
                $stmt->bindParam(2, $correo);
                $stmt->execute();
                $mensaje = "Estimado usuario, presione el vinculo para recuperar su contraseña: <br> 
                            http://localhost/sistema/login/login.php?action=reestablecer&correo=$correo&token=$token";

                $this->enviarCorreo($correo, 'usuario', 'recuperacion de contrasena',$mensaje);
            }

            $this->close();
        }

        function cambiarContrasena($correo, $contrasena){
            $contrasena=md5($contrasena);
            $this->connect();
            $sql="UPDATE usuario SET contrasena=?, token=null WHERE correo=?";
            if($stmt = $this->con->prepare($sql)){
                $stmt->bindParam(1, $contrasena);
                $stmt->bindParam(2, $correo);
                $stmt->execute();
            }
            $this->close();
        }

        function enviarCorreo($destinatario, $nombre, $asunto, $mensaje ){

            require $_SERVER['DOCUMENT_ROOT'].'/sistema/vendor/autoload.php';
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = '16031202@itcelaya.edu.mx';
            $mail->Password = '';
            $mail->setFrom('from@example.com', 'First Last');
            $mail->addReplyTo('replyto@example.com', 'First Last');
            $mail->addAddress($destinatario, $nombre);
            $mail->Subject = $asunto;
            $mail->msgHTML($mensaje);
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';

            }


        }
    }

    $sistema = new Sistema;
?>
