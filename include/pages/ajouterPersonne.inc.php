<h1>Ajouter une personne</h1>
<?php

$db=new Mypdo();
$personneManager=new PersonneManager($db);
$fonctionManager =new FonctionManager($db);
if (empty($_POST)){ // c'est la premiere fois que la page est appelée
	?>

	<form action="#" id="FormPersonne" method="post">
		Nom: <input type="text" name="nom" size="4">
		Prenom: <input type="text" name="prenom" size="4"><br>
		Telephone: <input type="text" name="tel" size="4">
		Mail: <input type="text" name="mail" size="4"><br>
		Login: <input type="text" name="login" size="4">
		Mot de passe: <input type="text" name="pdp" size="4"><br>
		Categorie: <input type="radio" name="type" value="etudiant" size="4" checked="checked"> Etudiant
		<input type="radio" name="type" value="personnel" size="4"> Personnel
		<input type="submit" value="Valider">
	</form>

	<?php
}else{ // c'est la deuxieme fois que la page est appelée

	if($_POST['type']== "personnel"){
		// la personne a ajouter fait partie du personnel
		?>
		<form id="FormPersonnel">
			Telephone professionnel: <input type="text" id="telpro">
			Fonction: <select name="fonction">
				<?php
				$listeFonctions = $fonctionManager->getList();
				foreach ($listeFonctions as $fonction) {
					echo '<option value="'.$fonction->getFonNum().'">'.$fonction->getFonLib().'</option>';
				}
				?>
			</select>
			<input type="submit" value="Valider">
		</form>
		<?php
	}

	if($_POST['type']== "etudiant"){
		//la personne a ajouter est un etudiant
		?>
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
