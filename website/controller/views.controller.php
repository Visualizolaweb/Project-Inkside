<?php
require_once 'website/model/poetas.model.php';

class ViewsController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function index(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function inkside(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/queesinkside.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function ayudanos(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/ayudanos.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function reporta(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/reporta.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function ediciones(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/publicaciones.php';
    require_once 'website/views/include/structure-footer.php';
  }
  public function solicitaediciones(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/solicito-publicacion.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function cargarPublicacion(){

    $dataFilter = 'Poema';
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function cargarNoticia(){

    $dataFilter = 'Noticia';
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function cargarEvento(){

    $dataFilter = 'Evento';
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function cargarResultados(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/buscador/loadResult.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function poemas(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/poemas/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function perfilPoeta(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/poetas/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function comunidad(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/comunidad/index.php';
    require_once 'website/views/include/structure-footer.php';
  }



}
?>
