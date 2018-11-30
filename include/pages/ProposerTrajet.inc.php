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
        $listeVillesReferenced = $villeManager->getListReferenced();
        foreach ($listeVillesReferenced as $ville) {
          echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>
      </select>
    </form>
    <?php
  }else{
    $_SESSION['villeD'] = $_POST['villeD'];
    ?>Ville de départ :  <?php
    $villeD = new Ville($villeManager->getVilleById($_SESSION['villeD']));
    echo $villeD->getNomVille();
    ?> <br>

    <form action="#" id="FormProposeTrajet" method="post">
      Ville d'arrivée : <select name="villeA">
        <?php
        $listeVillesCompatible = $villeManager->getListCompatible($_SESSION['villeD']);
        foreach ($listeVillesCompatible as $ville) {
          echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>
      </select>
      Date de départ :
      <br>
      <?php
      $date = date("Y-m-j"); // récuperation de la date du jour
      echo '<input name="date" id="date" type="date" value="'.$date.'">'
      ?>
      Heure de départ :
      <br>
      <?php
      $heure = date("G:i:s"); // récuperation de l'heure du jour
      echo '<input name="heure" id="date" type="time" value="'.$heure.'">'
      ?>
    </form>



    <?php




  }

}
?>
