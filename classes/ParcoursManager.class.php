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
// à passer en requete préparée
		$listeParcours = array();
		$sql = 	'SELECT par_num,vil_num1,vil_num2,par_km FROM parcours
		ORDER BY par_num';

		$req = $this->db->query($sql);

		while ($parcour = $req->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[]= new Parcours($parcour);
		}
		return $listeParcours;
		$req -> closeCursor();
	}


	//fonction permetant de compter le nombre de parcours
	public function countParcours(){
		$resu = array();
		$sql = 	'SELECT count(par_num) as total FROM parcours';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		$nbParcours = $resu->total;

		return $nbParcours;
		$req -> closeCursor();
	}
}
