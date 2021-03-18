<?php
include_once "app/config.inc.php";
include_once "app/config.inc.php";

include_once "app/Usuario.inc.php";
include_once "app/Comentario.inc.php";
include_once "app/Entrada.inc.php";

include_once "app/RepositorioUsuario.inc.php";
include_once "app/RepositorioComentario.inc.php";
include_once "app/RepositorioEntrada.inc.php";

Conexion::abrirConexion();

for ($usuario=0; $usuario < 0; $usuario++) {
  $nombre= sa(10);
  $email= sa(5)."@".sa(5);
  $password= password_hash('1234567890', PASSWORD_DEFAULT);

  $usuarios= new Usuario('', $nombre, $email, $password, '', '');
  RepositorioUsuario::insertarUsuario(Conexion::obtenerConexion(), $usuarios);
}
for ($entrada=0; $entrada < 0; $entrada++) {
  $autor= rand(1,100);
  $titulo= sa(10);
  $url = $titulo;
  $texto= lorem();

  $entradas = new Entrada('', $autor, $url, $titulo, $texto, '', '');
  RepositorioEntrada::insertarEntrada(Conexion::obtenerConexion(), $entradas);
}
for ($comentario=0; $comentario < 0; $comentario++) {
  $titulo= sa(10);
  $texto= lorem();
  $autorid= rand(1,100);
  $entradaid= rand(1,100);
  $comentarios = new Comentario('', $autorid, $entradaid, $titulo, $texto, '');
  RepositorioComentario::insertarComentario(Conexion::obtenerConexion(), $comentarios);
}
function sa($longitud){
  $caracteres='1234567890qwertyuiopasdfghjklzxcvbnnmQWERTYUIOPASDFGHJKLZXCVBNM';
  $numerocaracteres=strlen($caracteres);
  $string="";

  for ($i= 0; $i < $longitud; $i++) {
    $string .= $caracteres[rand(0, $numerocaracteres - 1)];
  }
  return $string;
}
function lorem(){
  $lorem= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar maximus diam sit amet aliquam. Cras eget lacinia eros. Vestibulum dictum tempus tellus. Sed eleifend gravida felis eget facilisis. Morbi euismod interdum mi sit amet pretium. Aenean sit amet felis id erat volutpat dignissim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam ligula felis, tincidunt sed laoreet quis, commodo a mauris. Vestibulum id consectetur diam. Suspendisse et ipsum nec purus venenatis rutrum condimentum quis nisl. Mauris dolor ex, placerat at auctor a, pulvinar eget libero. Sed placerat vel nunc eget lacinia. Pellentesque consequat ante non nisi molestie lacinia ut quis tellus.

Cras id lectus vel leo laoreet mollis. In hac habitasse platea dictumst. Nulla ornare nisl metus, sit amet consectetur purus blandit a. Morbi ac placerat nisi. Etiam ac venenatis mauris. Sed convallis ante venenatis arcu efficitur malesuada. Donec blandit, ex et hendrerit rutrum, nisl lectus ultricies tellus, in maximus arcu felis eu purus.

Nam metus libero, eleifend ac facilisis vitae, blandit id enim. Integer quis odio suscipit, aliquam ligula rhoncus, sodales turpis. Sed eget ante semper, auctor lectus eu, imperdiet massa. Sed lacinia quam non nisl interdum molestie. Curabitur in aliquet tortor, id laoreet mauris. Aliquam tempus ligula finibus elementum pulvinar. Nunc gravida nulla tortor, quis mattis mauris efficitur nec. Mauris blandit, erat sit amet efficitur viverra, mauris risus tincidunt nisi, in finibus neque neque vel odio. Sed et mollis enim, nec accumsan tellus. In auctor, ex vitae pellentesque convallis, eros felis pretium quam, non interdum augue elit sed sem. Phasellus hendrerit pellentesque lectus, quis tempor dui pharetra vitae. Sed nec nisi tristique, volutpat leo eget, accumsan tellus. Vivamus lacinia varius lectus, vitae facilisis orci venenatis sit amet.

Quisque ac ligula id est tincidunt ultricies. Proin ac finibus arcu. Sed vitae nunc sagittis, vestibulum ex vitae, venenatis mi. Ut eget neque lectus. Praesent fringilla luctus arcu, vitae rutrum elit semper tempor. Aliquam at lorem quis neque pellentesque condimentum. Aenean sollicitudin, justo finibus molestie hendrerit, orci dolor viverra tellus, tincidunt rutrum tortor mi ut mi. Morbi id urna dapibus, sollicitudin mi et, eleifend nisl. Donec egestas odio lacinia malesuada feugiat. In ultrices eu velit pretium ultrices. Vivamus sapien ante, accumsan interdum vestibulum ut, sodales sit amet risus. Integer consequat maximus quam, in vestibulum nulla consequat ut. Proin a semper erat, ac aliquet ligula. Duis aliquam ultricies tortor.

Sed blandit mollis iaculis. Donec id ornare urna. Proin sit amet tortor id nunc posuere vestibulum. Praesent quis condimentum sem. Integer vitae elit fringilla, porttitor lacus in, ultricies nisi. Etiam vel molestie nulla. Nulla at justo dapibus, pulvinar arcu non, bibendum sapien. Aenean dignissim magna rhoncus dolor ultrices elementum. Nulla fermentum, eros et commodo auctor, dolor elit dapibus metus, at fermentum ligula lorem nec massa.

Fusce ac ultricies turpis. Curabitur sollicitudin velit non velit dictum convallis. Vestibulum imperdiet, risus sed dapibus venenatis, velit lacus ullamcorper elit, eget dictum augue libero et ipsum. Ut porta nulla quis suscipit pharetra. Vivamus porta leo in ipsum laoreet rhoncus. Vivamus et turpis iaculis, iaculis libero ac, viverra velit. Nulla facilisi. Duis in sagittis sapien. Morbi ullamcorper mi at libero interdum, lobortis molestie est volutpat. Pellentesque semper pulvinar mauris id fermentum. Fusce dapibus dignissim risus vel consectetur.

Nunc et nisi non turpis semper iaculis. Quisque viverra consequat massa quis elementum. Maecenas condimentum maximus magna, hendrerit malesuada justo vulputate iaculis. Morbi rhoncus dolor a justo congue, et hendrerit ligula pretium. Ut sed sapien non ex facilisis dictum et eu arcu. Ut ultricies ac augue non commodo. Duis porttitor efficitur lorem, at feugiat tortor posuere posuere. Vestibulum dignissim nibh sed lorem laoreet pulvinar. Etiam leo purus, varius in dictum quis, consectetur id tortor. Quisque venenatis orci quis magna gravida, ultrices volutpat ante pharetra. Nunc finibus urna velit, in porta urna porta id. Mauris in egestas enim. Praesent mi ex, fringilla ornare erat non, porta consequat nisl. Vestibulum venenatis aliquet mi, a aliquam ipsum vestibulum a. Aliquam consequat dapibus tellus a mattis.";
  return $lorem;
}

 ?>
