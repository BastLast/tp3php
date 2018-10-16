<h1>Ajouter une ville</h1

  <form action="#" id="SaisieNomVille" method="post">
    Nom :<input type="text" name="FormPrenomCli" size="4">
    <input type="submit" value="Ok" />
  </form>

  <?php
  $ville = new Ville($_POST);
  $db = new Mypdo();
  $villeManager = new VilleManager($db);
  $villeManager -> addville($ville);


  ?>
