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

  public function cargarPoemas($limit){
    try{
      $sql = "SELECT	inkside_publicaciones.pub_codigo as pub_codigo, inkside_publicaciones.pub_contenido as pub_contenido,
		inkside_publicaciones.pub_imgPortada as pub_imgPortada, inkside_publicaciones.pub_titulo as pub_titulo,
		inkside_publicaciones.pub_dedicatorias as pub_dedicatorias, inkside_publicaciones.pub_fechaPublicacion as pub_fechaPublicacion, inkside_poetas.poet_nick as poet_nick,
		inkside_poetas.poet_foto as poet_foto, inkside_poeta_descripcion.pdesc_avatar as pdesc_avatar

  FROM  inkside_publicaciones
  INNER JOIN inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
   LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
       WHERE pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado' ORDER BY pub_fechaPublicacion DESC $limit";

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
      $sql = "SELECT inkside_poetas.poet_codigo, inkside_publicaciones.catePub_codigo, poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
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
      $sql = "SELECT inkside_poetas.poet_codigo, poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_codigo, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
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


    public function otraPublicacion($poet_codigo,$pub_codigo){
      try{
        $sql = "SELECT inkside_poetas.poet_codigo, poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_codigo, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
                 FROM inkside_poetas
                 LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
                 JOIN inkside_publicaciones ON inkside_poetas.poet_codigo = inkside_publicaciones.poet_codigo
                 JOIN inkside_categoriapublicacion ON inkside_categoriapublicacion.catePub_codigo = inkside_publicaciones.catePub_codigo
                WHERE inkside_publicaciones.pub_categoria = 'Poema' AND inkside_publicaciones.poet_codigo = ? AND inkside_publicaciones.pub_codigo != ? ORDER BY RAND()";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($poet_codigo, $pub_codigo));
        $result = $query->fetch(PDO::FETCH_BOTH);

       }catch(PDOException $e){
        $result = array(0,$e->getMessage(),$e->getCode());
      }
      return $result;
    }

    public function verRecomendados($pub_codigo){
      $hits = rand(0,20);
      try{
        $sql = "SELECT inkside_poetas.poet_codigo, poet_nick, pdesc_avatar, poet_foto, pub_fechaPublicacion, pub_imgPortada, pub_codigo, pub_titulo, pub_contenido, pub_dedicatorias, catePub_nombre
                 FROM inkside_poetas
                 LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
                 JOIN inkside_publicaciones ON inkside_poetas.poet_codigo = inkside_publicaciones.poet_codigo
                 JOIN inkside_categoriapublicacion ON inkside_categoriapublicacion.catePub_codigo = inkside_publicaciones.catePub_codigo
                WHERE inkside_publicaciones.pub_hits <= $hits AND inkside_publicaciones.pub_codigo != ? ORDER BY RAND() LIMIT 5";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($pub_codigo));
        $result = $query->fetchALL(PDO::FETCH_BOTH);

       }catch(PDOException $e){
        $result = array(0,$e->getMessage(),$e->getCode());
      }
      return $result;
    }

  public function cargarArticulos(){
    try{
      $sql = "SELECT * FROM inkside_publicaciones WHERE pub_categoria != 'Poema' and pub_estado = 'Publicado' LIMIT 4";
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
