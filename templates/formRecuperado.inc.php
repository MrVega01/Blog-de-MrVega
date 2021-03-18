<?php $entradaEditar = RepositorioEntrada::obtenerEntradaId(Conexion::obtenerConexion(), $_POST["id_editar"]); ?>
<form class="form-nueva-entrada" action="<?php echo ROUTE_EDIT_ENTRADA; ?>" method="post">
  <input type="hidden" name="id_entrada" value="<?php echo $_POST['id_editar']; ?>">
  <div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo"
    placeholder='Ejemplo: "Mejores tecnicas de la programación"' value="<?php echo $entradaEditar -> getTitulo(); ?>">
    <label for="texto">Contenido de la entrada</label>
    <textarea name="texto" class="form-control" id="texto" rows="10" cols="80"
    placeholder='Escribe tu artículo...'><?php echo $entradaEditar -> getTexto(); ?></textarea>
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="borrador" id="borrador" value="activador">
      <label class="custom-control-label" for="borrador">
        <?php if ($entradaEditar -> getActiva()) {?>
          Convertir en borrador.
        <?php } else { ?>
          Convertir en entrada pública.
        <?php } ?>
      </label>
    </div>
    <button type="submit" name="submit" class="btn btn-danger dark animation px-4 py-2"><span>Guardar cambios</span></button>
    <a href="<?php echo ROUTE_DASHBOARD_ENTRADAS ?>" class="btn btn-secondary mt-3 ml-2 px-4 py-2">Cancelar</a>
  </div>
</form>
