<?php
  require_once("controller/publicaciones.controller.php");
  $publicaciones = new PublicacionesController();

  $misPublicaciones = $publicaciones->misPublicaciones();
  $item = 1;
?>

<section id="wrap-container">
  <div class="row container-fluid">
    <div class="col m12 header-section">
      <h5 class="title">Mis Publicaciones</h5>
      <p>En esta sección podrás gestionar todas las publicaciones que has realizado, tales como: Poemas, Noticias y Eventos.
    </div>

    <!-- BOTON PARA CREAR POEMAS -->
    <div class="col m4">
      <a href="crear-poema">
        <div class="card-panel card-button pacifica z-depth-1">
          <div class="valign-wrapper">
              <i class="fa fa-lightbulb-o"></i>
              <span>CREAR POEMA</span>
          </div>
        </div>
      </a>
    </div>

    <!-- BOTON PARA CREAR NOTICIAS -->
    <div class="col m4">
      <a href="crear-Publicacion">
        <div class="card-panel card-button apple_chic z-depth-1">
          <div class="valign-wrapper">
              <i class="fa fa-paper-plane"></i>
              <span>CREAR NOTICIA</span>
          </div>
        </div>
      </a>
    </div>

    <!-- BOTON PARA CREAR EVENTOS -->
    <div class="col m4">
      <a href="crear-Eventos">
        <div class="card-panel card-button cherry_pink z-depth-1">
          <div class="valign-wrapper">
              <i class="fa fa-calendar"></i>
              <span>CREAR EVENTO</span>
          </div>
        </div>
      </a>
    </div>

    <div class="col m12 wrap-dataTable">
      <table id="dataGrid">
        <thead>
          <tr>
            <th>#</th>
            <th>Publicación</th>
            <th>Categoria</th>
            <th>Revisión</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php

          foreach ($misPublicaciones as $row) {

            switch ($row['Categoria']) {
              case 'Noticia': $icon = "<i class='fa fa-paper-plane'></i>"; break;
              case 'Evento': $icon = "<i class='fa fa-calendar'></i>"; break;
              default:   $icon = "<i class='fa fa-lightbulb-o'></i>"; break;
            }

            switch ($row['Revision']) {
              case 'Aprobado':
                $color = "green-text";
              break;

              case 'Por Revisar':
                $color = "amber-text";
              break;

              default:
                $color = "red-text";
                break;
            }
            echo "<tr>";
                  echo "<td>".$item."</td>";
                  echo "<td>".$row['publicacion']."</td>";
                  echo "<td>".$icon.' '.$row['Categoria']."</td>";
                  echo "<td><i class='fa fa-circle ".$color." '></i> ".$row['Revision']."</td>";
                  echo "<td>".$row['Estado']."</td>";
                  echo "<td>

                  <a href='pubID".$row['codigo']."'><i class='fa fa-eye'></i></a>&nbsp;&nbsp;";

                  switch ($row['Categoria']) {
                    case 'Poema':
                        echo "<a href='edita-poema-".$row['codigo']."' class='red-text'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;";
                    break;

                    case 'Noticia':
                        echo "<a href='pubID".$row['codigo']."' class='red-text'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;";
                    break;

                    case 'Evento':
                        echo "<a href='pubID".$row['codigo']."' class='red-text'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;";
                    break;

                  }
                  echo "<a href='elimino-pubID".$row['codigo']."'><i class='fa fa-trash-o'></i></a>&nbsp;&nbsp;

                  </td>";
            echo "</tr>";

            $item++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
