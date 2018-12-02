

<?php

if (empty($_POST)){ // c'est la premiere fois que la page est appelée

	?>

<h1>Ajouter une personne</h1>
	<form action="#" id="FormPersonne" method="post">
		<div>
			<div>
				<label>Nom:</label> <input  type="text" name="nom" size="16" required>
			</div>

			<div>
			<label>Prenom:</label> <input type="text" name="prenom" size="16" required>
			</div>

		</div>

		<div>
			<div>
				<label>Telephone:</label> <input  type="tel" name="tel" size="16" required>
			</div>

			<div>
				<label>Mail:</label> <input  type="email" name="mail" size="16" required>
			</div>

		</div>

		<div>

			<div>
				<label>Login:</label> <input   type="text" name="login" size="16" required>
			</div>

			<div>
				<label>Mot de passe:</label> <input  type="password" name="pdp" size="16" required>
			</div>
		</div>

		<div class="clear"></div>

		<div class="categorie">
			<label>Categorie:</label> <input  type="radio" name="type" value="etudiant" size="4" checked="checked"> <label>Etudiant</label>
			<input type="radio" name="type" value="personnel" size="4"> <label>Personnel</label>
		</div>
		<div class="boutton">
			<input class="button" type="submit" value="Valider">
		</div>
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
			<h1>Ajouter un salaries</h1>
			<form id="FormPersonnel" method="post">
			<div>
				<div>
					<label>Telephone professionnel: </label> <input type="tel" name="telpro" required>
				</div>
				<div>
					<label>Fonction:</label> <select class="champSaisie" name="fonction">
					<?php
					$listeFonctions = $fonctionManager->getList();
					foreach ($listeFonctions as $fonction) {
						echo '<option value="'.$fonction->getFonNum().'">'.$fonction->getFonLib().'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<div class="boutton">
				<input class="button" type="submit" value="Valider">
			</div>
			</form>
			<?php
		}

		if($_POST['type']== "etudiant"){
			//la personne a ajouter est un etudiant
			?>
			<h1>Ajouter un etudiant</h1>
			<form id="FormEtudiant" method="post">
			<div>
				<div>
					<label>Annee:</label> <select class="champSaisie" name="annee">
						<?php
						$listeDivisions = $divisionManager->getList();
						foreach ($listeDivisions as $division) {
							echo '<option value="'.$division->getDivNum().'">'.$division->getDivNom().'</option>';
						}
						?>
					</select>
				</div>
				<div>
					<label>Departement:</label> <select class="champSaisie" name="dep">
						<?php
						$listeDepartements = $departementManager->getList();
						foreach ($listeDepartements as $departement) {
							echo '<option value="'.$departement->getDepNum().'">'.$departement->getDepNom().'</option>';
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
	}
	else{ // il s'agit du troisieme à la page.
		?>


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
