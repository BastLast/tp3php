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

		$req ->bindValue(':per_num',$Etudiant->getPerNum(),PDO::PARAM_STR);
		$req ->bindValue(':dep_num',$Etudiant->getDepNum(),PDO::PARAM_STR);
		$req ->bindValue(':div_num',$Etudiant->getDivNum(),PDO::PARAM_STR);

		$req->execute();
	}
	
	public function getEtudiantById($id){
		if(!is_null($id))
		
		$req=$this->db->prepare(
			'SELECT * FROM etudiant WHERE per_num= :id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		return new Etudiant($res);
		$req->closeCursor();
	}
	
	public function supEtudiant($id){
		$requ=$this->db->prepare(
			'SELECT * FROM etudiant WHERE per_num = :id'
			
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$req->closeCursor;
	}
	
}
