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

  public function crearPoeta($data){
    try{
      $sp = "CALL registroPoeta(?,?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sp);
      $query->execute(array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6]));

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
                  ciu_codigo
              FROM
                  inkside_poetas
              WHERE
                  poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function crearPoetaSocial($data){
    try{
      $sp = "CALL registroPoetaSocial(?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $query = $this->pdo->prepare($sp);
      $query->execute(array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$data[10],$data[11],$data[12]));

      $result = array(1,"Se ha registrado correctamente");
      }catch (Exception $e){
      $result = array(0,$e->getMessage());
    }
    return $result;
  }

  public function buscoCampo($data){

    try{
      $sp = "CALL buscoEmail(?)";
      $query = $this->pdo->prepare($sp);
      $query->execute(array($data));

      $result = $query->fetchALL(PDO::FETCH_BOTH);

      $result = array(1,"La consulta fue exitosa", count($result));
    }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function activoCuenta($data){
    try{
      $sql = "UPDATE inkside_poetas SET poet_estado = 'Activo' WHERE poet_codigo = (SELECT poet_codigo FROM inkside_acceso WHERE acc_token = ?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data));

      $result = array(1,"Su cuenta se ha activado correctamente");
    }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function autenticarUsuario($data){
    try{
      $sql = "SELECT inkside_poetas.*, inkside_acceso.* FROM inkside_poetas INNER JOIN inkside_acceso ON inkside_poetas.poet_codigo = inkside_acceso.poet_codigo WHERE (poet_email = ?) and (acc_origen_conexion = 'inkside') and (poet_estado != 'Inactivo');";
      $query = $this->pdo->prepare($sql);
			$query->execute(array($data[0]));
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
