<?php
class LikesModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function likesByPublicacion($pub_codigo){
    try{
      $sql = "SELECT poet_codigo as 'codigo' FROM inkside_likes WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function likesAvatar($pub_codigo){
    try{
      $sql = "SELECT inkside_poetas.poet_codigo, inkside_poetas.poet_nombre, inkside_poetas.poet_nick, inkside_poetas.poet_foto,
                     inkside_likes.poet_codigo
              FROM inkside_poetas
              INNER JOIN inkside_likes ON inkside_poetas.poet_codigo = inkside_likes.poet_codigo
              WHERE inkside_likes.pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

    public function guardarLike($pub_codigo, $poet_codigo){
      try{
        $sql = "INSERT INTO inkside_likes (poet_codigo, pub_codigo) VALUES (?,?)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($poet_codigo, $pub_codigo));
        $result = "Like con exito";
      }catch (Exception $e){
        $result = array(0,$e->getMessage());
      }
      return $result;
    }


    public function eliminarLike($pub_codigo, $poet_codigo){
      try{
        $sql = "DELETE FROM inkside_likes WHERE poet_codigo = ? AND pub_codigo = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($poet_codigo, $pub_codigo));
        $result = "UnLike con exito";
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
