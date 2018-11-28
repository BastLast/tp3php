<?php if(empty($_SESSION['co'])){
  ?>
  <h1>Vous devez être connecté pour afficher cette page !</h1>
  Vous allez être redirigé dans 2 secondes.
  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
  <?php
}else{
  ?>
  <h1>Rechercher un trajet</h1>
  <?php
}
?>
