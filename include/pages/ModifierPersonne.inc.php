<h1>Modifier une personne</h1>
<?php
$listePersonne=$personneManager->getList();
if(empty($_POST)){ //premier passage sur la page
	?>
	<form method="post" action="#" id="FormModifierPersonne" >
		Personne a modifier :
		<select name="personneModifiee" onChange='javascript:document.getElementById("FormModifierPersonne").submit()'>
			<option value="Defaut">Choisissez une personne</option>
			<?php
			foreach($listePersonne as $personne){
				echo '<option value="'.$personne->getPerNum().'">'.$personne->getPerNom()." ".$personne->getPerPrenom().'</option>';

			}
			?>
		</select>
	</form>

	<?php
}else{ //ce n'est pas le premier passage

	if(isset($_POST['personneModifiee'])){ //deuxieme passage sur la page
		$personne = $personneManager->getPersonneById( $_POST['personneModifiee'] );
		$_SESSION['idpersonneModifiee'] = $_POST['personneModifiee'];
		?>
		<form action="##" id="FormModifierPersonne" method="post">

			Nom:
			<?php echo '<input type="text" name="nom" size="4" value= "'.$personne->getPerNom().'" required>'			?>
			Prenom: <input type="text" name="prenom" size="4" value= "<?php echo $personne->getPerPrenom(); ?>" required><br>
			Telephone: <input type="text" name="tel" size="4" value= "<?php echo $personne->getPerTel(); ?>" required >
			Mail: <input type="email" name="mail" size="4" value= "<?php echo $personne->getPerMail(); ?>" required> <br>
			Login: <input type="text" name="login" size="4" value= "<?php echo $personne->getPerLogin(); ?>" required>
			Mot de passe: <input type="password" name="pdp" size="4" required><br>
			Categorie:

			<?php if($personneManager->estEtudiantByid($personne->getPerNum())) {
				//test si la personne est un étudiant ou un salarié ?>
				<input type="radio" name="type" value="etudiant" size="4" checked="checked"> Etudiant
				<input type="radio" name="type" value="personnel" size="4" > Personnel
			<?php } else{
				//la personne est un personnel ?>
				<input type="radio" name="type" value="etudiant" size="4" > Etudiant
				<input type="radio" name="type" value="personnel" size="4" checked="checked"> Personnel
			<?php } ?>
			<input type="submit" value="Valider">
		</form>
		<?php

	}else{ // ce n'est pas le premier ou le deuxieme passage

		if(isset($_POST['type'])){ 	//troisieme passage sur la page

			$_SESSION['newType'] = $_POST['type']; //sauvegarde du choix
			$password = sha1(sha1($_POST['pdp']).SALT);
			$_SESSION['personne'] = new Personne(
				array('per_num'=> $_SESSION['idpersonneModifiee'],
				'per_nom' => $_POST['nom'],
				'per_prenom' => $_POST['prenom'],
				'per_tel' => $_POST['tel'],
				'per_mail' => $_POST['mail'],
				'per_login' => $_POST['login'],
				'per_pwd' => $password)
			); //enregistrement des nouvelles infos saisies
			if($_POST['type'] == "personnel"){
				$_SESSION['salarie'] = $salarieManager->getSalarieById($_SESSION['personne']->getPerNum());
				//la personne à modifier est ou doit devenir un membre du personnel
				?>
				<form id="FormPersonnel" method="post">
					Telephone professionnel: <input type="text" name="telpro" value="<?php echo $_SESSION['salarie']->getTelProf()?>" >
					Fonction: <select name="fonction">
						<?php
						$listeFonctions = $fonctionManager->getList();
						foreach ($listeFonctions as $fonction) {
							if ($_SESSION['salarie']->getFonNum() == $fonction->getFonNum()) {
								echo '<option selected';
							}else{
								echo '<option';
							}
							echo '  value="'.$fonction->getFonNum().'">'.$fonction->getFonLib().'</option>';

						}
						?>
					</select>
					<input type="submit" value="Valider">
				</form>
				<?php
			}
			else{
				$_SESSION['etudiant'] = $etudiantManager->getEtudiantById($_SESSION['personne']->getPerNum());
				//la personne à modifier est ou doit devenir un étudiant
				?>
				<form id="FormEtudiant" method="post">
					Annee: <select name="annee">
						<?php
						$listeDivisions = $divisionManager->getList();
						foreach ($listeDivisions as $division) {
							if ($_SESSION['etudiant']->getDivNum() == $division->getDivNum()) {
								echo '<option selected';
							}else{
								echo '<option';
							}
							echo ' value="'.$division->getDivNum().'">'.$division->getDivNom().'</option>';
						}
						?>
					</select>
					Departement: <select name="dep">
						<?php
						$listeDepartements = $departementManager->getList();
						foreach ($listeDepartements as $departement) {
							if ($_SESSION['etudiant']->getDepNum() == $departement->getDepNum()) {
								echo '<option selected';
							}else{
								echo '<option';
							}
							echo ' value="'.$departement->getDepNum().'">'.$departement->getDepNom().'</option>';
						}
						?>
					</select>
					<input type="submit" value="Valider">
				</form>
				<?php
			}
		}

		else{ //quatrieme passage sur la page

				//enregistrement des infos générales
				$personneManager -> updatePersonne($_SESSION['personne']);

				//test si la personne conserve le meme type
				//$salarieManager -> addSalarie($salarie);
				//$etudiantManager -> addEtudiant($etudiant);


				?>
				<img src="image\valid.png" alt="confirmation validee">
				La personne a bien été modifiée

				<?php
				unset($_SESSION['newType']);
				unset($_SESSION['idPersonneAModifier']);
				unset($_SESSION['type']);
				unset($_SESSION['salarie']);
				unset($_SESSION['etudiant']);
				unset($_SESSION['personne']); // on supprime les variables de session dont on a plus besoin



			}
		}
	}

	?>
