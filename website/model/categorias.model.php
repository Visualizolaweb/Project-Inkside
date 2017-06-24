<?php
class CategoriasModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function buscarCategoria($categorias){
    try{
      $sql = "SELECT * FROM inkside_categoriapublicacion WHERE catePub_codigo IN ($categorias)";
      $query = $this->pdo->prepare($sql);
			$query->execute();
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
