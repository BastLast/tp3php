<h1>Modifier une personne</h1>
<?php
$listePersonne=$personneManager->getList();
if(empty($_POST)){
	?>
	<form method="post" action="#">
		<select name="personneModifiee">
			<?php
			foreach($listePersonne as $personne){
				echo '<option value="'.$personne->getPerNum().'">'.$personne->getPerNom()." ".$personne->getPerPrenom().'</option>';

			}
			?>

		</select>

		<input type="submit" value="Modifier" />
	</form>


	<?php
}else{
	echo $_POST['personneModifiee'];
	$personne = $personneManager->getPersonneById( $_POST['personneModifiee'] );

	echo "good";




}
?>
