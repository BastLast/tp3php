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


}else{ //deuxieme passage sur la page

	$_SESSION['idPersonneAModifier'] =$_POST['personneModifiee'];
	$personne = new Personne($personneManager->getPersonneById( $_SESSION['idPersonneAModifier'] ));
	var_dump($personneManager->getPersonneById( $_SESSION['idPersonneAModifier'] ));
	if(empty($_POST['nom'])){


	?>
		<form action="##" id="FormModifierPersonne" method="post">
			<?php var_dump($personne);

			?>
			Nom:
			<?php echo '<input type="text" name="nom" size="4" value= "'.$personne->getPerNom().'" required>'			?>
			Prenom: <input type="text" name="prenom" size="4" value= "<?php echo $personne->getPerPrenom(); ?>" required><br>
			Telephone: <input type="text" name="tel" size="4" value= "<?php echo $personne->getPerTel(); ?>" required >
			Mail: <input type="email" name="mail" size="4" value= "<?php echo $personne->getPerMail(); ?>" required> <br>
			Login: <input type="text" name="login" size="4" value= "<?php echo $personne->getPerLogin(); ?>" required>
			Mot de passe: <input type="password" name="pdp" size="4"><br>
			Categorie:

			<?php if($personneManager->estEtudiant($_SESSION['idPersonneAModifier'] )) { ?>
				 <input type="radio" name="type" value="etudiant" size="4" checked="checked"> Etudiant
				 <input type="radio" name="type" value="personnel" size="4" > Personnel
			<?php } else{ ?>
				<input type="radio" name="type" value="etudiant" size="4" > Etudiant
				<input type="radio" name="type" value="personnel" size="4" checked="checked"> Personnel
			<?php } ?>
			<input type="submit" value="Valider">
		</form>
	<?php
	}else{

			if(!$personneManager->estEtudiant($_SESSION['idPersonneAModifier'] )){

					?>
					<form id="FormPersonnel" method="post">
						Telephone professionnel: <input type="text" name="telpro">
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
			if($personneManager->estEtudiant($_SESSION['idPersonneAModifier'] )){

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

}
?>
