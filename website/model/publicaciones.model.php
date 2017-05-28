<?php
class PublicacionesModel{
  private $pdo;

  public function cargarPoemas($Limite){
    try{
      $sql = "SELECT * FROM inkside_publicaciones WHERE catePub_codigo = 1 AND pub_estado = 'publicado'";
      $query = $this->pdo->prepare($sql);
			$query->execute(array($data[0]));
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
