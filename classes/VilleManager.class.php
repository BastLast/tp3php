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
	public function getListReferencedinParcours(){

		$listeVilles = array();
		$req = $this->db->prepare('SELECT DISTINCT vil_num, vil_nom FROM ville v WHERE vil_num IN (
			SELECT vil_num1 FROM parcours UNION SELECT vil_num2 FROM parcours
		)
		ORDER BY vil_nom');
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[]= new Ville($ville);
		}
		return $listeVilles;
		$req -> closeCursor();
	}

	//fonction permetant de lister toutes les villes référencées dans la table propose en tant que ville de départ
	public function getListReferencedinPropose(){

		$listeVilles = array();
		$req = $this->db->prepare('SELECT distinct vil_num, vil_nom FROM ville v WHERE vil_num IN
			( select vil_num1 FROM parcours p1
				JOIN propose pr ON pr.par_num = p1.par_num
				WHERE pro_sens = 0
				UNION
				SELECT vil_num2 FROM parcours p2
				JOIN propose pr2 ON pr2.par_num = p2.par_num
				WHERE pro_sens = 1 )
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
			"SELECT vil_num, vil_nom  FROM ville where vil_num = :id"
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		return new Ville($res);
		$req -> closeCursor();
	}

	//fonction permetant de lister toutes les villes compatibles avec la ville dont l'id est passée en parametre
	public function getListCompatible($id){

		$listeVilles = array();
		$req = $this->db->prepare(
			"SELECT distinct vil_num, vil_nom FROM ville
			JOIN parcours ON vil_num1 = vil_num WHERE vil_num2 = :id
			UNION SELECT DISTINCT vil_num, vil_nom FROM ville
			JOIN parcours ON vil_num2 = vil_num WHERE vil_num1 = :id
			ORDER BY vil_nom");

			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
				$listeVilles[]= new Ville($ville);
			}
			return $listeVilles;
			$req -> closeCursor();
		}

	}
