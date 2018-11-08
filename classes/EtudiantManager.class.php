<?php
class EtudiantManager{
	public function __construct($db){
		$this->db = $db;
	}
	
	//fonction permettant d'jouter une Etudiant 
	public function addEtudiant($Etudiant){
		$req=$this ->db->prepare
		('INSERT INTO etudiant (per_num,dep_num,div_num) 
		VALUES (:per_num,:dep_num,:div_num)');
		
		$req ->bindValue(':per_num',$Etudiant->getPerNum(),PDO::PARAM_STR);
		$req ->bindValue(':dep_num',$Etudiant->getDepNum(),PDO::PARAM_STR);
		$req ->bindValue(':div_num',$Etudiant->getDivNum(),PDO::PARAM_STR);
		
		$req->execute();
	}
}