<div class="row">
  <div class="col-md-12">
    <div class="jumbotron jumbotron-fluid dark marginjumbo">
      <div class="container">
        <h3 class="display-4">Administración de entradas</h3>
          <?php if (count($array_entradas) === 0) { ?>
          <p class="lead">Aún no has escrito entradas.</p>
          <?php } ?>
          <br>
          <a class="btn btn-dark" role="button" href="<?php echo ROUTE_NEW_ENTRADA; ?>">Escribe una nueva entrada</a>
      </div>
    </div>
  </div>
  <div class="col-md-12 p-0 text-center table-responsive">
    <table class="table table-striped table-dark tablaDinamica">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Título</th>
          <th>Comentarios</th>
          <th>Estado</th>
          <th>Opciones</th>
        </tr>
      </thead>
        <tbody>
      <?php if (count($array_entradas) > 0){
        for ($i=0; $i < count($array_entradas); $i++) {
          $entrada_actual = $array_entradas[$i][0];
          $comentarios_actuales = $array_entradas[$i][1];
          ?>
          <tr>
            <td><?php echo $entrada_actual -> getFecha() ?></td>
            <td><a class="whitecolor" href="<?php echo ROUTE_ENTRADA . '/' . $entrada_actual -> getUrl(); ?>"><?php echo $entrada_actual -> getTitulo() ?></a></td>
            <td><?php echo $comentarios_actuales; ?></td>
            <td><?php if ($entrada_actual -> getActiva()){
              echo 'Activa';} else{ echo 'Borrador'; } ?>
            </td>
            <td>
              <div class="dropdown">
              <button class="btn btn-dark btn-sm dropdown-toggle" id="entradatoggler" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog fa-fw"></i></button>
              <div class="dropdown-menu dropstyle" id="darkcolor" aria-labelledby="entradatoggler">
                <form action="<?php echo ROUTE_EDIT_ENTRADA; ?>" method="post">
                  <input type="hidden" name="id_editar" value="<?php echo $entrada_actual -> getId(); ?>">
                  <button class="dropdown-item" type="submit" name="editar"><i class="fas fa-edit fa-fw"></i> Editar</button>
                </form>
                <form action="<?php echo ROUTE_DELETE_ENTRADA; ?>" method="post">
                  <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual-> getId(); ?>">
                  <button class="dropdown-item" type="submit" name="borrar"><i class="fas fa-trash-alt fa-fw"></i> Eliminar</button>
                </form>
              </div>
              </div>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      <?php } else { ?>
          <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            </tr>
        </tbody>
      <?php } ?>
    </table>
  </div>
</div>
