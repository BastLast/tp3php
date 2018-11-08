<?php
class ParcoursManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'ajouter un parcours
	public function addParcours($parcour){

		$req = $this->db->prepare(
			'INSERT INTO parcours (par_km,vil_num1,vil_num2) VALUES (:par_km,:vil_num1,:vil_num2)'
		);

		$req ->bindValue(':par_km',$parcour->getParKm(),PDO::PARAM_STR);
		$req ->bindValue(':vil_num1',$parcour->getVille1(),PDO::PARAM_STR);
		$req ->bindValue(':vil_num2',$parcour->getVille2(),PDO::PARAM_STR);
		$req -> execute();
	}

	//fonction permetant de lister toutes les parcours
	public function getList(){

		$listeParcours = array();
		$sql = 	'SELECT par_num,v1.vil_nom,v2.vil_nom,par_km FROM parcours p
		join ville v1 on p.vil_num1 = v1.vil_num
		join ville v2 on p.vil_num2 = v2.vil_num
		ORDER BY par_num';
		$req = $this->db->query($sql);

		while ($parcour = $req->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[]= new Parcours($parcour);
		}
		return $listeParcours;
		$req -> closeCursor();
	}
*/
}
