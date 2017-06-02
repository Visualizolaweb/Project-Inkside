<?php
class LocalizacionModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function verPaises(){
    try{
      $sql = "SELECT * FROM inkside_pais";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function verDepartamentos($pais_codigo){
    try{
      $sql = "SELECT * FROM inkside_departamento WHERE pais_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pais_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function verCiudades($dep_codigo){
    try{
      $sql = "SELECT * FROM inkside_ciudad WHERE dep_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($dep_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
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
