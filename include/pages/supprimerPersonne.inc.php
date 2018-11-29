<?php
$db=new Mypdo();
$personne = new personneManager($db);
$listePersonne = $personne->getList();

if(empty($_get['num'])){
?>
<h1>Personne enregistré</h2>
<p>il y a actuellement <?php echo $personne->countPersonne() ?> enregistré<p>

<table>
	<tr>
		<td>Num</td>
		<td>Nom</td>
		<td>Prenom</td>
		<td>Supprimer</td>
	</tr>
	<?php
	foreach($listePersonne as $personne){
	?>	
		<td><?php echo $personne ->getPerNum() ?></td>
		<td><?php echo $personne ->getPerNom()?></td>
		<td><?php echo $personne ->getPerPrenom()?></td>
		<td><a href="index.php?page=4&num= <?php echo $personne ->getPerNum() ?>"> <img src="image/erreur.png" alt="icon erreur"> </a></td>
	</tr>
	<?php } ?>
	</table>	
<?php	
}else{
	
	
}