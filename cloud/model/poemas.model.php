<?php
class PoemasModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function crearPoema($data,$cat,$imagenPortada){
    $fecha = date('Y-m-d');
    try{
      $sql = "INSERT INTO inkside_publicaciones
                          (poet_codigo,
                          pub_fechaPublicacion,
                          pub_imgPortada,
                          pub_titulo,
                          pub_contenido,
                          pub_audio,
                          catePub_codigo,
                          pub_categoria)
            VALUES(?,?,?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($_SESSION["poeta"]["poet_codigo"],$fecha,$imagenPortada,$data[2],$data[3],$data[4],$cat,$data[777]));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function actualizoPoema($data,$cat){
    $fecha = date('Y-m-d');
    try{
      $sql = "UPDATE inkside_publicaciones SET pub_titulo = ?,  pub_contenido = ?, catePub_codigo = ?  WHERE pub_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[2],$data[3],$cat,$data[0]));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function actualizarPoeta($data){
    try{
      $sql = "UPDATE inkside_poetas
              SET
                  ciu_codigo = ?,
                  poet_nombre = ?,
                  poet_apellido = ?,
                  poet_nick = ?,
                  poet_email = ?,
                  poet_fecha_nac = ?,
                  poet_sexo = ?,
                  poet_celular = ?
              WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]));

      $result = array(1,"Su cuenta se ha actualizado correctamente");
    }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }
    return $result;
  }

  public function poemasPorPoeta($cod_poeta){
    try {
      $sql = "SELECT inkside_publicaciones.pub_codigo as pub_codigo, inkside_publicaciones.pub_contenido as pub_contenido,
                     inkside_publicaciones.pub_imgPortada as pub_imgPortada, inkside_publicaciones.pub_titulo as pub_titulo,
                     inkside_publicaciones.pub_fechaPublicacion as pub_fechaPublicacion, inkside_poetas.poet_nick as poet_nick,
                     inkside_poetas.poet_codigo
              FROM   inkside_publicaciones
              INNER JOIN   inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
              WHERE inkside_publicaciones.poet_codigo  = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($cod_poeta));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    } catch (Exception $e) {
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function cargaPoemas($seguidores){
    $x = 1;
    $poetas = null;
    foreach ($seguidores as $poeta) {
      $poetas .= "inkside_poetas.poet_codigo = '".$poeta."'";

      if($x < count($seguidores)){
        $poetas .= " OR ";
      }

      $x++;
    }

    try {
     $sql = "SELECT inkside_publicaciones.pub_codigo AS pub_codigo, inkside_publicaciones.pub_contenido AS pub_contenido,
                     inkside_publicaciones.pub_imgPortada AS pub_imgPortada, inkside_publicaciones.pub_titulo AS pub_titulo,
                     inkside_publicaciones.pub_fechaPublicacion AS pub_fechaPublicacion, inkside_poetas.poet_nick AS poet_nick,
                     inkside_publicaciones.pub_dedicatorias AS pub_dedicatorias, inkside_poetas.poet_foto AS poet_foto, inkside_poeta_descripcion.pdesc_avatar, inkside_poetas.poet_codigo
              FROM   inkside_publicaciones
              INNER JOIN inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
              LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
              WHERE pub_estadoRevision = 'Aprobado' AND pub_estado = 'Publicado' AND ($poetas)
              ORDER BY inkside_publicaciones.pub_fechaPublicacion DESC LIMIT 30";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    } catch (Exception $e) {
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function cargaPoemasmenosleidos(){


    try {
     $sql = "SELECT inkside_publicaciones.pub_codigo AS pub_codigo, inkside_publicaciones.pub_contenido AS pub_contenido,
                     inkside_publicaciones.pub_imgPortada AS pub_imgPortada, inkside_publicaciones.pub_titulo AS pub_titulo,
                     inkside_publicaciones.pub_fechaPublicacion AS pub_fechaPublicacion, inkside_poetas.poet_nick AS poet_nick,
                     inkside_publicaciones.pub_dedicatorias AS pub_dedicatorias,inkside_publicaciones.pub_hits AS pub_hits, inkside_poetas.poet_foto AS poet_foto, inkside_poeta_descripcion.pdesc_avatar, inkside_poetas.poet_codigo
              FROM   inkside_publicaciones
              INNER JOIN inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
              LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
              WHERE pub_estadoRevision = 'Aprobado' AND pub_estado = 'Publicado' AND pub_hits < 20
              ORDER BY rand() LIMIT 30";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchALL(PDO::FETCH_BOTH);
    } catch (Exception $e) {
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function masLeidos($poet_codigo){
    try{
      $sql = "SELECT pub_codigo, pub_titulo, pub_hits FROM inkside_publicaciones WHERE poet_codigo = ? ORDER BY pub_hits desc LIMIT 5";
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
