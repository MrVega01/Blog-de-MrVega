<?php
class RepositorioConfirmacionEmail {
  public static function crearPeticionDeConfirmacion($conexion, $idUsuario, $urlSecreta){
    $peticionCreada = false;

    if (isset($conexion)) {
      try {
        $sql = "INSERT INTO confirmacion_email(usuario_id, url_secreta, fecha) VALUES(:usuario_id, :url_secreta, NOW())";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':usuario_id', $idUsuario, PDO::PARAM_STR);
        $sentencia -> bindParam(':url_secreta', $urlSecreta, PDO::PARAM_STR);
        $peticionGenerada = $sentencia -> execute();

        if ($peticionGenerada) {
          $peticionCreada = true;
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $peticionCreada;
  }
  public static function comprobarPeticionDeConfirmacion($conexion, $urlSecreta){
    $peticionExiste = [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM confirmacion_email WHERE url_secreta = :url_secreta";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':url_secreta', $urlSecreta, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if ($resultado) {
          $peticionExiste = $resultado;
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $peticionExiste;
  }
  public static function eliminarPeticionDeConfirmacion($conexion, $idUsuario){
    $peticionEliminada = false;

    if (isset($conexion)) {
      try {
        $sql = "DELETE FROM confirmacion_email WHERE usuario_id = :idUsuario";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $peticion = $sentencia -> execute();

        if ($peticion) {
          $peticionEliminada = true;
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $peticionEliminada;
  }
}
?>
