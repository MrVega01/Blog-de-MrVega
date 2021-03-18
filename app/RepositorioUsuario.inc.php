<?php
class RepositorioUsuario {
  public static function obtenerTodos($conexion) {
    $usuarios = array();

    if (isset($conexion)) {

    try {
      include_once "Usuario.inc.php";
      $sql = "SELECT * FROM usuarios";
      $sentencia = $conexion -> prepare($sql);
      $sentencia -> execute();
      $resultado = $sentencia -> fetchAll();

      if (count($resultado)) {
        foreach ($resultado as $fila) {
          $usuarios[] = new Usuario(
            $fila["id"], $fila["nombre"], $fila["email"], $fila["password"], $fila["fecha_registro"], $fila["activo"]);
        }
      }
      else {
        print "No hay usuarios: ";
      }
    }
      catch (PDOException $e) {
      print "Error" . $e -> getMessage();
    }
    }
    return $usuarios;
  }
  public static function obtenerNumeroUsuarios($conexion) {
    $totalUsuarios = null;

    if (isset($conexion)) {
      try {
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        $totalUsuarios = $resultado["total"];
      } catch (PDOException $e) {
        print "Error: " . $e -> getMessage();
      }

    }
    return $totalUsuarios;
  }
  public static function insertarUsuario($conexion, $usuario){
    $insertarUsuario = false;

    if (isset($conexion)) {
      try {
        $sql = "INSERT INTO usuarios(nombre, email, password, fecha_registro, activo) VALUES(:nombre, :email, :password, NOW(), 1)";

        $nombretemp = $usuario -> getNombre();
        $emailtemp = $usuario -> getEmail();
        $passwordtemp = $usuario -> getPassword();

        $sentencia = $conexion -> prepare($sql);

        $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':email', $emailtemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':password', $passwordtemp, PDO::PARAM_STR);

        $insertarUsuario = $sentencia -> execute();
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $insertarUsuario;
  }
  public static function userExiste($conexion, $user){
    $nombreExiste = true;

    if (isset($conexion)) {
      try {
        $sql = "SELECT nombre FROM usuarios WHERE nombre = :nombre";

        $sentencia = $conexion -> prepare($sql);

        $sentencia -> bindParam(":nombre", $user, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (count($resultado)) {
          $nombreExiste = true;
        }
        else {
          $nombreExiste = false;
        }
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $nombreExiste;
  }
  public static function emailExiste($conexion, $email){
    $emailExiste = true;

    if (isset($conexion)) {
      try {
        $sql = "SELECT email FROM usuarios WHERE email = :email";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":email", $email, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (count($resultado)) {
          $emailExiste = true;
        }
        else {
          $emailExiste = false;
        }
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $emailExiste;
  }
  public static function ObtenerUsuarioEmail($conexion, $email){
    $usuario = null;

    if (isset($conexion)) {
      try {
        $sql= "SELECT * FROM usuarios WHERE email = :email";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":email", $email, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'],
          $resultado['fecha_registro'], $resultado['activo']);
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $usuario;
  }
  public static function ObtenerUsuarioId($conexion, $id){
    $usuario = null;

    if (isset($conexion)) {
      try {
        $sql= "SELECT * FROM usuarios WHERE id = :id";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":id", $id, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'],
          $resultado['fecha_registro'], $resultado['activo']);
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $usuario;
  }
  public static function ObtenerUsuarioConNombre($conexion, $user){
    $usuario = [];

    if (isset($conexion)) {
      try {
        $sql= "SELECT id, nombre, fecha_registro, activo FROM usuarios WHERE nombre = :nombre";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":nombre", $user, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $usuario = new Usuario($resultado['id'], $resultado['nombre'], "null" , "null",
          $resultado['fecha_registro'], $resultado['activo']);
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $usuario;
  }
  public static function ObtenerNombreUsuarioId($conexion, $id){
    $usuario = null;

    if (isset($conexion)) {
      try {
        $sql= "SELECT nombre FROM usuarios WHERE id = :id";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":id", $id, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $usuario = $resultado["nombre"];
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $usuario;
  }
  public static function activarCuenta($conexion, $id) {
    $cuentaActivada = false;

    if (isset($conexion)) {
      try {
        $sql = "UPDATE usuarios SET activo = 1 WHERE id = :id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(":id", $id, PDO::PARAM_STR);
        $cuentaActivada = $sentencia -> execute();

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $cuentaActivada;
  }
}

?>
