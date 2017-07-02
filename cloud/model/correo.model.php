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
      if(!isset($poet_email)){
         $sql = "SELECT
                	corr_codigo,
                	inkside_correo.poet_codigo,
                	corr_estado,
                	corr_asunto,
                	corr_mesaje,
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
                LEFT JOIN inkside_poeta_descripcion ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
                WHERE corr_email_destino LIKE '%$poet_email%' ORDER BY corr_fecha_envio DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($poet_email));
        $result = $query->fetchALL(PDO::FETCH_BOTH);
      }else{
        $result = 0;
      }

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

  public function estadoMensajes(){
      $poet_email = $_SESSION["poeta"]["poet_email"];
    try{
      if(!isset($poet_email)){
         $sql = "SELECT
                      SUM(IF(corr_estado=1, 1, 0)) 'correos leidos',
                      SUM(IF(corr_estado=0, 1, 0)) 'correos sinleer'
                FROM inkside_correo e
                WHERE corr_email_destino LIKE '%$poet_email%'";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($poet_email));
        $result = $query->fetch(PDO::FETCH_BOTH);
      }else{
        $result = 0;
      }

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function cargarCorreo($email_buscar){
    try{
      $return_arr = array();
       $sql = "SELECT poet_nick, poet_email
              FROM inkside_poetas
              WHERE poet_nick LIKE '%" . mysqli_real_escape_string($email_buscar) . "%' LIMIT 0 ,50";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function GuardarMensaje($data){
    $fecha = date('Y-m-d H:m:s');
    try{
      $sql = "INSERT INTO inkside_correo
                          (poet_codigo,
                           corr_asunto,
                           corr_mesaje,
                           corr_email_destino,
                           corr_fecha_envio)
            VALUES(?,?,?,?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($_SESSION["poeta"]["poet_codigo"],$data[1],$data[4],$data[0],$fecha));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function EliminarMensaje($corr_codigo){
    try{
      $sql = "DELETE FROM inkside_correo WHERE corr_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($corr_codigo));

      $result = array(1,"Se ha eliminado el mensaje correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function estadoLeido($mensaje_codigo){
    try{
      $sql = "UPDATE inkside_correo set corr_estado = 1 WHERE corr_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($mensaje_codigo));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function __DESTRUCT(){
    DataBase::disconnect();
  }

}
?>
