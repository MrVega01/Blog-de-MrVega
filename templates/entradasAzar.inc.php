<div class="row">
  <div class="col-md-12 text-center my-3">
    <div class="card">
      <div class="card-header dark">
        <h5>Otras entradas <i class="fas fa-hand-point-down"></i></h5>
      </div>
      <div class="card-body">
        <div class="row">
          <?php
            for ($i=0; $i < count($entradas_azar); $i++) {
              $entrada_actual = $entradas_azar[$i];
              Conexion::abrirConexion();
              $autor_actual = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $entrada_actual -> getAutorId());
           ?>
          <div class="col-md-4 my-2">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center border-bottom mb-3 pb-3">
              <div class="col-12 imageSize text-center">
                <?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($entrada_actual -> getAutorId()); ?>
              </div>
            </div>
            <h5 class="card-title"><?php echo $entrada_actual -> getTitulo(); ?></h5>
            <p class="card-text text-muted">Por <a href="<?php echo LOCALHOST . "/" . strtolower($autor_actual -> getNombre()); ?>"><i class="fas fa-user"></i> <?php echo $autor_actual -> getNombre();?></a></p>
            <p class="card-text text-justify"><?php echo EscritorEntradas::resumirTexto($entrada_actual -> getTexto()) ?></p>
            <div class="row">
              <div class="col-md-6 text-left my-auto">
                <p class="card-text"><small class="text-muted"><?php echo $entrada_actual -> getFecha(); ?></small></p>
              </div>
              <div class="col-md-6 text-right">
                <a class="btn btn-danger dark animation px-4" href="<?php echo ROUTE_ENTRADA . "/" . $entrada_actual -> getUrl();?>"><span>Ver más  <i class="fas fa-arrow-alt-circle-right"></i></span></a>
              </div>
          </div>
          </div>
        </div>
      </div>
    <?php } Conexion::cerrarConexion() ?>
    </div>
  </div>
</div>
  </div>
  </div>
