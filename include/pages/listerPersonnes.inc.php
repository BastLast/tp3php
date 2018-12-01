<h1> Liste de personne enregistrees</h1>
<?php
if(empty($_GET["num"])){
?>
Actuellement 
<?php echo $personneManager->countPersonne();
?>
 personne sont enregistrées

	<table>
		<tr class="enTete">
			<th>Numero</th>
			<th>Nom</th>
			<th>Prenom</th>
		</tr>
		
	<?php
	$listePersonne =$personneManager->getList();
	foreach ($listePersonne as $personne){
		?>
		
		<tr>
			<td><a href="index.php?page=2&num=<?php echo $personne->getPerNum(); ?>"><?php echo $personne->getPerNum(); ?></a></td>
			<td><?php echo $personne ->getPerNom()?></td>
			<td><?php echo $personne ->getPerPrenom()?></td>
		</tr>
	<?php } ?> 
	</table> 
	<?php
	 
	
	}else{
		
		$personne = $personneManager->getPersonneById($_GET["num"]);
		$etudiant = $etudiantManager->getEtudiantById($_GET["num"]);
		$salarie = $salarieManager->getSalarieById($_GET["num"]);
		$departement = $departementManager->getDepartementById($etudiant->getDepNum());
		$ville = $villeManager->getVilleById($departement->getVilNum());
		$fonction=$fonctionManager->getFonctionById($salarie->getFonNum());
		
		if($personneManager->estEtudiant($_GET["num"])){
		?>
			<h1> <?php echo "Détail sur l'étudiant ".$personne ->getPerNom(); ?> </h1>
		<?php }else{ ?>
			<h1><?php echo "Détail sur le salarié ".$personne ->getPerNom(); ?> </h1>
		<?php
		}
		?>
		
		<table>
		
			<tr>
			
			<th>Nom</th>
			<th>Prenom</th>
			<th>Tel</th>
			
		<?php if($personneManager->estEtudiant($_GET["num"])){ ?>
		
			<th>Département</th>
			<th>Ville</th>
			
		<?php }else{ ?>
			
			<th>Tel pro</th>
			<th>Fonction</th>
			
		<?php } 
		
		?>
		</tr>
			
			<tr>
			
				<td><?php echo $personne ->getPerNom();?></td>
				<td><?php echo $personne ->getPerPrenom();?></td>
				<td><?php echo $personne ->getPerTel();?></td>
				
			<?php if($personneManager->estEtudiant($_GET["num"])){ ?>
				
				<td><?php echo $departement->getDepNom();?></td>
				<td><?php echo $ville->getNomVille();?></td>
			
			<?php }else{ ?>
				
				<td><?php echo $salarie ->getTelProf();?></td>
				<td><?php echo $fonction->getFonLib();?></td>
				
			<?php } ?>
			</tr>
			
			</table>
	
	<?php
	}
	?>