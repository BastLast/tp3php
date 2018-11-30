<?php if(empty($_SESSION['co'])){
  ?>
  <h1>Vous devez être connecté pour afficher cette page !</h1>
  Vous allez être redirigé dans 2 secondes.
  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
  <?php
}else{
  ?>
  <h1>Proposer un trajet</h1>
  <?php
  if (empty($_POST)){
    ?>
    <form action="#" id="FormVilleDepart" method="post">
      Ville de départ :
      <select name="villeD" onChange='javascript:document.getElementById("FormVilleDepart").submit()'>
        <?php
        $listeVilles = $villeManager->getListReferenced();
        foreach ($listeVilles as $ville) {
          echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>

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
    $db = new Mypdo();
    $parcoursManager = new ParcoursManager($db);
    $parcoursManager -> addParcours($parcour);

    ?>
    <img src="image\valid.png" alt="confirmation validee">
    Le parcours a bien été ajouté
    <?php
  }
  ?>






  <?php
}
?>
