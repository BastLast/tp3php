<h1>Liste des parcours</h1>
<?php
$db = new Mypdo();
$villeManager = new VilleManager($db);
$parcoursManager = new ParcoursManager($db);?>
Actuellement
<?php echo $parcoursManager->countParcours() ?>
 parcours sont enregistrées

<table>
  <tr>
    <th>Numero</th>
    <th>Nom ville</th>
    <th>Nom ville</th>
    <th>Nombre de Km</th>
  </tr>
  <?php
  $listeParcours = $parcoursManager->getList();
  foreach ($listeParcours as $parcour) {
    ?>
    <tr>
      <?php
      $ville1 = new Ville($villeManager->getVilleById($parcour->getVille1()));
      $ville2 = new Ville($villeManager->getVilleById($parcour->getVille2()));
      ?>
      <td><?php echo $parcour->getParNum() ?></td>
      <td><?php echo $ville1->getNomVille(); ?></td>
      <td><?php echo $ville2->getNomVille(); ?></td>
      <td><?php echo $parcour->getParKm() ?></td>
    </tr>
	<?php } ?>
</table>