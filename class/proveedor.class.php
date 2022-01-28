<?php 
    require_once("database.class.php");
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;
    class Proveedor extends Database{
        var $id_proveedor;
        var $razon_social;
        var $rfc;
        var $domicilio;
        var $opinion_cumplimiento;


        
        //? GETTERS
        function getIdProveedor(){return $this->id_proveedor;}
        function getRazonSocial(){return $this->razon_social;}
        function getRfc(){return $this->rfc;}
        function getDomicilio(){return $this->domicilio;}
        function getOpinionCumplimiento(){return $this->opinion_cumplimiento;}

        //? SETTERS
        function setIdProveedor($id_proveedor){return $this->id_proveedor = $id_proveedor;}
        function setRazonSocial($razon_social){return $this->razon_social = $razon_social;}
        function setRfc($rfc){return $this->rfc = $rfc;}
        function setDomicilio($domicilio){return $this->domicilio = $domicilio;}
        function setOpinionCumplimiento($opinion_cumplimiento){return $this->opinion_cumplimiento = $opinion_cumplimiento;}
        

        function CrearProveedor(){
            $this-> connect();
            if ($stmt = $this->con->prepare("INSERT INTO proveedor(razon_social, rfc, domicilio, opinion_cumplimiento) VALUES (?,?,?,?)")) {
                $fp = fopen($_FILES['opinion_cumplimiento']['tmp_name'], 'rb');
                $razon_social = $this->getRazonSocial();
                $rfc = $this->getRfc();
                $domicilio = $this->getDomicilio();
                $stmt->bindParam(1, $razon_social);
                $stmt->bindParam(2, $rfc);
                $stmt->bindParam(3, $domicilio);
                $stmt->bindParam(4, $fp, PDO::PARAM_LOB);
                $stmt->execute();
            }
            $this->close();
        }

        function LeerOpinion(){
            $this-> connect();
            $datos = array();
            
            if($stmt = $this->con->prepare("SELECT opinion_cumplimiento FROM proveedor WHERE id_proveedor = ?")){
                $id = $this->getIdProveedor();
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $stmt->bindColumn(1, $lob, PDO::PARAM_LOB);
                $stmt->fetch(PDO::FETCH_BOUND);
                header("Content-Type: application/pdf");
                echo $lob;
            }
            $this->close();
        }
        
        function LeerProveedor(){
            $this->connect();
            $datos = array();
            $result = $this->con->query("SELECT * FROM proveedor ");
            $datos = $result->fetchAll();   
            $this->close();
            
            return $datos;
        }

        function LeerProveedorJSON(){
            $datos = $this->LeerProveedor();
            header('Content-Type: application/json');
            echo json_encode($datos);
        }
        
        function BorrarProveedor(){
            $this->connect();
            if ($stmt = $this->con->prepare("DELETE FROM proveedor WHERE id_proveedor=?")) {
                $id_proveedor = $this->getIdProveedor();
                $stmt->bindParam(1, $id_proveedor);
                $stmt->execute();
                //$stmt->close();
            }    
            $this->close();
            
        }

        
        function modificarProveedor(){
            $this->connect();
            if($_FILES['opinion_cumplimiento']['name']){
                $sql = 'UPDATE proveedor SET razon_social=?, rfc=?, domicilio=?, opinion_cumplimiento=? WHERE id_proveedor=?';
                $fp = fopen($_FILES['opinion_cumplimiento']['tmp_name'], 'rb');
            }else{
                $sql="UPDATE proveedor SET razon_social=?, rfc=?, domicilio=? WHERE id_proveedor=?";
            }
            if ($stmt = $this->con->prepare($sql)){
                $datos=[
                    'id_proveedor' => $this->getIdProveedor(),
                    'razon_social' => $this->getRazonSocial(),
                    'rfc' => $this->getRfc(),
                    'domicilio' => $this->getDomicilio()
                ];
                $stmt->bindParam(1, $datos['razon_social']);
                $stmt->bindParam(2, $datos['rfc']);
                $stmt->bindParam(3, $datos['domicilio']);
                if($_FILES['opinion_cumplimiento']['name']){
                    $stmt->bindParam(4, $fp, PDO::PARAM_LOB);
                    $stmt->bindParam(5, $datos['id_proveedor']);
                }else{
                    $stmt->bindParam(4, $datos['id_proveedor']);
                }
                $stmt->execute();
                //$stmt->close();
            }
            $this->close();
        }
        
        

        function LeerUnProveedor(){
            $this-> connect();
            $datos = array();
            
            if($stmt = $this->con->prepare("SELECT * FROM proveedor WHERE id_proveedor = ?")){
                $id = $this->getIdProveedor();
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $datos = $stmt->fetchAll();
                return $datos[0];
                //$stmt->close(); 
            }
            $this->close();
        }

        function reporteProveedor(){
            require $_SERVER['DOCUMENT_ROOT'].'/sistema/vendor/autoload.php';
            try {
                $content = '<page><h1 style= "color:green" >Proveedores</h1>';
                $datos = $this->LeerProveedor();
                $content.= "<table>";
                $content.= "<tr><th>ID</th><th>RFC</th><th>Razón Social</th></tr>";
                foreach($datos as $key => $value){
                    $content.= "<tr>";
                    $content.= "<td>".$value['id_proveedor']."</td>";
                    $content.= "<td>".$value['rfc']."</td>";
                    $content.= "<td>".$value['razon_social']."</td>";
                    $content.= "</tr>";
                }
                $content.="</table>";
                $content.= "</page>";
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($content);
                $html2pdf->output('example01.pdf');
            } catch (Html2PdfException $e) {
                $html2pdf->clean();

                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }   

    $proveedor = new Proveedor;

    
?>