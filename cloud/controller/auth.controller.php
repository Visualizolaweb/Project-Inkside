<?php
require_once "../vendor/autoload.php";
require_once 'model/poetas.model.php';

class AuthController extends InitController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function registroPoeta(){

      $data =  $_POST["data"];
      $data[0] = InitController::generarPk("POET",4,5); //Metodo para generar la clave PK ("pref", "grupos", "lenght")
      $data[4] = InitController::generarToken(55); //KeyToken
      $data[5] = password_hash($data[5], PASSWORD_DEFAULT);
      $data[6] = "inkside";
      $result = $this->poetas->crearPoeta($data);

      if($result[0] == 1){
        $data = array($data[3], $data[1].' '.$data[2], "activaCuenta", $data[4]);
        $result = InitController::sendMail($data);
      }

      echo json_encode($result);
  }

  public function registroSocial(){
      $data[0] = InitController::generarPk("POET",4,5);
      $data[1] = $_SESSION["poeta"]["poet_nombre"];
      $data[2] = $_SESSION["poeta"]["poet_apellido"];
      $data[3] = $_SESSION["poeta"]["poet_nick"];
      $data[4] = $_SESSION["poeta"]["poet_email"];
      $data[5] = $_SESSION["poeta"]["poet_foto"];
      $data[6] = $_SESSION["poeta"]["poet_fecha_nac"];
      $data[7] = $_SESSION["poeta"]["poet_sexo"];
      $data[8] = $_SESSION["poeta"]["poet_descripcion"];
      $data[9] = "Activo";
      $data[10] = InitController::generarToken(55);
      $data[11] = $_SESSION["poeta"]["acc_social_id"];
      $data[12] = $_SESSION["poeta"]["acc_origen_conexion"];

      $result = $this->poetas->crearPoetaSocial($data);
      header("Location: dashboard");
  }

  public function validoEmail(){
      $data  = $_POST["data"];

      $result = $this->poetas->buscoCampo($data);

      if($result[2] > 0){
         $result = array(0,"El correo ingresado ya existe.");
      }else{
         $result = array(1,"");
      }

      echo json_encode($result);
  }

  public function activoCuenta(){
      $data = base64_decode($_GET["token"]);

      $result = $this->poetas->activoCuenta($data);

      if($result[0] == 1){
        header("Location: completa-perfil");
      }else{
        header("location: index.php?err=".$result[1]);
      }
  }

  public function inicioSesion(){
     $data[0] = $_POST["email"];
     $data[1] = $_POST["pass"];

     $result = $this->poetas->autenticarUsuario($data);

     if(count($result[0]) > 0){
        if(password_verify($data[1],$result["acc_password"])){
            $_SESSION["poeta"]["poet_codigo"]          = $result[0];
            $_SESSION["poeta"]["poet_nombre"]          = $result[1];
            $_SESSION["poeta"]["poet_apellido"]        = $result[2];
            $_SESSION["poeta"]["poet_nick"]            = $result[3];
            $_SESSION["poeta"]["poet_email"]           = $result[4];
            $_SESSION["poeta"]["poet_foto"]            = $result[5];
            $_SESSION["poeta"]["poet_fecha_nac"]       = $result[6];
            $_SESSION["poeta"]["poet_sexo"]            = $result[7];
            $_SESSION["poeta"]["poet_descripcion"]     = $result[9];
            $_SESSION["poeta"]["acc_token"]            = $result[14];
            $_SESSION["poeta"]["acc_primera_vez"]      = $result[20];
            $_SESSION["poeta"]["acc_origen_conexion"]  = $result[21];

            $datos = "2";
          }else{
            $datos = "1";
          }
     }else{
       $datos = "0";
     }
     echo $datos;
  }

  function cerrarSesion(){
    session_destroy();
    header("Location: ./");
  }


}
?>
