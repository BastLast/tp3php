
<?php
if (empty($_POST)){
  if(isset($_SESSION['co'])){
    ?>
    Vous êtes déjà connecté, vous allez être redirigé dans 2 secondes !
    <meta http-equiv="refresh" content="2; URL=index.php?page=0">
    <?php
  }else {
    ?>
	<div id="contain">
    <h1>Pour vous connecter</h1>
    <form class="connection" action="#" id="FormLogin" method="post">
	<div>
		<div>
			<label> Nom d'utilisateur:</label>
		</div>
		<div>
			<input type="text" name="login" size="4" required>
		</div>
    </div>
	<div>
		<div>
			<label>Mot de passe:</label>
		</div>
		<div>
			<input type="password" name="password" size="4" required>
		</div>
	</div>
	<div id="captcha">
		  <?php
		  $nb2 = rand(1 , 9);
		  $nb1 = rand(1 , 9);
		  $_SESSION['verifCaptcha'] = $nb1 + $nb2;
		  ?>
		  <img src=<?php echo "image/nb/$nb1.jpg" ?> alt="captcha1">
		  +
		  <img src=<?php echo "image/nb/$nb2.jpg" ?> alt="captcha2">
		  =
	  </div>
      <?php
      ?>
	  <div>
      <input id= "champ" type="text" name="captcha" size="4" required>
	  </div>
	  <div >
      <input class="button" type="submit" value="Valider" />
	  </div>
	</form>
	</div>

    <?php
  }
}else{

  if ($_POST['captcha']!=$_SESSION['verifCaptcha']) { // le captcha est invalide
    ?>
    <img src="image/erreur.png" alt="connexion echouee">
    Captcha incorrect !
    <a href="index.php?page=11">
      <button class="button" type="button" name="Reessayer">Reessayer</button>
    </a>
    <?php
  }else { // le captcha est OK
    $personne = new Personne($personneManager->getPersonneByLogin($_POST['login']));
    if($personne -> checkPassword($_POST['password'])){
      // le mot de passe est OK
      $_SESSION['co'] = $personne->getPerLogin();
      unset($_SESSION['verifCaptcha']);
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
