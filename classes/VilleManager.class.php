<?php
class VilleManager{
	$db=mysqli_connect("localhost","bd","bede");
	mysqli_select_db($db,"covoit");
	
	public function inserer(){
	$reqIns="insert".$vil_nom." from ville ";
	$exeIns=mysqli_query($db,$reqIns);
	
	}
	$reqSel="select vil_nom from ville";
	
}