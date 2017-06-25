<?php
class PoetasModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function poetasComunidad($limit){
    try{
      $sql = "SELECT *, pdesc_acerca, pdesc_avatar
              FROM inkside_poetas
              LEFT JOIN inkside_poeta_descripcion ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
              JOIN inkside_publicaciones ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
              WHERE inkside_publicaciones.pub_estado = 'Publicado' group by inkside_poetas.poet_codigo ORDER BY poet_fecha_creacion DESC $limit ";
      $query = $this->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchALL(PDO::FETCH_BOTH);

      return $result;

      }catch (Exception $e){
        die($e->getMessage());
    }
  }

  public function crearPoeta($data){
    try{
      $sp = "CALL registroPoeta(?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sp);
      $query->execute(array($data[4],$data[0],$data[1],$data[2],$data[5],$data[3]));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function datosPoeta($poet_codigo){
    try{
       $sql = "SELECT
                  poet_nombre,
                  poet_apellido,
                  poet_nick,
                  poet_email,
                  poet_fecha_nac,
                  poet_sexo,
                  poet_celular,
                  poet_descripcion,
                  poet_foto,
                  ciu_codigo,
                  pdesc_acerca,
                  pdesc_avatar
              FROM
                  inkside_poetas
                  LEFT JOIN inkside_poeta_descripcion
                  ON inkside_poeta_descripcion.poet_codigo = inkside_poetas.poet_codigo
              WHERE
                  inkside_poetas.poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function seguidores($poet_codigo){
    try{
      $sql = "SELECT inkside_seguidores.poet_codigo, poet_nick, poet_foto, pdesc_avatar
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
