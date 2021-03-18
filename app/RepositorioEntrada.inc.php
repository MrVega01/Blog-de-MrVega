<?php
include_once "app/config.inc.php";
include_once "app/Entrada.inc.php";
include_once "app/Conexion.inc.php";

class RepositorioEntrada {

  public static function insertarEntrada($conexion, $entrada){
    $insertarEntrada = false;

    if (isset($conexion)) {
      try {
        $sql = "INSERT INTO entradas(autor_id, url, titulo, texto, fecha, activa) VALUES(:autor_id, :url, :titulo, :texto, NOW(), :activa)";

        $autoridtemp = $entrada -> getAutorId();
        $urltemp = $entrada -> getUrl();
        $titulotemp = $entrada -> getTitulo();
        $textotemp = $entrada -> getTexto();
        $activatemp = $entrada -> getActiva();

        $sentencia = $conexion -> prepare($sql);

        $sentencia -> bindParam(':autor_id', $autoridtemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':url', $urltemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':titulo', $titulotemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':texto', $textotemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':activa', $activatemp, PDO::PARAM_STR);

        $insertarEntrada = $sentencia -> execute();
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $insertarEntrada;

  }
  public static function obtenerEntradasFecha($conexion){
    $entradas= [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM entradas WHERE activa = 1 ORDER BY fecha DESC LIMIT 5";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute();

        $resultado = $sentencia -> fetchAll();

        if (count($resultado)) {
          foreach ($resultado as $fila) {
            $entradas[]= new Entrada(
            $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
          }
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $entradas;
  }
  public static function obtenerEntradaUrl($conexion, $url) {
  $entrada = null;
  if (isset($conexion)) {
    try {
      $sql = "SELECT * FROM entradas WHERE url LIKE :url";
      $sentencia = $conexion -> prepare($sql);
      $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
      $sentencia -> execute();
      $resultado = $sentencia -> fetch();

      if (!empty($resultado)) {
        $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'],
        $resultado['texto'], $resultado['fecha'], $resultado['activa']);
      }
    } catch (PDOException $e) {
      print "Error" . $e -> getMessage();
    }
  }
  return $entrada;
}
public static function obtenerEntradaId($conexion, $id) {
$entrada = null;
if (isset($conexion)) {
  try {
    $sql = "SELECT * FROM entradas WHERE id = :id";
    $sentencia = $conexion -> prepare($sql);
    $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
    $sentencia -> execute();
    $resultado = $sentencia -> fetch();

    if (!empty($resultado)) {
      $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'],
      $resultado['texto'], $resultado['fecha'], $resultado['activa']);
    }
  } catch (PDOException $e) {
    print "Error" . $e -> getMessage();
  }
}
return $entrada;
}
  public static function obtenerEntradasAzar($conexion, $limite){
    $entradas = [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM entradas WHERE activa = 1 ORDER BY RAND() LIMIT $limite";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (!empty($resultado)) {
          foreach ($resultado as $fila) {
            $entradas[]= new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'],
            $fila['fecha'], $fila['activa']);
          }
        }
      } catch (PDOException $e) {
        print "Error" . $e -> getMessage();
      }

    }
    return $entradas;
  }
  public static function contarEntradasActivas($conexion, $idUsuario){
    $entradas = 0;

    if (isset($conexion)) {
      try {
        $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa = 1";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':autor_id', $idUsuario, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $entradas = $resultado['total_entradas'];
        }}
        catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $entradas;
  }
  public static function contarEntradasInactivas($conexion, $idUsuario){
    $entradas = 0;

    if (isset($conexion)) {
      try {
        $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa = 0";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':autor_id', $idUsuario, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $entradas = $resultado['total_entradas'];
        }}
        catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $entradas;
  }
  public static function MostrarEntradaYComentarios($conexion, $autorId){
    $entradas = [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios'
          FROM entradas a LEFT JOIN comentarios b ON a.id = b.entrada_id
          WHERE a.autor_id = :autor_id
          GROUP BY a.id
          ORDER BY a.fecha DESC";

        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':autor_id', $autorId, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (!empty($resultado)) {
        foreach ($resultado as $fila) {
          $entradas[] = array(new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'],
          $fila['fecha'], $fila['activa'], $fila['cantidad_comentarios']),
          $fila['cantidad_comentarios']
          );
          }
        }
      }
       catch (PDOException $e) {
        print 'ERROR' . $e -> getMessage();
      }
      return $entradas;
    }
  }
  public static function UrlExiste($url, $conexion) {
    $url_existe = true;

    if (isset($conexion)) {
      try {
        $sql = 'SELECT * FROM entradas WHERE url = :url';
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();
        if (count($resultado) == 0) {
          $url_existe = false;
        }

      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }

    }
    return $url_existe;
  }
  public static function BorrarEntradaYComentarios($idEntrada, $conexion){
    if (isset($conexion)) {
      try {
        $conexion -> beginTransaction();

        $sql1 = "DELETE FROM comentarios WHERE entrada_id = :entradaId";
        $sentencia1 = $conexion -> prepare($sql1);
        $sentencia1 -> bindParam(":entradaId", $idEntrada, PDO::PARAM_STR);

        $sql2 = "DELETE FROM entradas WHERE id = :entradaId";
        $sentencia2 = $conexion -> prepare($sql2);
        $sentencia2 -> bindParam(":entradaId", $idEntrada, PDO::PARAM_STR);

        $sentencia1 -> execute();
        $sentencia2 -> execute();

        $conexion -> commit();

      } catch (PDOException $e) {
        $conexion -> rollBack();
        print "ERROR" . $e -> getMessage();
      }
    }
  }
  public static function actualizarEntrada($conexion, $id, $titulo, $texto, $url, $activa){
    $actualizacionCorrecta = false;
    if (isset($conexion)) {
      try {
        $sql = "UPDATE entradas SET titulo = :titulo, texto = :texto, url = :url, activa = :activa WHERE id = :id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia-> bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $sentencia-> bindParam(":texto", $texto, PDO::PARAM_STR);
        $sentencia-> bindParam(":url", $url, PDO::PARAM_STR);
        $sentencia-> bindParam(":activa", $activa, PDO::PARAM_STR);
        $sentencia-> bindParam(":id", $id, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> rowCount();

        if ($resultado) {
          $actualizacionCorrecta = true;
        }
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $actualizacionCorrecta;
  }
  public static function obtenerEntradasAutorId($conexion, $idAutor) {
  $entradas = [];
  if (isset($conexion)) {
    try {
      $sql = "SELECT * FROM entradas WHERE autor_id = :autorId";
      $sentencia = $conexion -> prepare($sql);
      $sentencia -> bindParam(':autorId', $idAutor, PDO::PARAM_STR);
      $sentencia -> execute();
      $resultado = $sentencia -> fetchAll();

      if (!empty($resultado)) {
        foreach ($resultado as $fila) {
          $entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'],
          $fila['texto'], $fila['fecha'], $fila['activa']);
        }

      }
    } catch (PDOException $e) {
      print "Error" . $e -> getMessage();
    }
  }
  return $entradas;
  }
  public static function obtenerEntradasPublicasAutorId($conexion, $idAutor) {
  $entradas = [];
  if (isset($conexion)) {
    try {
      $sql = "SELECT * FROM entradas WHERE autor_id = :autorId AND activa = 1";
      $sentencia = $conexion -> prepare($sql);
      $sentencia -> bindParam(':autorId', $idAutor, PDO::PARAM_STR);
      $sentencia -> execute();
      $resultado = $sentencia -> fetchAll();

      if (!empty($resultado)) {
        foreach ($resultado as $fila) {
          $entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'],
          $fila['texto'], $fila['fecha'], $fila['activa']);
        }

      }
    } catch (PDOException $e) {
      print "Error" . $e -> getMessage();
    }
  }
  return $entradas;
  }
}


 ?>
