<?php
class PublicacionesModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function cargarPoemas(){
    try{
      $sql = "SELECT *,pdesc_acerca,pdesc_avatar,poet_nick FROM inkside_publicaciones
              JOIN inkside_poeta_descripcion ON inkside_poeta_descripcion.poet_codigo = inkside_publicaciones.poet_codigo
              JOIN inkside_poetas ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
              WHERE pub_estado = 'publicado' ORDER BY pub_fechaPublicacion DESC LIMIT 12";
      $query = $this->pdo->prepare($sql);
			$query->execute();
			$result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function cargabyId($pub_codigo){
    try{
      $sql = "SELECT inkside_poetas.poet_codigo,  poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
               FROM inkside_poetas
               LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
               JOIN inkside_publicaciones ON inkside_poetas.poet_codigo = inkside_publicaciones.poet_codigo
               JOIN inkside_categoriapublicacion ON inkside_categoriapublicacion.catePub_codigo = inkside_publicaciones.catePub_codigo
              WHERE inkside_publicaciones.pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function ultimaPublicacion($poet_codigo){
    try{
      $sql = "SELECT inkside_poetas.poet_codigo,  poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_codigo, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
               FROM inkside_poetas
               LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
               JOIN inkside_publicaciones ON inkside_poetas.poet_codigo = inkside_publicaciones.poet_codigo
               JOIN inkside_categoriapublicacion ON inkside_categoriapublicacion.catePub_codigo = inkside_publicaciones.catePub_codigo
              WHERE inkside_publicaciones.poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
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
