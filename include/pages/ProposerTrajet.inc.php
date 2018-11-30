<?php if(empty($_SESSION['co'])){ // l'utilisateur n'est pas connecté
  ?>
  <h1>Vous devez être connecté pour afficher cette page !</h1>
  Vous allez être redirigé dans 2 secondes.
  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
  <?php
}else{ // l'utilisateur est connecté
  ?>
  <h1>Proposer un trajet</h1>
  <?php
  if (empty($_POST)){ // premier passage sur la page de proposition de trajet
    ?>
    <form action="#" id="FormVilleDepart" method="post">
      Ville de départ :
      <select name="villeD" onChange='javascript:document.getElementById("FormVilleDepart").submit()'>
        <option value="Defaut">Choisissez une ville</option>
        <?php
        $listeVilles = $villeManager->getListReferenced();
        foreach ($listeVilles as $ville) {
          echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>
      </form>
      <?php
    }else{
      $_SESSION['villeD'] = $_POST['villeD'];
      ?>Ville de départ : <?php




    }

  }
  ?>
