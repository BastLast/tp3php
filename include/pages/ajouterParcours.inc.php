<h1>Ajouter un parcours</h1>
<?php

$db = new Mypdo();
$villeManager = new VilleManager($db);
if (empty($_POST)){
  ?>
  <form action="#" id="FormParcours" method="post">
    Ville 1 :
    <select name="ville1">
      <?php
      $listeVilles = $villeManager->getList();
      foreach ($listeVilles as $ville) {
        echo '<option value="'.$ville->getNomVille().'">'.$ville->getNomVille().'</option>';
      }
      ?>
      </select>
      Ville 2 :
      <select name="ville2">
        <?php
        foreach ($listeVilles as $ville) {
          echo '<option value="'.$ville->getNomVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>
        </select>
        Nombre de kilomètre(s) :<input type="text" name="vil_nom" size="4">
        <input type="submit" value="Valider" />
      </form>
      <?php
    }else{
      ?>
      <?php
      $parcour = new Parcours($_POST);
      $db = new Mypdo();
      $parcoursManager = new ParcoursManager($db);
      $parcoursManager -> addParcours($Parcour);

      ?>
      <img src="image\valid.png" alt="confirmation validee">
      Le parcours a bien été ajouté
      <?php
    }
    ?>
