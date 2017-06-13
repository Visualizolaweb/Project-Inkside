<?php
require "model/categorias.model.php";

class categoriasController{

  private $categorias;

  public function __CONSTRUCT(){
      $this->categorias = new CategoriasModel();
  }

  public function cargarCategorias(){
      $categorias = $this->categorias->verCategorias();
        echo "<select multiple id='txt_categoria' name='cat[]' class='validate' required>";
          echo "<option value='' disabled selected>Etiquetalo</option>";
      foreach ($categorias as $cat) {
          echo "<option value='".$cat["catePub_codigo"]."'>".$cat["catePub_nombre"]."</option>";
      }
      echo "</select>";
  }

  public function actualizaCategorias($micategoria){
      $categorias = $this->categorias->verCategorias();
        echo "<select multiple id='txt_categoria' name='cat[]' class='validate' required>";
          echo "<option value='".$categorias."' disabled selected>Etiquetalo</option>";

      $micategoria = explode(",",$micategoria);

      foreach ($categorias as $cat) {



          echo "<option value='".$cat["catePub_codigo"]."' ";

            for ($i=0; $i < count($micategoria); $i++) {
              if($micategoria[$i] == $cat["catePub_codigo"]){ echo "selected"; }
            }

          echo ">".$cat["catePub_nombre"]."</option>";
      }
      echo "</select>";
  }
}

?>
