<h1>Pour vous connecter</h1>
<?php
if (empty($_POST)){
  ?>
  <form action="#" id="FormLogin" method="post">
    Nom d'utilisateur:<input type="text" name="login" size="4">
    Mot de passe:<input type="password" name="password" size="4">

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
    <input type="text" name="captcha" size="4">
    <input type="submit" value="Valider" />
  </form>


  <?php
}else{
  ?>
  <?php
  if ($_POST['captcha']!=$_SESSION['verifCaptcha']) {
    echo "pas bon";
  }else {
    echo "ok";
  }
}
?>
