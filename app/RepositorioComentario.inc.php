<?php
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Comentario.inc.php";

class RepositorioComentario{

  public static function insertarComentario($conexion, $comentario){
    $insertarComentario = false;

    if (isset($conexion)) {
      try {
        $sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id, :entrada_id, :titulo, :texto, NOW())";

        $autoridtemp = $comentario -> getAutorId();
        $entradaidtemp = $comentario -> getEntradaId();
        $titulotemp = $comentario -> getTitulo();
        $textotemp = $comentario -> getTexto();

        $sentencia = $conexion -> prepare($sql);

        $sentencia -> bindParam(':autor_id', $autoridtemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':entrada_id', $entradaidtemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':titulo', $titulotemp, PDO::PARAM_STR);
        $sentencia -> bindParam(':texto', $textotemp, PDO::PARAM_STR);

        $insertarComentario = $sentencia -> execute();
      } catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $insertarComentario;
  }
  public static function ObtenerComentariosId($conexion, $entradaId){
    $comentarios = [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM comentarios WHERE entrada_id = :entradaId ORDER BY fecha DESC";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':entradaId', $entradaId, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();
        if (!empty($resultado)) {
          foreach ($resultado as $fila) {
            $comentarios[] = new Comentario ($fila['id'], $fila['autor_id'], $fila['entrada_id'], $fila['titulo'],
            $fila['texto'], $fila['fecha']);
          }
        }
      } catch (PDOException $e) {
        print "Error" . $e -> getMessage();
      }
    }
    return $comentarios;

  }
  public static function contarComentarios($conexion, $idUsuario){
    $comentarios = 0;

    if (isset($conexion)) {
      try {
        $sql = "SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autor_id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':autor_id', $idUsuario, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetch();

        if (!empty($resultado)) {
          $comentarios = $resultado['total_comentarios'];
        }}
        catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $comentarios;
  }
  public static function obtenerComentariosPorId($conexion, $idUsuario){
    $comentarios = [];

    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM comentarios WHERE autor_id = :autor_id";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> bindParam(':autor_id', $idUsuario, PDO::PARAM_STR);
        $sentencia -> execute();
        $resultado = $sentencia -> fetchAll();

        if (!empty($resultado)) {
          foreach ($resultado as $fila) {
            $comentarios[] = new Comentario($fila["id"], $fila["autor_id"], $fila["entrada_id"], $fila["titulo"],
            $fila["texto"], $fila["fecha"]);
          }
        }
      }
        catch (PDOException $e) {
        print "ERROR" . $e -> getMessage();
      }
    }
    return $comentarios;
  }

}
 ?>
