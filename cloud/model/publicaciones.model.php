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
      $sql = "SELECT * FROM inkside_publicaciones WHERE pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado'";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
    return $result;
  }

  public function mostrarPoemas($position, $rows_for_page){
    try{
      $sql = "SELECT
                     inkside_publicaciones.pub_codigo as pub_codigo, inkside_publicaciones.pub_contenido as pub_contenido,
                     inkside_publicaciones.pub_imgPortada as pub_imgPortada, inkside_publicaciones.pub_titulo as pub_titulo,
                     inkside_publicaciones.pub_fechaPublicacion as pub_fechaPublicacion, inkside_poetas.poet_nick as poet_nick,
                     inkside_poetas.poet_foto as poet_foto
              FROM
                    inkside_publicaciones
              INNER JOIN
                    inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
              WHERE pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado'
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

  public function __DESTRUCT(){
    DataBase::disconnect();
  }

}
?>
