<div class="col-md-4">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header dark">
        Comentarios <i class="fas fa-comment-dots"></i>
      </div>
      <div class="card-body fila overflow-auto">
        <?php if (ControlSesion::comprobarSesion()) { ?>
          <form action="<?php ROUTE_ENTRADA; ?>" method="post">
            <textarea class="form-control" name="comentario" rows="2" cols="80" placeholder="Escribe un comentario"></textarea>
            <button class="form-control btn btn-danger dark animation my-3 mb-4" type="submit" name="comentar"><span>Comentar <i class="fas fa-paper-plane"></i></span></button>
          </form>
        <?php } else { ?>
          <p class="lead text-center"><a href="<?php echo ROUTE_LOGIN; ?>">Inicia sesión</a> o <a href="<?php echo ROUTE_SIGNUP ?>">registrate</a> para comentar.</p>
        <?php } ?>
        <div class="row">
<?php
if (count($comentarios) > 0) {

  for ($i=0; $i < count($comentarios); $i++) {
    $comentario_actual= $comentarios[$i];
    Conexion::abrirConexion();
    $autor_actual = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $comentario_actual -> getAutorId());
?>
<div class="col-md-12 mb-2">
  <div class="card">
    <div class="card-body">
      <h6 class="card-title"><a href="<?php echo LOCALHOST . "/" . strtolower($autor_actual -> getNombre()); ?>"><i class="fas fa-user"></i> <?php echo $autor_actual -> getNombre(); ?></a></h6>
      <p class="card-text text-justify"><?php echo nl2br($comentario_actual -> getTexto()); ?></p>
      <p class="card-text text-right"><small class="text-muted"><?php echo $comentario_actual -> getFecha(); ?></small></p>
    </div>
  </div>
</div>
<?php } Conexion::cerrarConexion(); ?>

<?php
}
elseif (ControlSesion::comprobarSesion()) {
?>

<h6 class="text-center mx-md-2 m-auto">Aún no hay comentarios, ¡sé el primero en comentar! <i class="fas fa-feather-alt"></i></h6>

<?php } ?>
      </div>
    </div>
  </div>

</div>
</div>

</div>
