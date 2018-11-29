<?php
require_once("include/autoLoad.inc.php");
require_once("include/config.inc.php");


$db = new Mypdo();
$personneManager=new PersonneManager($db);
$etudiantManager= new EtudiantManager($db);
$salarieManager=new SalarieManager($db);
$fonctionManager=new FonctionManager($db);
$departementManager=new DepartementManager($db);
$villeManager=new VilleManager($db);
$divisionManager=new DivisionManager($db);
$parcoursManager=new ParcoursManager($db);
$proposeManager=new ProposeManager($db);
$avisManager=new AvisManager($db);

require_once("include/header.inc.php");

?>
<div id="corps">
<?php
require_once("include/menu.inc.php");
require_once("include/texte.inc.php");
?>
</div>

<div id="spacer"></div>
<?php
require_once("include/footer.inc.php");
 ?>
