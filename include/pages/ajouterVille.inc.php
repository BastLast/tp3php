<h1>Ajouter une ville</h1>
<?php
if (empty($_POST)){
  ?>
  <form action="#" id="FormVille" method="post">
    <label>Nom :</label><input type="text" name="vil_nom" size="4" required>
    <input class="button" type="submit" value="Ok" />
  </form>
  <?php
}else{
  ?>
  <?php
  $ville = new Ville($_POST);

  $villeManager -> addVille($ville);

  ?>
  <img src="image\valid.png" alt="confirmation validee">
  La ville "<b><?php
  echo $_POST["vil_nom"];
  ?></b>" a bien été ajoutée
  <?php
}
?>
