<?php
class ComentariosModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function comentariosByPublicacion($pub_codigo){
    try{
      $sql = "SELECT com_comentario,com_fecha,poet_nick FROM inkside_comentarios
              JOIN inkside_poetas ON inkside_poetas.poet_codigo = inkside_comentarios.poet_codigo
              WHERE pub_codigo = ?";
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
      $sql = "SELECT inkside_poetas.poet_codigo as poet_codigo, inkside_poetas.poet_nombre, inkside_poetas.poet_nick,
                     inkside_poetas.poet_foto
              FROM inkside_poetas
              INNER JOIN inkside_likes ON inkside_poetas.poet_codigo = inkside_likes.poet_codigo
              WHERE inkside_likes.pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
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
