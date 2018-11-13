<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);?>
Actuellement 
<?php echo $personneManager->countPersonne()?>
 personne sont enregistrées

<table>
	<tr>
		<th>Numero</th>
		<th>Nom</th>
		<th>Prenom</th>
	<tr>
	<?php
	$listePersonne =$personneManager->getList();
	foreach ($listePersonne as $personne){
		?>
		<tr>
			<td><a href="#"><?php echo $personne ->getPerNum()?></a></td>
			<td><?php echo $personne ->getPerNom()?></td>
			<td><?php echo $personne ->getPerPrenom()?></td>
		</tr>
	</table>
	<?php if($_POST){
		
	}
<?php } ?>