<h1>Ajouter un parcours</h1>
<?php
if (empty($_POST)){
  ?>
  <form action="#" id="FormParcours" method="post">
    Ville 1 :
    <select name="ville1">
      <?php
      while ($lign = Mysqli_fetch_array($resu)) {
        echo '<option value="'.$lign['NO_COMMANDE'].'">'.$lign['NO_COMMANDE'].'</option>';
      }
      ?>
      <input type="submit" value="Valider" />
    </form>
    <?php
  }else{
    ?>
    <?php
    $ville = new Ville($_POST);
    $db = new Mypdo();
    $villeManager = new VilleManager($db);

    $villeManager -> addVille($ville);

    ?>
    <img src="image\valid.png" alt="confirmation validee">
    La ville "<b><?php
    echo $_POST["vil_nom"];
    ?></b>" a bien été ajoutée
    <?php
  }
  ?>
