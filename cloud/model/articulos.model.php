<?php
class ArticulosModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function crearArticulo($data,$cat,$imagenPortada){
    $fecha = date('Y-m-d');
    try{
      $sql = "INSERT INTO inkside_noticias
                          (poet_codigo,
                          not_fechaPublicacion,
                          not_imgPortada,
                          not_titulo,
                          not_contenido,
                          catePub_codigo)
            VALUES(?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($_SESSION["poeta"]["poet_codigo"],$fecha,$imagenPortada,$data[2],$data[3],$cat));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }


  public function crearEvento($data,$imagenPortada){
    $fecha = date('Y-m-d');
    try{
      $sql = "INSERT INTO inkside_eventos
                          (poet_codigo,
                          event_fechaPublicacion,
                          event_imgPortada,
                          event_titulo,
                          event_contenido,
                          event_fechaEvento)
            VALUES(?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($_SESSION["poeta"]["poet_codigo"],$fecha,$imagenPortada,$data[2],$data[3],$data[4]));

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



  public function __DESTRUCT(){
    DataBase::disconnect();
  }

}
?>
