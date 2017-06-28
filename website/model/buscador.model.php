<?php
class BuscadorModel{
  private $pdo;

  public function __CONSTRUCT(){
    try {
        $this->pdo = DataBase::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
  }

  public function buscadorGlobal($filter){
    try{
    $sql = "(SELECT	'Poema' as 'type',
		                inkside_publicaciones.pub_codigo as 'Campo1',
		                inkside_publicaciones.pub_contenido as 'Campo2',
		                inkside_publicaciones.pub_imgPortada as 'Campo3',
                    inkside_publicaciones.pub_titulo as  'Campo4',
	                  inkside_publicaciones.pub_fechaPublicacion as 'Campo5',
                    inkside_poetas.poet_nick as poet_nick,
		                inkside_poetas.poet_foto as poet_foto,
                    inkside_poeta_descripcion.pdesc_avatar as pdesc_avatar
              FROM  inkside_publicaciones
        INNER JOIN  inkside_poetas ON inkside_publicaciones.poet_codigo = inkside_poetas.poet_codigo
         LEFT JOIN  inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
             WHERE  (inkside_publicaciones.pub_titulo LIKE '%".$filter."%' OR
			               inkside_publicaciones.pub_contenido LIKE '%".$filter."%' OR
                     inkside_publicaciones.pub_categoria LIKE '%".$filter."%' OR
                     inkside_poetas.poet_nick	LIKE '%".$filter."%') AND pub_estadoRevision = 'Aprobado' and pub_estado = 'Publicado' LIMIT 100)
            UNION

            (SELECT	'Poeta' as 'type', inkside_poetas.poet_codigo as 'Campo1', pdesc_acerca as 'Campo2', '' as 'Campo3', '' as 'Campo4', '' as 'Campo5',
                    inkside_poetas.poet_nick as poet_nick,
		                inkside_poetas.poet_foto as poet_foto,
                    inkside_poeta_descripcion.pdesc_avatar as pdesc_avatar
              FROM  inkside_poetas
         LEFT JOIN  inkside_poeta_descripcion ON inkside_poetas.poet_codigo = inkside_poeta_descripcion.poet_codigo
             WHERE  inkside_poetas.poet_nombre   LIKE '%".$filter."%' OR
			              inkside_poetas.poet_apellido LIKE '%".$filter."%' OR
                    inkside_poetas.poet_nick     LIKE '%".$filter."%' OR
                    inkside_poetas.poet_email    LIKE '%".$filter."%' LIMIT 100)" ;

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
