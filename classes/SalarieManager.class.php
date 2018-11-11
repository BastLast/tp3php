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

}
