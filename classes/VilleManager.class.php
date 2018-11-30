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
		$req = $this->db->prepare('SELECT vil_nom , vil_num FROM ville ORDER BY vil_nom');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[]= new Ville($ville);
		}
		return $listeVilles;
		$req -> closeCursor();
	}

	//fonction permetant de lister toutes les villes référencées dans la table parcours
	public function getListReferenced(){

		$listeVilles = array();
		$req = $this->db->prepare('SELECT distinct vil_num, vil_nom FROM ville v WHERE vil_num in (
			select vil_num1 from parcours p1 union select vil_num2 from parcours p2
		)
		ORDER BY vil_nom');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[]= new Ville($ville);
		}
		return $listeVilles;
		$req -> closeCursor();
	}

	//fonction permetant de compter le nombre de villes
	public function countVilles(){
		$resu = array();
		$req = $this->db->prepare('SELECT count(vil_num) as total FROM ville');
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_OBJ);
		$nbVille = $resu->total;
		return $nbVille;
		$req -> closeCursor();
	}

//fonction permettant de recuperer une ville à partir d'une id
	public function getVilleById($id){

		$req = $this->db->prepare(
			"SELECT *  FROM ville where vil_num = :id"
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		return new Ville($res);
		$req -> closeCursor();

	}

}
