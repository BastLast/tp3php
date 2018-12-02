<?php
if(empty($_SESSION['co'])){ // l'utilisateur n'est pas connecté
  ?>
  <h1>Vous devez être connecté pour afficher cette page !</h1>
  Vous allez être redirigé dans 2 secondes.
  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
  <?php
}else{ // l'utilisateur est connecté
  ?>
  <h1>Rechercher un trajet</h1>
  <?php
  if (empty($_POST)){ // premier passage sur la page de recherche de trajet
    ?>
    <form action="#" id="FormVilleDepart" method="post">
      <label>Ville de départ :</label>
      <select name="villeD" onChange='javascript:document.getElementById("FormVilleDepart").submit()'>
        <option value="Defaut">Choisissez une ville</option>
        <?php
        $listeVillesReferenced = $villeManager->getListReferencedinPropose();
        foreach ($listeVillesReferenced as $ville) {
          echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
        }
        ?>
      </select>
    </form>
    <?php
  }else{

    if(empty($_POST['villeA'])){ //deuxieme passage sur la page
      $_SESSION['villeD'] = $_POST['villeD'];
      ?>

      <form action="#" id="FormChercherTrajet" method="post">
		<div>
			<div>
				<label>Ville de départ :</label>  <?php
				$villeD = $villeManager->getVilleById($_SESSION['villeD']);
				echo $villeD->getNomVille();
				?>
			</div>

			<div>
				<label>Ville d'arrivée :</label> <select name="villeA">
				  <?php
				  $listeVillesCompatible = $villeManager->getListCompatible($_SESSION['villeD']);
				  foreach ($listeVillesCompatible as $ville) {
					echo '<option value="'.$ville->getNumVille().'">'.$ville->getNomVille().'</option>';
				  }
				  ?>
				</select>
			</div>
		</div>

		<div>
			<div>
				<label>Date de départ : </label>

				<?php
				$date = date("Y-m-d"); // récuperation de la date du jour
				echo '<input name="date" type="date" value="'.$date.'">'
				?>
			</div>

			<div>
				<label>Précision  :</label>
				<select name="precision">
				  <option value="0"> Ce jour</option>
				  <option value="1"> +/- 1 jour</option>
				  <option value="2"> +/- 2 jours</option>
				  <option value="3"> +/- 3 jours</option>
				</select>
			</div>
		</div>

		<div>
        <label>A partir de : <label>
          <select name="heuremin">
            <?php
            for ($compteur=0; $compteur <= 23; $compteur++) {
              echo '<option value="'.$compteur.'">'.$compteur.' h</option>';
            }
            ?>
          </select>
		</div>

		<div class="boutton">
          <input class="button" type="submit" value="Valider">
        </div>

		</form>

        <?php
      }

      else{ // troisieme passage sur la page
        $listePropose = $proposeManager->search(
          $_SESSION['villeD'],
          $_POST['villeA'],
          $_POST['date'],
          $_POST['heuremin'],
          $_POST['precision']);
          if($listePropose != null){
            ?>

            <table>
              <tr>
                <th>Ville départ</th>
                <th>Ville arrivée</th>
                <th>Date départ</th>
                <th>Heure départ</th>
                <th>Nombre de place(s)</th>
                <th>Nom du covoitureur</th>
              </tr>
              <?php


              foreach ($listePropose as $propose) {
                $conducteur =  $personneManager->getPersonneById($propose->getPerNum())
                ?>
                <tr>
                  <td><?php echo $villeManager->getVilleById($_SESSION['villeD'])->getNomVille() ?></td>
                  <td><?php echo $villeManager->getVilleById($_POST['villeA'])->getNomVille() ?></td>
                  <?php

                  ?>
                  <td><?php echo $propose->getProDate() ?></td>
                  <td><?php echo $propose->getProTime(); ?></td>
                  <td><?php echo $propose->getProPlace(); ?></td>
                  <td>
                    <?php
                    $note = $personneManager->getNoteByid($propose->getPerNum());
                    $dernierAvis = $personneManager->getLastAvisByid($propose->getPerNum());
                    ?>
                    <p>
                  <a href="#">  <?php echo $conducteur->getPerPrenom()." ". $conducteur->getPerNom();?>
                    <span>
                      Moyenne des avis : <?php echo $note; ?> Dernier avis : <?php echo $dernierAvis; ?>
                    </span>
                    </a>
                    </p>
                  </td>
                </tr>
              <?php } ?>
            </table>
            Laissez votre curseur sur un conducteur pour afficher des informations supplémentaires !

            <?php
          }else{
            ?>
            <img src="image/erreur.png" alt="Aucun résultat">
            Désolé pas de trajet disponible !
            <?php
          }
        }
      }
    }
    ?>
