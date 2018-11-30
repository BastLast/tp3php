<?php
class FonctionManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permetant de lister toutes les fonctions
	public function getList(){
		$listeFonctions = array();
		$req = $this->db->prepare('SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_libelle');
		$req->execute();

		while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
			$listeFonctions[]= new Fonction($fonction);
		}

		return $listeFonctions;
		$req -> closeCursor();
	}

	//cette fonction permet de recuperer une fonction à partir d'une id
	public function getFonctionById($id){
		if(isset($id)){

			$req=$this->db->prepare(
				'SELECT * FROM fonction where fon_num = :id'
			);

			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			$res=$req->fetch(PDO::FETCH_OBJ);
			return new Fonction($res);
			$req->closeCursor();
		}
	}
}
