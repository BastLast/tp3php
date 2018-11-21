<h1>Pour vous connecter</h1>
<?php
if (empty($_POST)){
  ?>
  <form action="#" id="FormLogin" method="post">
    Nom d'utilisateur:<input type="text" name="login" size="4">
    Mot de passe:<input type="password" name="password" size="4">

    <?php
    $nb1 = rand(1 , 9);
    $nb2 = rand(1 , 9);
    ?>
    <img src=<?php echo "image/nb/$nb1.jpg" ?> alt="captcha1">
    +
    <img src=<?php echo "image/nb/$nb2.jpg" ?> alt="captcha2">
    =
    <?php
    ?>
    <input type="text" name="captcha" size="4">
    <input type="submit" value="Valider" />
  </form>


  <?php
}else{
  ?>
  <?php
  $ville = new Ville($_POST);
  $db = new Mypdo();
  $villeManager = new VilleManager($db);

  $villeManager -> addVille($ville);

  ?>
  <img src="image/valid.png" alt="confirmation validee">
  La ville "<b><?php
  echo $_POST["vil_nom"];
  ?></b>" a bien été ajoutée
  <?php
}
?>
