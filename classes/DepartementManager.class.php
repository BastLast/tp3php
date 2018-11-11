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

}
