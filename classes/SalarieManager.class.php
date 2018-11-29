<?php
class SalarieManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'jouter une ville
	public function addSalarie($Salarie){
		$req=$this ->db->prepare
		('INSERT INTO salarie (per_num,sal_telprof,fon_num)
		VALUES (:num,:saltelprof,:fonnum)');

		$req ->bindValue(':num',$Personne->getSalNum(),PDO::PARAM_STR);
		$req ->bindValue(':saltelprof',$Personne->getSalTelProf(),PDO::PARAM_STR);
		$req ->bindValue(':fonnum',$Personne->getSalFonNum(),PDO::PARAM_STR);

		$req->execute();
	}
	public function getSalarieById($id){
		if(!is_null($id)){
		
		$req=$this->db->prepare(
			'SELECT * FROM salarie where per_num= :id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		return new Salarie($res);
		$req->closeCursor();
		}
	}
	public function supSalarie($id){
		$req=$this->db->prepare(
			'DELETE FROM salarie WHERE per_num = :id'
			
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		return $req->execute();
		$req->closeCursor;
	}
}
