<h1>Ajouter un parcours</h1>
<?php

if (empty($_POST)){
  ?>
  <form action="#" id="FormParcours" method="post">
    <label>Ville 1 :</label>
    <select name="ville1">
      <?php
      $listeVilles = $villeManager->getList();
      foreach ($listeVilles as $ville) {
        echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
      }
      ?>
    </select>
    <label>Ville 2 :</label>
    <select name="ville2">
      <?php
      foreach ($listeVilles as $ville) {
        echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
      }
      ?>
    </select>
    <label>Nombre de kilomètre(s) :</label><input type="text" name="parkm" size="4" required>
    <input class="button" type="submit" value="Valider" />
  </form>
  <?php
}else{
  ?>
  <?php
  $parcour = new Parcours(
    array('par_km' => $_POST['parkm'],
    'vil_num1' => $_POST['ville1'],
    'vil_num2' => $_POST['ville2'])
  );
  $parcoursManager -> addParcours($parcour);

  ?>
  <img src="image\valid.png" alt="confirmation validee">
  Le parcours a bien été ajouté
  <?php
}
?>
