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

  public function cargarPoemas($tipoArticulo){
    try{
      $sql = "SELECT * FROM inkside_publicaciones WHERE pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado' and pub_categoria = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($tipoArticulo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
    return $result;
  }

  public function cargarMisPublicaciones($poet_codigo){
    try{
      $sql = 'SELECT pub_codigo as "codigo", pub_titulo as "publicacion", pub_categoria as "Categoria", pub_estadoRevision as "Revision", pub_estado as "Estado" FROM inkside_publicaciones WHERE poet_codigo = ?';

      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
      $result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
    return $result;
  }

  public function mostrarPoemas($position, $rows_for_page, $tipoArticulo){
    try{
      $sql = "SELECT
                     inkside_publicaciones.pub_codigo as pub_codigo, inkside_publicaciones.pub_contenido as pub_contenido,
                     inkside_publicaciones.pub_imgPortada as pub_imgPortada, inkside_publicaciones.pub_titulo as pub_titulo,
                     inkside_publicaciones.pub_dedicatorias as pub_dedicatorias, inkside_publicaciones.pub_fechaPublicacion as pub_fechaPublicacion, inkside_poetas.poet_nick as poet_nick,
                     inkside_poetas.poet_foto as poet_foto, inkside_poeta_descripcion.pdesc_avatar as pdesc_avatar, inkside_poetas.poet_codigo
              FROM
                    inkside_publicaciones
              INNER JOIN
                    inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
                    LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
              WHERE pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado' and pub_categoria = '".$tipoArticulo."'
    				  ORDER BY
    				        inkside_publicaciones.pub_fechaPublicacion DESC LIMIT $position, $rows_for_page";
      $query = $this->pdo->prepare($sql);
			$query->execute(array($position, $rows_for_page));
			$result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


  public function cargabyId($pub_codigo){
    try{
      $sql = "SELECT inkside_poetas.poet_codigo,  poet_nick, pdesc_avatar, poet_foto,
                     pub_fechaPublicacion, pub_imgPortada, pub_titulo, pub_contenido,
                     pub_dedicatorias, catePub_codigo
        			 FROM inkside_poetas
                   LEFT JOIN inkside_poeta_descripcion
                   ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
                   JOIN inkside_publicaciones
                   ON inkside_poetas.poet_codigo = inkside_publicaciones.poet_codigo
              WHERE inkside_publicaciones.pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
			$query->execute(array($pub_codigo));
			$result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


  public function guardarHit($pub_codigo){
    try{
      $sql = "UPDATE inkside_publicaciones SET pub_hits = pub_hits + 1 WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
  }

  public function actualizoestado($pub_codigo, $revision, $estado){
    try{
      $sql = "UPDATE inkside_publicaciones SET pub_estadoRevision = ?, pub_estado = ? WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($revision, $estado, $pub_codigo));
     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
  }

  public function eliminoPublicacion($pub_codigo){
    try{
      $sql = "DELETE FROM inkside_publicaciones WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
  }

  public function dedicatoria($pub_codigo){
    try{
      $sql = "UPDATE inkside_publicaciones SET pub_dedicatorias = pub_dedicatorias + 1 WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($pub_codigo));
     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
  }

  public function buscarPublicacion($consultaBusqueda){
    try{
      $sql = "SELECT 'Poeta' AS 'type', poet_codigo AS codigo, poet_nombre AS campoa, poet_apellido AS campob, poet_nick AS campoc
              FROM inkside_poetas
              WHERE poet_nombre
              LIKE CONCAT('%$consultaBusqueda%')  OR poet_apellido
              LIKE CONCAT('%$consultaBusqueda%') OR poet_nick
              LIKE CONCAT('%$consultaBusqueda%') OR poet_email
              LIKE CONCAT('%$consultaBusqueda%')
	            UNION
	            SELECT 'Poema' AS 'type', pub_codigo AS codigo, pub_titulo AS campoa, pub_categoria AS campob, pub_contenido AS campoc
              FROM inkside_publicaciones
              WHERE pub_titulo
              LIKE CONCAT('%$consultaBusqueda%') OR pub_categoria
              LIKE CONCAT('%$consultaBusqueda%') OR pub_contenido
              LIKE CONCAT('%$consultaBusqueda%') LIMIT 30";
      $query = $this->pdo->prepare($sql);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function cargarPoemasporPoeta($limit,$poet_codigo){
    try{
      $sql = "SELECT	inkside_publicaciones.pub_codigo as pub_codigo, inkside_publicaciones.pub_contenido as pub_contenido,
    inkside_publicaciones.pub_imgPortada as pub_imgPortada, inkside_publicaciones.pub_titulo as pub_titulo,
    inkside_publicaciones.pub_dedicatorias as pub_dedicatorias, inkside_publicaciones.pub_fechaPublicacion as pub_fechaPublicacion, inkside_poetas.poet_nick as poet_nick,
    inkside_poetas.poet_foto as poet_foto, inkside_poetas.poet_codigo as poet_codigo, inkside_poeta_descripcion.pdesc_avatar as pdesc_avatar

  FROM  inkside_publicaciones
  INNER JOIN inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
   LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
       WHERE inkside_poetas.poet_codigo = ? and pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado' and pub_categoria = 'Poema' ORDER BY pub_fechaPublicacion DESC $limit";

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
