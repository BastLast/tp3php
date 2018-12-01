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

	if(empty($_POST['nom'])){ //deuxieme passage sur la page
		$_SESSION['personne'] = $personneManager->getPersonneById( $_POST['personneModifiee'] );
		?>
		<form action="##" id="FormModifierPersonne" method="post">

<<<<<<< HEAD
			Nom:
			<?php echo '<input type="text" name="nom" size="4" value= "'.$_SESSION['personne']->getPerNom().'" required>'			?>
			Prenom: <input type="text" name="prenom" size="4" value= "<?php echo $_SESSION['personne']->getPerPrenom(); ?>" required><br>
			Telephone: <input type="text" name="tel" size="4" value= "<?php echo $_SESSION['personne']->getPerTel(); ?>" required >
			Mail: <input type="email" name="mail" size="4" value= "<?php echo $_SESSION['personne']->getPerMail(); ?>" required> <br>
			Login: <input type="text" name="login" size="4" value= "<?php echo $_SESSION['personne']->getPerLogin(); ?>" required>
			Mot de passe: <input type="password" name="pdp" size="4" required><br>
			Categorie:

			<?php if($personneManager->estEtudiantByid($_SESSION['personne']->getPerNum())) {
				//test si la personne est un étudiant ou un salarié ?>
				<input type="radio" name="type" value="etudiant" size="4" checked="checked"> Etudiant
				<input type="radio" name="type" value="personnel" size="4" > Personnel
			<?php } else{
				//la personne est un personnel ?>
				<input type="radio" name="type" value="etudiant" size="4" > Etudiant
				<input type="radio" name="type" value="personnel" size="4" checked="checked"> Personnel
=======
			?>
			<label>Nom:</label>
			<?php echo '<input type="text" name="nom" size="4" value= "'.$personne->getPerNom().'" required>'			?>
			<label>Prenom:</label> <input type="text" name="prenom" size="4" value= "<?php echo $personne->getPerPrenom(); ?>" required><br>
			<label>Telephone:</label> <input type="tel" name="tel" size="4" value= "<?php echo $personne->getPerTel(); ?>" required >
			<label>Mail:</label> <input type="email" name="mail" size="4" value= "<?php echo $personne->getPerMail(); ?>" required> <br>
			<label>Login:</label> <input type="text" name="login" size="4" value= "<?php echo $personne->getPerLogin(); ?>" required>
			<label>Mot de passe:</label> <input type="password" name="pdp" size="4"><br>
			<label>Categorie:</label>

			<?php if($personneManager->estEtudiant($_SESSION['idPersonneAModifier'] )) { ?>
				 <input type="radio" name="type" value="etudiant" size="4" checked="checked"><label>Etudiant</label>
				 <input type="radio" name="type" value="personnel" size="4" > <label>Personnel</label>
			<?php } else{ ?>
				<input type="radio" name="type" value="etudiant" size="4" > <label>Etudiant</label>
				<input type="radio" name="type" value="personnel" size="4" checked="checked"> <label>Personnel</label>
>>>>>>> da41e8c16d1442647919c1c46170a3e4c0f24edf
			<?php } ?>
			<input type="submit" value="Valider">
		</form>
		<?php

	}else{ // ce n'est pas le premier ou le deuxieme passage
		if(isset($_POST['type'])){
			//c'est le troisieme passage
			$_SESSION['newType'] = $_POST['type']; //sauvegarde du choix

<<<<<<< HEAD
			if($_POST['type'] == "personnel"){
				$_SESSION['salarie'] = $salarieManager->getSalarieById($_SESSION['personne']->getPerNum());
				//la personne à modifier est ou doit devenir un membre du personnel
				?>
				<form id="FormPersonnel" method="post">
					Telephone professionnel: <input type="text" name="telpro" value="<?php echo $_SESSION['salarie']->getTelProf()  ?>" >
					Fonction: <select name="fonction">
						<?php
						$listeFonctions = $fonctionManager->getList();
						foreach ($listeFonctions as $fonction) {
							if ($_SESSION['salarie']->getFonNum() == $fonction->getFonNum()) {
								echo '<option selected';
							}else{
								echo '<option';
=======
					?>
					<form id="FormPersonnel" method="post">
						<label>Telephone professionnel:</label> <input type="tel" name="telpro">
						<label>Fonction:</label> <select name="fonction">
							<?php
							$listeFonctions = $fonctionManager->getList();
							foreach ($listeFonctions as $fonction) {
								echo '<option value="'.$fonction->getFonNum().'">'.$fonction->getFonLib().'</option>';
>>>>>>> da41e8c16d1442647919c1c46170a3e4c0f24edf
							}
							echo '  value="'.$fonction->getFonNum().'">'.$fonction->getFonLib().'</option>';

<<<<<<< HEAD
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
=======
					?>
					<form id="FormEtudiant" method="post">
						<label>Annee:</label> <select name="annee">
							<?php
							$listeDivisions = $divisionManager->getList();
							foreach ($listeDivisions as $division) {
								echo '<option value="'.$division->getDivNum().'">'.$division->getDivNom().'</option>';
							}
							?>
						</select>
						<label>Departement:</label> <select name="dep">
							<?php
							$listeDepartements = $departementManager->getList();
							foreach ($listeDepartements as $departement) {
								echo '<option value="'.$departement->getDepNum().'">'.$departement->getDepNom().'</option>';
							}
							?>
						</select>
						<input class="button" type="submit" value="Valider">
					</form>
					<?php
>>>>>>> da41e8c16d1442647919c1c46170a3e4c0f24edf
			}
		}
		else{
			//c'est le 4 eme passage
		}
	}
	unset($_SESSION['idPersonneAModifier']);
}
?>
