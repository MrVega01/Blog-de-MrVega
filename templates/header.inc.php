<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <?php
    if (!isset($title) || empty($title)) {
      $title = "Blog de MrVega";
    }
    echo "<title>$title</title>";
    ?>
    <link rel="stylesheet" href="<?php echo ROUTE_CSS ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROUTE_CSS ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  </head>
  <body>
