<?php
class VilleManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'ajouter une ville
	public function addville($ville){

		$req = $this->db->prepare(
			'INSERT INTO ville (vil_nom) VALUES (:nomVille)'
		);

		$req ->bindValue(':nomVille',$ville->getNomVille(),PDO::PARAM_STR);

		$req -> execute();
	}

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

	//fonction permetant de compter le nombre de villes
	public function countVilles(){
		$resu = array();
		$sql = 	'SELECT count(vil_num) as total FROM ville';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		$nbVille = $resu->total;

		return $nbVille;
		$req -> closeCursor();
	}

	public function getVilleById($id){
			$sql = 	"SELECT vil_nom  FROM ville where vil_num = $id";
			$req = $this->db->query($sql);
			$resu = $req->fetch(PDO::FETCH_OBJ);
			return $resu;
			$req -> closeCursor();
	}

}
