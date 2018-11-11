<?php
class FonctionManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permetant de lister toutes les fonctions
	public function getList(){

		$listeFonctions = array();
		$sql = 	'SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_libelle';
		$req = $this->db->query($sql);

		while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
			$listeFonctions[]= new Fonction($fonction);
		}

		return $listeFonctions;
		$req -> closeCursor();
	}

}
