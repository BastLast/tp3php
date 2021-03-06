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

		$req ->bindValue(':num',$Salarie->getPerNum(),PDO::PARAM_STR);
		$req ->bindValue(':saltelprof',$Salarie->getTelProf(),PDO::PARAM_STR);
		$req ->bindValue(':fonnum',$Salarie->getFonNum(),PDO::PARAM_STR);

		$req->execute();
	}

	//fonction permettant de recuperer un salarie à partir d'une id
	public function getSalarieById($id){
		if(isset($id)){

			$req=$this->db->prepare(
				'SELECT per_num,sal_telprof,fon_num FROM salarie where per_num = :id'
			);
			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			$res=$req->fetch(PDO::FETCH_OBJ);
			return new Salarie($res);
			$req->closeCursor();
		}
	}

	//fonction permettant de supprimer un salarie
	public function supSalarieByid($id){
		$req=$this->db->prepare(
			'DELETE FROM salarie WHERE per_num = :id'

		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		return $req->execute();
		$req->closeCursor;
	}

	//fonction permettant de mettre à jour un salarié
	public function updateSalarie($salarie){
		$req=$this->db->prepare(
			'UPDATE salarie SET sal_telprof= :sal_telprof,fon_num= :fon_num WHERE per_num= :per_num'
		);
		$req->bindValue(":per_num",$salarie->getPerNum(),PDO::PARAM_INT);
		$req->bindValue(":sal_telprof",$salarie->getTelProf(),PDO::PARAM_INT);
		$req->bindValue(":fon_num",$salarie->getFonNum(),PDO::PARAM_INT);
		return $req->execute();
		$req->closeCursor();
	}
}
