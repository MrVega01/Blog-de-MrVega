<div class="form-group">
  <label for="userlabel" class="h6">Nombre de usuario</label>
  <input type="text" class="form-control is-invalid" id="userlabel" required autofocus name="user" placeholder="Usuario"
  <?php $validacion -> mostrarUser(); ?>
  >
  <?php $validacion -> mostrarErrorUser(); ?>
</div>
<div class="form-group">
  <label for="emaillabel" class="h6">Correo electrónico</label>
  <input type="email" class="form-control is-invalid" id="emaillabel" required name="email" placeholder="usuario@servicio.com"
  <?php $validacion -> mostrarEmail(); ?>
  >
  <?php $validacion -> mostrarErrorEmail(); ?>
</div>
<div class="form-row">
<div class="form-group col-lg-6">
  <label for="passwordlabel" class="h6">Contraseña</label>
  <input type="password" class="form-control is-invalid" required id="passwordlabel" name="pass1">
  <?php $validacion -> mostrarErrorPass1(); ?>
</div>
<div class="form-group col-lg-6">
  <label for="password2label" class="h6">Repite tu contraseña</label>
  <input type="password" class="form-control is-invalid" id="password2label" required name="pass2">
  <?php $validacion -> mostrarErrorPass2(); ?>
</div>
</div>
<div class="text-center">
  <button type="submit" class="btn btn-danger form-control mt-2 dark animation" name="submit"><span>Unirse</span></button>
</div>
