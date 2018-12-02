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
      <label>Ville de départ :</label>
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
    if(empty($_POST['places'])){ //deuxieme passage sur la page
      $_SESSION['villeD'] = $_POST['villeD'];
      ?><label>Ville de départ :</label>  <?php
      $villeD = $villeManager->getVilleById($_SESSION['villeD']);
      echo $villeD->getNomVille();
      ?> <br>

      <form action="#" id="FormProposeTrajet" method="post">
        <label>Ville d'arrivée :</label> <select name="villeA">
          <?php
          $listeVillesCompatible = $villeManager->getListCompatible($_SESSION['villeD']);
          foreach ($listeVillesCompatible as $ville) {
            echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
          }
          ?>
        </select>
        <label>Date de départ :</label>
        <br>
        <?php
        $date = date("Y-m-d"); // récuperation de la date du jour
        echo '<input name="date" type="date" value="'.$date.'">'
        ?>
        <label>Heure de départ :</label>
        <br>
        <?php
        date_default_timezone_set('Europe/Paris');
        $heure = date("H:i:s"); // récuperation de l'heure du jour
        echo '<input name="heure" type="time" value="'.$heure.'">'
        ?>
        <label>Nombre de place :<label> <input name="places" type="text" size="4" required>
          <input class="button" type="submit" value="Valider">
        </form>

        <?php
      }
      else{ // 3 eme passage sur la page
        $parcours = $parcoursManager->getParcoursByVilles($_SESSION['villeD'],$_POST['villeA']);
        if($_SESSION['villeD'] == $parcours->getVille1()){
          $sens = 0;
        }else{
          $sens = 1;
        }
        $personne = $personneManager->getPersonneByLogin($_SESSION['co']);
        $propose = new Propose(
          array('par_num' => $parcours->getParNum(),
          'per_num' => $personne->getPerNum(),
          'pro_date' => $_POST['date'],
          'pro_time' => $_POST['heure'],
          'pro_place'=> $_POST['places'],
          'pro_sens' => $sens)
        );
        $proposeManager -> addPropose($propose);
        ?>
        <img src="image\valid.png" alt="confirmation validee">
        La proposition de trajet a bien été ajoutée
        <?php
      }
    }
  }
  ?>
