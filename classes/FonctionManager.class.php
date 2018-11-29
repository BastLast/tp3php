<?php
class FonctionManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permetant de lister toutes les fonctions
	public function getList(){
// à passer en requete préparée
		$listeFonctions = array();
		$sql = 	'SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_libelle';
		$req = $this->db->query($sql);

		while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
			$listeFonctions[]= new Fonction($fonction);
		}

		return $listeFonctions;
		$req -> closeCursor();
	}

	//cette fonction permet de recuperer une fonction à partir d'une id
	public function getFonctionById($id){
		if(!is_null($id)){

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
