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
      $sql = "SELECT com_comentario,com_fecha,poet_nick,poet_foto, pdesc_avatar FROM inkside_comentarios
              JOIN inkside_poetas ON inkside_poetas.poet_codigo = inkside_comentarios.poet_codigo
              LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
              WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function guardarComentario($data){
    try{
      $sql = "INSERT INTO inkside_comentarios (poet_codigo, pub_codigo, com_fecha, com_comentario) VALUE (?,?,NOW(),?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[0],$data[1],$data[2]));
      $result = "Comentario guardado con exito";
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
