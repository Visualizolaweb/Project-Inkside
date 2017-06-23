<?php
class CorreoModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function MisMensajes(){
    $poet_email = $_SESSION["poeta"]["poet_email"];
    try{
       $sql = "SELECT
              	corr_codigo,
              	inkside_correo.poet_codigo,
              	corr_estado,
              	corr_asunto,
              	corr_mesaje,
              	corr_asunto_replay,
              	corr_email_destino,
              	corr_fecha_envio,
              	corr_actualizacion,
              	poet_nombre,
              	poet_apellido,
              	poet_nick,
              	poet_email,
              	poet_foto,
                inkside_poeta_descripcion.pdesc_avatar
              FROM inkside_correo
              JOIN inkside_poetas ON  inkside_correo.poet_codigo = inkside_poetas.poet_codigo
              JOIN inkside_poeta_descripcion ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
              WHERE corr_email_destino like '%$poet_email%'";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_email));
      $result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


  public function ResponderMensaje($corr_codigo){
    try{
       $sql = "SELECT
              	inkside_correo.poet_codigo,
              	corr_asunto,
              	corr_mesaje,
              	corr_asunto_replay,
              	corr_email_destino,
              	corr_fecha_envio,
              	poet_nombre,
              	poet_apellido,
              	poet_nick,
              	poet_email,
              	poet_foto,
                inkside_poeta_descripcion.pdesc_avatar
              FROM inkside_correo
              JOIN inkside_poetas ON  inkside_correo.poet_codigo = inkside_poetas.poet_codigo
              JOIN inkside_poeta_descripcion ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
              WHERE corr_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($corr_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


  public function __DESTRUCT(){
    DataBase::disconnect();
  }

}
?>
