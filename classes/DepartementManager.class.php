<?php
class DepartementManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permetant de lister tous les departements
	public function getList(){

		$listeDepartements = array();
		$sql = 	'SELECT dep_num,dep_nom,vil_num FROM departement ORDER BY dep_nom';
		$req = $this->db->query($sql);

		while ($departement = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDepartements[]= new Departement($departement);
		}

		return $listeDepartements;
		$req -> closeCursor();
	}

//cette fonction renvoi un departement en fonction d'une id
	public function getDepartementById($id){
		$req=$this->db->prepare(
			'SELECT * FROM departement where dep_num = :id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		return new Departement($res);
		$req->closeCursor();
	}

}
