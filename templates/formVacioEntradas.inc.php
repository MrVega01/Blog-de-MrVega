<form class="form-nueva-entrada" action="<?php echo ROUTE_NEW_ENTRADA; ?>" method="post">
  <div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder='No es recomendable usar emoticonos en el título.'>
    <label for="texto">Contenido de la entrada</label>
    <textarea name="texto" class="form-control" id="texto" rows="10" cols="80"  placeholder='Escribe tu artículo...'></textarea>
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="borrador" id="borrador" value="no">
      <label class="custom-control-label" for="borrador">No publicar y guardar como borrador</label>
    </div>
    <button type="submit" name="submit" class="btn btn-danger dark animation px-4 py-2"><span>Enviar</span></button>
  </div>
</form>
