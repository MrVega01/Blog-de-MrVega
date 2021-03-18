<?php
class RepositorioRecuperarPassword {
  public static function generarPeticion($conexion, $id_usuario, $urlSecreta){
    $peticionGenerada= false;

    if (isset($conexion)) {
      try {
        $sql = "INSERT INTO recuperacion_clave(usuario_id, url_secreta, fecha) VALUES (:usuarioId, :url_secreta, NOW())";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':usuarioId', $id_usuario, PDO::PARAM_STR);
        $sentencia -> bindParam(':url_secreta', $urlSecreta, PDO::PARAM_STR);
        $peticionGenerada = $sentencia -> execute();

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $peticionGenerada;
  }
  public static function urlSecretaExisteYDevolverIdUsuario($conexion, $url){
    $urlExiste = false;

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":url_secreta", $url, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $urlExiste = $resultado['usuario_id'];
        }
        else {
          $urlExiste = -1;
        }
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $urlExiste;
  }
  public static function actualizarPassword($pass, $conexion, $id) {
    $passActualizada = false;

    if (isset($conexion)) {
      try {
        $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':password', $pass, PDO::PARAM_STR);
        $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> rowCount();

        if ($resultado > 0) {
          $passActualizada = true;
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $passActualizada;
  }
  public static function eliminarPeticionDeRecuperacion($conexion, $id){
    $peticionEliminada = false;

    if (isset($conexion)) {
      try {
        $sql = "DELETE FROM recuperacion_clave WHERE usuario_id = :id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> rowCount();

        if ($resultado) {
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
