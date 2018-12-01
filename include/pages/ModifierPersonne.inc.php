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
	
	if(empty($_POST['nom'])){


	?>
		<form action="##" id="FormModifierPersonne" method="post">
			<?php var_dump($personne);

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
			<?php } ?>
			<input type="submit" value="Valider">
		</form>
	<?php
	}else{

			if(!$personneManager->estEtudiant($_SESSION['idPersonneAModifier'] )){

					?>
					<form id="FormPersonnel" method="post">
						<label>Telephone professionnel:</label> <input type="tel" name="telpro">
						<label>Fonction:</label> <select name="fonction">
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
			}
		}
	unset($_SESSION['idPersonneAModifier']);
}
?>
