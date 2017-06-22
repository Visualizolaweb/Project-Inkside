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

  public function MisMensajes($poet_codigo){
    try{
       $sql = "SELECT
              corr_codigo,
              poet_codigo,
              corr_estado,
              corr_asunto,
              corr_mesaje,
              corr_asunto_replay,
              corr_email_destino,
              corr_fecha_envio,
              corr_actualizacion
            FROM inkside_correo ORDER BY corr_fecha_envio DESC limit 10";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);

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
