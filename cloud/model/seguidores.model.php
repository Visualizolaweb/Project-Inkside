<?php
class SeguidoresModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function buscarSeguidores($micodigo){
    try{
      $sql = "SELECT * FROM inkside_seguidores WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($micodigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function seguir($poet_codigo, $micodigo){
    try{
      $sql = "INSERT INTO inkside_seguidores (poet_codigo, seg_seguidores) VALUES (?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($micodigo, $poet_codigo));
      $result = "Like con exito";
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function actualizarSeguidores($poet_codigo, $micodigo){
    try{
      $sql = "UPDATE inkside_seguidores SET seg_seguidores = CONCAT(seg_seguidores,',',?) WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo, $micodigo));
      $result = "Like con exito";
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function seguidores($poet_codigo){
    try{
      $sql = "SELECT inkside_seguidores.poet_codigo, poet_foto, pdesc_avatar
		          FROM inkside_poetas
              LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
	            JOIN inkside_seguidores ON inkside_seguidores.poet_codigo = inkside_poetas.poet_codigo
              WHERE  seg_seguidores LIKE '%".$poet_codigo."%'";
      $query = $this->pdo->prepare($sql);
      $query->execute();
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
