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
/*
	//fonction permetant de lister toutes les villes
	public function getList(){

		$listeVilles = array();
		$sql = 	'SELECT vil_nom , vil_num FROM ville ORDER BY vil_nom';
		$req = $this->db->query($sql);

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[]= new Ville($ville);
		}

		return $listeVilles;
		$req -> closeCursor();
	}
*/
}
