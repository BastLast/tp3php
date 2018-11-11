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

	//fonction permetant de compter le nombre de fonctions
	public function countFonctions(){
		$resu = array();
		$sql = 	'SELECT count(fon_num) as total FROM fonction';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		$nbFonction = $resu->total;

		return $nbFonction;
		$req -> closeCursor();
	}

	public function getFonctionById($id){
			$sql = 	"SELECT fon_libelle  FROM fonction where fon_num = $id";
			$req = $this->db->query($sql);
			$resu = $req->fetch(PDO::FETCH_OBJ);
			return $resu;
			$req -> closeCursor();
	}

}
