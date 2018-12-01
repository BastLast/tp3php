<?php
class EtudiantManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'ajouter une Etudiant
	public function addEtudiant($Etudiant){
		$req=$this ->db->prepare
		('INSERT INTO etudiant (per_num,dep_num,div_num)
		VALUES (:per_num,:dep_num,:div_num)');

		$req ->bindValue(':per_num',$Etudiant->getPerNum(),PDO::PARAM_INT);
		$req ->bindValue(':dep_num',$Etudiant->getDepNum(),PDO::PARAM_INT);
		$req ->bindValue(':div_num',$Etudiant->getDivNum(),PDO::PARAM_INT);

		$req->execute();
	}

	//cette fonction permet de récuperer un etudiant en fonction d'une id
	public function getEtudiantById($id){
		if(isset($id))

		$req=$this->db->prepare(
			'SELECT * FROM etudiant WHERE per_num= :id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_INT);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		return new Etudiant($res);
		$req->closeCursor();
	}

//cette fonction permet de supprimer un étudiant
	public function supEtudiantByid($id){
		$req=$this->db->prepare(
			'DELETE FROM etudiant WHERE per_num = :id'

		);
		$req->bindValue(':id',$id,PDO::PARAM_INT);
		return $req->execute();
		$req->closeCursor;
	}

//fonction permettant de mettre à jour un étudiant
	public function updateEtudiant($etudiant){
		$req=$this->db->prepare(
			'UPDATE etudiant SET per_num=:per_num, dep_num=:dep_num, div_num=:div_num'
		);
		$req->bindValue(":per_num",$etudiant->getPerNum(),PDO::PARAM_INT);
		$req->bindValue(":dep_num",$etudiant->getDepNum(),PDO::PARAM_INT);
		$req->bindValue(":div_num",$etudiant->getDivNum(),PDO::PARAM_INT);
		return $req->execute();
		$req->closeCursor();
	}

}
