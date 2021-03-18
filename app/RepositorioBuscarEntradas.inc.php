<?php
class RepositorioBuscarEntradas {
  public static function BuscarEntradasGeneral($conexion, $palabra){
    $entradas = [];
    $palabra = '%' . $palabra . '%';

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM entradas WHERE titulo LIKE :palabra OR texto LIKE :palabra ORDER BY fecha DESC";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':palabra', $palabra, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (count($resultado)) {
          foreach ($resultado as $fila) {
            $entradas[] = new Entrada($fila["id"], $fila["autor_id"], $fila["url"], $fila["titulo"], $fila["texto"],
            $fila["fecha"], $fila["activa"]);
          }
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $entradas;
  }
  public static function BuscarEntradasConChecks($conexion, $palabra, $check, $radio){
    $devolver = [];
    $palabra = '%' . $palabra . '%';

    if (isset($conexion)) {
      try {
        if ($radio == "asc") {
          $orden = "ASC";
        }
        else {
          $orden = "DESC";
        }
        //VARIADOR DE PETICION DE SQL
        //1 CHECK
        if (count($check) === 1) {
          $eleccion = $check[0];
          if ($eleccion == "titulo") {
            $sql = "SELECT * FROM entradas WHERE titulo LIKE :palabra AND activa = 1 ORDER BY fecha " . $orden;
          }
          elseif ($eleccion == "contenido") {
            $sql = "SELECT * FROM entradas WHERE texto LIKE :palabra AND activa = 1 ORDER BY fecha " . $orden;
          }
          elseif ($eleccion == "autores") {
            $usuario = true;
            $sql = "SELECT id, nombre, fecha_registro, activo FROM usuarios WHERE nombre LIKE :palabra ORDER BY fecha_registro " . $orden;
          }
        }
        //2 CHECKS
        if (count($check) === 2) {
          $titulo = false;
          $texto = false;
          $usuario = false;
          for ($i=0; $i < count($check); $i++) {
            if ($check[$i] == "titulo") {
              $titulo = true;
            }
            if ($check[$i] == "contenido") {
              $texto = true;
            }
            if ($check[$i] == "autores") {
              $usuario = true;
            }
          }
          if ($titulo && $texto) {
            $sql = "SELECT * FROM entradas WHERE (activa = 1) AND (titulo LIKE :palabra OR texto LIKE :palabra) ORDER BY fecha " . $orden;
          }
          if ($titulo && $usuario) {
            $sql = "SELECT id, nombre, fecha_registro, activo FROM usuarios WHERE nombre LIKE :palabra ORDER BY fecha_registro " . $orden;
          }
          if ($texto && $usuario) {
            $sql = "SELECT id, nombre, fecha_registro, activo FROM usuarios WHERE nombre LIKE :palabra ORDER BY fecha_registro " . $orden;
          }
        }
        //3 CHECKS
        if (count($check) === 3) {
          $usuario = true;
          $sql = "SELECT id, nombre, fecha_registro, activo FROM usuarios WHERE nombre LIKE :palabra ORDER BY fecha_registro " . $orden;
        }
        //FIN DE VARIADOR
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':palabra', $palabra, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (count($resultado)) {
          foreach ($resultado as $fila) {
            if (isset($usuario) && $usuario) {
              $devolver[] = new Usuario($fila["id"], $fila["nombre"], "null" , "null" ,
              $fila["fecha_registro"], $fila["activo"]);
            }
            else {
              $devolver[] = new Entrada($fila["id"], $fila["autor_id"], $fila["url"], $fila["titulo"], $fila["texto"],
              $fila["fecha"], $fila["activa"]);
            }
          }
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $devolver;
  }
}
?>
