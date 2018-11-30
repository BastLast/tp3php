<h1>Modifier une personne</h1>
<?php
$listePersonne=$personneManager->getList();
if(empty($_POST['Modifier'])){ ?>


	<form method="post" action="#">
	
		<select id="personneModifier">
		
			<?php
				foreach($listePersonne as $personne){
					?>
					
					<option value="<?php $personne->getPerNum(); ?>"><?php echo $personne->getPerNom()." ".$personne->getPerPrenom(); ?></option>	
					
					<?php
				}
			?>
			
		</select>
		
	<input type="submit" value="Modifier" />
	</form>
	
 <?php }else{
	 $personne = $personneManager->getPerById( $_SESSION ['personneModifier'] );
	 
	echo "good";
	 
	 
	 
	 
 } ?>

 