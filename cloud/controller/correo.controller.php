<?php
require_once 'model/correo.model.php';

class CorreoController extends InitController{

  private $correo;

  public function __CONSTRUCT(){
      $this->correo = new CorreoModel();
  }

  public function cargarMensajes(){
     $result  = $this->correo->MisMensajes();
     if($result == 0){
       $result = 0;
     }else{
       $result = count($result);
     }

     return $result;
  }

  public function Mensaje($pid){
     $result = $this->correo->ResponderMensaje($pid);
     return $result;
  }

  public function enviarMensaje(){
     $data = $_POST['data'];
     $result = $this->correo->GuardarMensaje($data);
     if($result[0]==1){
       $msj = "true";
     }elseif($result[0]==0){
       $msj = "false";
     }
     header("Location: mis-mensajes".$msj."");
     return $result;
  }

  public function MensajeNoLeidos(){
     $result = $this->correo->estadoMensajes();
     return $result;
  }

  public function BorrarMensaje(){
     $corr_codigo = $_GET['pid'];
     $result = $this->correo->EliminarMensaje($corr_codigo);
     if($result[0]==1){
       $msj = "trueD";
     }elseif($result[0]==0){
       $msj = "false";
     }
     header("Location: mis-mensajes".$msj."");
     return $result;
  }

  public function correoLeido(){
     $mensaje_codigo = $_POST['mensaje_id'];
     $result = $this->correo->estadoLeido($mensaje_codigo);

     return $result;
  }

  public function buscarCorreo(){
     $email_buscar = $_GET['term'];
     $result = $this->correo->cargarCorreo($email_buscar);
     foreach ($result as $value) {
       $txt_destinatario = $value['poet_email'];
       $row_array['value'] = $value['poet_nick']." (". $value['poet_email'] . ")";
       array_push($return_arr,$row_array);
     }
     echo json_encode($return_arr);
  }

}
?>
