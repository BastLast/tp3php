
<?php
$listePersonne = $personneManager->getList();

if(empty($_GET['num'])){
	?>
	<h1>Personne enregistré</h2>
		<p>il y a actuellement <?php echo $personneManager->countPersonne(); ?> enregistré<p>

			<table>
				<tr class="enTete">
					<th>Num</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Supprimer</th>
				</tr>
				<?php
				foreach($listePersonne as $personne){
					?>
					<td><?php echo $personne ->getPerNum(); ?></td>
					<td><?php echo $personne ->getPerNom();?></td>
					<td><?php echo $personne ->getPerPrenom();?></td>
					<td><a href="index.php?page=4&num= <?php echo $personne ->getPerNum(); ?>"> <img src="image/erreur.png" alt="icon erreur"> </a></td>
				</tr>
			<?php } ?>
		</table>
		<?php
	}
	else{
		$id=$_GET["num"];
		$personne = $personneManager->getPersonneById($id);
		if($personneManager->estEtudiantByid($id)){
			$etudiant = $etudiantManager->getEtudiantById($id);
		}else{
			$salarie = $salarieManager->getSalarieById($id);
		}
		$personneManager->supPersonneByid($id);
		echo $personne->getPerNom()." ".$personne->getPerPrenom()." a bien été supprimé."; ?>
		<input class="button" type="button" value="Continuer" onclick="location.href='index.php?page=4'" />
		<input class="button" type="button" value="Menu" onclick="location.href='index.php?page=1'" />

		<?php
	} ?>
