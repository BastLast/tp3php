<h1>Ajouter une personne</h1>
<?php

$db=new Mypdo();
$villeManager=new PersonneManager($db);
if (empty($_POST)){ 
?>

	<form action="#" id="FormPersonne" method="post">
	Nom: <input type="text" name="nom" size="4">
	Prenom: <input type="text" name="prenom" size="4"><br>
	Telephone: <input type="text" name="tel" size="4">
	Mail: <input type="text" name="mail" size="4"><br>
	Login: <input type="text" name="login" size="4">
	Mot de passe: <input type="text" name="pdp" size="4"><br>
	Categorie: <input type="radio" name="etudiant" size="4"> Etudiant
	<input type="radio" name="personnel" size="4"> Personnel
	<input type="submit" value="Valider">
	</form>

<?php
}else{
	if(isset($_POST['personnel'])){?>
		<form id="FormPersonnel">
		Telephone professionnel: <input type="text" id="telpro">
		Fonction: <select name="fonction">
    <?php
			foreach ($listeFonction as $fonction) {
				echo '<option value="'.$fonction->getNumFonction().'">'.$fonction->getNomFonction().'</option>';
			}
		  ?>
		</select>
		<input type="submit" value="Valider">
		</form>
<?php	
	}
	
	if(isset($_POST['etudiant'])){?>
	<form>
	Annee: <select name="annee">
		<?php
			foreach ($listeAnnee as $annee) {
				echo '<option value="'.$annee->getNumAnnee().'">'.$annee->getNomAnnee().'</option>';
		}
		?>
		</select>
	Departement: <select name="dep">
		<?php
			foreach ($listeDep as $dep) {
				echo '<option value="'.$dep->getNumDep().'">'.$dep->getNomDep().'</option>';
			}
		?>
		</select>
	<input type="submit" value="Valider">
		</form>
		<?php
	}
}	
?>










