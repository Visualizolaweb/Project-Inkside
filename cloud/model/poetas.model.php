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
                  poet_nombre = ?,
                  poet_apellido = ?,
                  poet_nick = ?,
                  poet_email = ?,
                  poet_sexo = ?
              WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[1],$data[2],$data[3],$data[4],$data[6],$data[8]));

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

  public function miComunidad($poet_codigo){
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

  public function datosPoetaFull($poet_codigo){
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
                  ciu_codigo,
                  poet_foto,
                  inkside_poeta_descripcion.*
              FROM
                  inkside_poetas
              LEFT JOIN
                  inkside_poeta_descripcion
              ON
                  inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
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



  public function datosPoetaFullbyCodigo($poet_codigo){
    try{
       $sql = "SELECT inkside_poetas.*, inkside_poeta_descripcion.*, inkside_acceso.*
                 FROM inkside_poetas
            LEFT JOIN inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
			     INNER JOIN inkside_acceso ON inkside_acceso.poet_codigo = inkside_poetas.poet_codigo
                WHERE inkside_poetas.poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poet_codigo));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
}


  public function datosPoetaFullbyToken($acc_token){
    try{
       $sql = "SELECT inkside_acceso.*, inkside_poetas.*
                 FROM inkside_acceso
           INNER JOIN inkside_poetas ON inkside_poetas.poet_codigo = inkside_acceso.poet_codigo
                WHERE acc_token = ?";

      $query = $this->pdo->prepare($sql);
      $query->execute(array($acc_token));
      $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function poetasSugeridos($poetasAleatorios){
    try{
       $sql = "SELECT inkside_poetas.poet_codigo,
                      inkside_poetas.poet_nombre,
                      inkside_poetas.poet_apellido,
                      inkside_poetas.poet_nick,
                      inkside_poetas.poet_foto,
                      inkside_poeta_descripcion.pdesc_avatar,
                      inkside_ciudad.ciu_nombre
              FROM
                    inkside_poetas
              JOIN
                    inkside_poeta_descripcion
              ON
                    inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
              JOIN
                    inkside_ciudad
              ON
                    inkside_ciudad.ciu_codigo = inkside_poetas.ciu_codigo
              ORDER BY RAND() LIMIT 3";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($poetasAleatorios));
      $result = $query->fetchALL(PDO::FETCH_BOTH);
     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function contarPoetas(){
    try{
       $sql = "SELECT count(poet_codigo) AS totalPoetas FROM inkside_poetas";
      $query = $this->pdo->prepare($sql);
      $query->execute();
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

  public function actualizoPerfil($data,$categorias){
    try{
      $sql = "UPDATE inkside_poetas SET poet_nick = ?, poet_descripcion = ? WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[1],$data[3],$data[0]));

      $sql = "INSERT INTO inkside_poeta_descripcion (poet_codigo, pdesc_acerca) VALUES (?,?)";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[0],$data[3]));

      foreach ($categorias as $categoria) {
        $sql = "INSERT INTO inkside_intereses (poet_codigo, catePub_codigo) VALUES (?,?)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($data[0], $categoria));
      }

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

  public function updateClave($data){
    try{
      $sql = "UPDATE inkside_acceso SET acc_password = ? WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($data[1],$data[0]));

      $result = array(1,"La clave se ha actualizado correctamente");
    }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

    public function insertAcceso($data){
      try{
        $sql = "INSERT INTO inkside_acceso (acc_token, poet_codigo, acc_password, acc_origen_conexion) VALUES (?,?,?,?)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($data[2],$data[0],$data[1],$data[3]));

        $result = array(1,"Se ha ingresado en acceso correctamente");
      }catch(PDOException $e){
        $result = array(0,$e->getMessage(),$e->getCode());
      }

      return $result;
    }

  public function actualizoAvatar($avatar, $code){
    try{
      $sql = "UPDATE inkside_poetas SET poet_foto = ? WHERE poet_codigo = ?";
      $query = $this->pdo->prepare($sql);
      $query->execute(array($avatar, $code));

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

  public function cargaCodigobySocialID($acc_social_id){
    try{
       $sql = "SELECT poet_codigo FROM inkside_acceso WHERE acc_social_id = ?";
       $query = $this->pdo->prepare($sql);
       $query->execute(array($acc_social_id));

       $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function datosAccesobyCodigo($poet_codigo){
    try{
       $sql = "SELECT * FROM inkside_acceso WHERE poet_codigo = ?";
       $query = $this->pdo->prepare($sql);
       $query->execute(array($poet_codigo));

       $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


  public function autenticarUsuarioSocial($acc_social_id){
    try{
       $sql = "SELECT inkside_acceso.*, inkside_poetas.*
                 FROM inkside_poetas
           INNER JOIN inkside_acceso ON inkside_acceso.poet_codigo = inkside_poetas.poet_codigo
                WHERE inkside_acceso.acc_social_id = ?";

       $query = $this->pdo->prepare($sql);
       $query->execute(array($acc_social_id));

       $result = $query->fetch(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }

  public function poetasPorRol($rol){
    try{
       $sql = "SELECT inskide_roles.rol_codigo, rol_nombre, poet_codigo,poet_nick, poet_email
                FROM inskide_roles
                INNER JOIN inkside_poetas
                ON inskide_roles.rol_codigo = inkside_poetas.rol_codigo
                WHERE rol_nombre = ?";

       $query = $this->pdo->prepare($sql);
       $query->execute(array($rol));

       $result = $query->fetchALL(PDO::FETCH_BOTH);

     }catch(PDOException $e){
      $result = array(0,$e->getMessage(),$e->getCode());
    }

    return $result;
  }


    public function datosPoetabyEmail($email){
      try{
         $sql = "SELECT * FROM inkside_poetas WHERE poet_email = ?";

         $query = $this->pdo->prepare($sql);
         $query->execute(array($email));

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
