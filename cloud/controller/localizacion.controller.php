<?php
require "model/localizacion.model.php";

class localizacionController{

  private $localizacion;

  public function __CONSTRUCT(){
      $this->localizacion = new LocalizacionModel();
  }

  public function cargarPaises(){
      $paises = $this->localizacion->verPaises();

      echo "<select id='txt-pais' class='browser-default validate' require>";
          echo "<option value=''>Seleccione un País</option>";
      foreach ($paises as $pais) {
          echo "<option value='".$pais["pais_codigo"]."'>".$pais["pais_nombre"]."</option>";
      }
      echo "</select>";
  }

  public function cargarDepartamentos(){
    $pais_codigo = $_POST["idPais"];
    $deptos = $this->localizacion->verDepartamentos($pais_codigo);

    echo "<option value=''>Seleccione un Departamento</option>";
    foreach ($deptos as $depto) {
        echo "<option value='".$depto["dep_codigo"]."'>".$depto["dep_nombre"]."</option>";
    }

  }

  public function cargarCiudades(){
    $dep_codigo = $_POST["idDpto"];
    $ciudades = $this->localizacion->verCiudades($dep_codigo);

    echo "<option value=''>Seleccione una ciudad</option>";
    foreach ($ciudades as $ciudad) {
        echo "<option value='".$ciudad["ciu_codigo"]."'>".$ciudad["ciu_nombre"]."</option>";
    }

  }
}

?>
