
<h1>Ajouter une personne</h1>
<?php

if (empty($_POST)){ // c'est la premiere fois que la page est appelée

	?>


	<form action="#" id="FormPersonne" method="post">
		Nom: <input type="text" name="nom" size="4" required>
		Prenom: <input type="text" name="prenom" size="4" required><br>
		Telephone: <input type="text" name="tel" size="4" required>
		Mail: <input type="email" name="mail" size="4" required><br>
		Login: <input type="text" name="login" size="4" required>
		Mot de passe: <input type="password" name="pdp" size="4" required><br>
		Categorie: <input type="radio" name="type" value="etudiant" size="4" checked="checked"> Etudiant
		<input type="radio" name="type" value="personnel" size="4"> Personnel
		<input type="submit" value="Valider">
	</form>


	<?php

}else{ // ce n'est pas la premiere fois que la page est appelee


	if(!empty($_POST["type"])){
		$_SESSION['type'] = $_POST["type"];
		$password = sha1(sha1($_POST['pdp']).SALT);
		$_SESSION['personne'] = new Personne(
			array('per_nom' => $_POST['nom'],
			'per_prenom' => $_POST['prenom'],
			'per_tel' => $_POST['tel'],
			'per_mail' => $_POST['mail'],
			'per_login' => $_POST['login'],
			'per_pwd' => $password)
		);
		// c'est la deuxieme fois que la page est appelée

		if($_POST['type']== "personnel"){
			// la personne a ajouter fait partie du personnel
			?>
			<form id="FormPersonnel" method="post">
				Telephone professionnel: <input type="text" name="telpro" required>
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
			<form id="FormEtudiant" method="post">
				Annee: <select name="annee">
					<?php
					$listeDivisions = $divisionManager->getList();
					foreach ($listeDivisions as $division) {
						echo '<option value="'.$division->getDivNum().'">'.$division->getDivNom().'</option>';
					}
					?>
				</select>
				Departement: <select name="dep">
					<?php
					$listeDepartements = $departementManager->getList();
					foreach ($listeDepartements as $departement) {
						echo '<option value="'.$departement->getDepNum().'">'.$departement->getDepNom().'</option>';
					}
					?>
				</select>
				<input type="submit" value="Valider">
			</form>
			<?php
		}
	}
	else{ // il s'agit du troisieme à la page.
		?>
		<br>
		<br>
		<?php
		$personneManager -> addPersonne($_SESSION['personne']);

		$id = $db->lastInsertId(); // recuperation de l'id de la derniere personne enregistree
		if($_SESSION['type'] == "personnel"){// on doit enregistrer un nouveau membre du personnel
			$salarie = new Salarie(
				array('per_num' => $id,
				'sal_telprof' => $_POST['telpro'],
				'fon_num' => $_POST['fonction'])
			);
			$salarieManager -> addSalarie($salarie);
		}
		if($_SESSION['type']== "etudiant"){ // on doit enregistrer un nouvel étudiant
			$etudiant = new Etudiant(
				array('per_num' => $id,
				'dep_num' => $_POST['dep'],
				'div_num' => $_POST['annee'])
			);

			$etudiantManager -> addEtudiant($etudiant);
		}

		?>
		<img src="image\valid.png" alt="confirmation validee">
		La personne a bien été ajoutée

		<?php
		unset($_SESSION['type']);
		unset($_SESSION['personne']); // on supprime les variables de session dont on a plus besoin
	}
}

?>
