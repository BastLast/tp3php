<h1>Liste des villes</h1>
Actuellement
<?php echo $villeManager->countVilles() ?>
 villes sont enregistrées

<table>
  <tr>
    <th>Numero</th>
    <th>Nom</th>
  </tr>
  <?php
  $listeVilles = $villeManager->getList();
  foreach ($listeVilles as $ville) {
    ?>
    <tr>
      <td><?php echo $ville->getNumVille() ?></td>
      <td><?php echo $ville->getNomVille() ?></td>
    </tr>
<?php } ?>
</table>
