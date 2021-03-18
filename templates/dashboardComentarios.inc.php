<?php
Conexion::abrirConexion();
$comentarios = RepositorioComentario::obtenerComentariosPorId(Conexion::obtenerConexion(), $_SESSION["id_usuario"]);
Conexion::cerrarConexion();
?>

<p class="display-3 text-center my-4">Comentarios realizados <i class="fas fa-comment-dots"></i></p>
<div class="container panel">
<p class="lead"><b>Resultados <small>(<?php echo count($comentarios); ?>)</small></b></p>
<?php
if (count($comentarios)) {
  Conexion::abrirConexion();
  $autor = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $_SESSION["id_usuario"]);

  for ($i=0; $i < count($comentarios); $i++) {
    $comentario_actual = $comentarios[$i];
    $entrada_actual = RepositorioEntrada::obtenerEntradaId(Conexion::obtenerConexion(), $comentario_actual -> getEntradaId());
?>
<div class="card card-body mb-2">
  <h6 class="card-title"><a href="<?php echo LOCALHOST . "/" . strtolower($autor -> getNombre()); ?>"><i class="fas fa-user"></i> <?php echo $autor -> getNombre(); ?></a></h6>
  <p class="card-text text-justify"><?php echo nl2br($comentario_actual -> getTexto()); ?></p>
  <p class="card-text text-right"><small class="text-muted"><?php echo $comentario_actual -> getFecha(); ?></small></p>

  <a class="text-center nav-link lead" href="<?php echo ROUTE_ENTRADA . "/" . $entrada_actual -> getUrl(); ?>"><b><i class="fas fa-newspaper"></i></b>   <?php echo $entrada_actual -> getTitulo(); ?></a>
</div>
<?php
  }
  Conexion::cerrarConexion();
}
else {
?>
<p class=" text-center lead"><strong>No has escrito comentarios aún... <i class="fas fa-comment-slash"></i></strong></p>
<?php
}
?>
</div>
