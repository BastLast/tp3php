
<?php
if (empty($_POST)){
  if(isset($_SESSION['co'])){
    ?>
    Vous êtes déjà connecté, vous allez être redirigé dans 2 secondes !
    <meta http-equiv="refresh" content="2; URL=index.php?page=0">
    <?php
  }else {
    ?>
    <h1>Pour vous connecter</h1>
    <form action="#" id="FormLogin" method="post">
      Nom d'utilisateur:<input type="text" name="login" size="4" required>
      Mot de passe:<input type="password" name="password" size="4" required>

      <?php
      $nb2 = rand(1 , 9);
      $nb1 = rand(1 , 9);
      $_SESSION['verifCaptcha'] = $nb1 + $nb2;
      ?>
      <img src=<?php echo "image/nb/$nb1.jpg" ?> alt="captcha1">
      +
      <img src=<?php echo "image/nb/$nb2.jpg" ?> alt="captcha2">
      =
      <?php
      ?>
      <input type="text" name="captcha" size="4" required>
      <input type="submit" value="Valider" />
    </form>


    <?php
  }
}else{

  if ($_POST['captcha']!=$_SESSION['verifCaptcha']) { // le captcha est invalide
    ?>
    <img src="image/erreur.png" alt="connexion echouee">
    Captcha incorrect !
    <a href="index.php?page=11">
      <button type="button" name="Reessayer">Reessayer</button>
    </a>
    <?php
  }else { // le captcha est OK
    $personne = new Personne($personneManager->getPersonneByLogin($_POST['login']));
    if($personne -> checkPassword($_POST['password'])){
      // le mot de passe est OK
      $_SESSION['co'] = $personne->getPerLogin();
      ?>
      <h1>Connexion Réussie</h1>
      Vous allez etre redirigé dans 2 secondes !
      <meta http-equiv="refresh" content="2; URL=index.php?page=0">
      <?php
    }else{
      // le mot de passe n'est pas OK
      ?>
      <img src="image/erreur.png" alt="connexion echouee">
      Login ou Mot de passe incorrect !
      <?php
    }


  }
}
?>
