<?php
require_once "../vendor/autoload.php";
require_once 'model/poetas.model.php';

class AuthController extends InitController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function cambioClave(){
    $data = $_POST["data"];
    $result = $this->poetas->datosAccesobyCodigo($data[0]);

    if(count($result[0])>0){
      $data[1] = password_hash($data[1], PASSWORD_DEFAULT);
      $result = $this->poetas->updateClave($data);
    }else{
      $data[1] = password_hash($data[1], PASSWORD_DEFAULT);
      $data[2] = InitController::generarToken(55);
      $data[3] = "inkside";

      $result = $this->poetas->insertAcceso($data);
    }

    $data_poet = $this->poetas->datosPoetaFullbyCodigo($data[0]);
    $_SESSION["poeta"]["poet_codigo"]          = $data_poet["poet_codigo"];
    $_SESSION["poeta"]["poet_nombre"]          = $data_poet["poet_nombre"];
    $_SESSION["poeta"]["poet_apellido"]        = $data_poet["poet_apellido"];
    $_SESSION["poeta"]["poet_nick"]            = $data_poet["poet_nick"];
    $_SESSION["poeta"]["poet_email"]           = $data_poet["poet_email"];
    $_SESSION["poeta"]["poet_foto"]            = $data_poet["poet_foto"];
    $_SESSION["poeta"]["poet_fecha_nac"]       = $data_poet["poet_fecha_nac"];
    $_SESSION["poeta"]["poet_sexo"]            = $data_poet["poet_sexo"];
    $_SESSION["poeta"]["poet_descripcion"]     = $data_poet["poet_descripcion"];
    $_SESSION["poeta"]["rol_codigo"]           = $data_poet["rol_codigo"];
    $_SESSION["poeta"]["acc_token"]            = $data_poet["acc_token"];

    header("Location: dashboard");
  }

  public function registroPoeta(){
      $realdata =  $_POST["data"];

      $data[0] = InitController::generarPk("POET",4,5); //Metodo para generar la clave PK ("pref", "grupos", "lenght")
      $data[1] = $realdata[0];
      $data[2] = $realdata[1];
      $data[3] = $realdata[2];
      $data[4] = InitController::generarToken(55); //KeyToken
      $data[5] = password_hash($realdata[3], PASSWORD_DEFAULT);
      $data[6] = "inkside";
      $result = $this->poetas->crearPoeta($data);

      if($result[0] == 1){
        $data = array($data[3], $data[1].' '.$data[2], "activaCuenta", $data[4]);
        $result = InitController::sendMail($data);
      }

      echo json_encode($result);
  }

  public function quieromiclave(){
      $data[0] = $_POST["email"];

      $poeta = $this->poetas->datosPoetabyEmail($data[0]);
      $data[1] = $poeta["poet_nombre"].' '.$poeta["poet_apellido"];
      $data[2] = $poeta["poet_codigo"];

      $result = InitController::sendMailPassword($data);

      header("Location: ./");
  }

  public function registroSocial(){

      $dataSocial = $this->poetas->autenticarUsuarioSocial($_SESSION["poeta"]["acc_social_id"]);

      if(count($dataSocial[0]) == 0){
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

          $_SESSION["poeta"]["poet_codigo"] = $data[0];
          $result = $this->poetas->crearPoetaSocial($data);
          $_SESSION["poeta"]["rol_codigo"] = '109902';
      }else{
        $_SESSION["poeta"]["poet_codigo"]          = $dataSocial["poet_codigo"];
        $_SESSION["poeta"]["poet_nombre"]          = $dataSocial["poet_nombre"];
        $_SESSION["poeta"]["poet_apellido"]        = $dataSocial["poet_apellido"];
        $_SESSION["poeta"]["poet_nick"]            = $dataSocial["poet_nick"];
        $_SESSION["poeta"]["poet_email"]           = $dataSocial["poet_email"];
        $_SESSION["poeta"]["poet_foto"]            = $dataSocial["poet_foto"];
        $_SESSION["poeta"]["poet_fecha_nac"]       = $dataSocial["poet_fecha_nac"];
        $_SESSION["poeta"]["poet_sexo"]            = $dataSocial["poet_sexo"];
        $_SESSION["poeta"]["poet_descripcion"]     = $dataSocial["poet_descripcion"];
        $_SESSION["poeta"]["rol_codigo"]           = $dataSocial["rol_codigo"];
        $_SESSION["poeta"]["acc_token"]            = $dataSocial["acc_token"];
      }

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

        $data_poet = $this->poetas->datosPoetaFullbyToken($data);
        $_SESSION["poeta"]["poet_codigo"]          = $data_poet["poet_codigo"];
        $_SESSION["poeta"]["poet_nombre"]          = $data_poet["poet_nombre"];
        $_SESSION["poeta"]["poet_apellido"]        = $data_poet["poet_apellido"];
        $_SESSION["poeta"]["poet_nick"]            = $data_poet["poet_nick"];
        $_SESSION["poeta"]["poet_email"]           = $data_poet["poet_email"];
        $_SESSION["poeta"]["poet_foto"]            = $data_poet["poet_foto"];
        $_SESSION["poeta"]["poet_fecha_nac"]       = $data_poet["poet_fecha_nac"];
        $_SESSION["poeta"]["poet_sexo"]            = $data_poet["poet_sexo"];
        $_SESSION["poeta"]["poet_descripcion"]     = $data_poet["poet_descripcion"];
        $_SESSION["poeta"]["rol_codigo"]           = $data_poet["rol_codigo"];
        $_SESSION["poeta"]["acc_token"]            = $data_poet["acc_token"];

        header("Location: ../cloud/completo-perfil");
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
            $_SESSION["poeta"]["rol_codigo"]           = $result[13];
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

  public function password(){
      require_once 'views/section/users/password.php';
  }

  function cerrarSesion(){
    session_destroy();
    header("Location: ../");
  }


}
?>
