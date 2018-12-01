<?php
class ProposeManager{

	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'jouter une proposition de trajet
	public function addPropose($Propose){
		$req=$this ->db->prepare
		('INSERT INTO propose (per_num,pro_date,pro_time,pro_place,pro_sens)
		VALUES (:num,:prodate,:protime,:places,:login)');

		$req ->bindValue(':num',$Propose->getPerNum(),PDO::PARAM_STR);
		$req ->bindValue(':prodate',$Propose->getPerPrenom(),PDO::PARAM_STR);
		$req ->bindValue(':protime',$Propose->getPerTel(),PDO::PARAM_STR);
		$req ->bindValue(':places',$Propose->getPerMail(),PDO::PARAM_STR);
		$req ->bindValue(':sens',$Propose->getPerLogin(),PDO::PARAM_STR);


		$req->execute();
	}
	public function supProposeOfPersonByid($id){

		if(isset($id)){
			
			$req=$this->db->prepare(
				'DELETE FROM propose WHERE per_num = :id'
			);

			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			$req->closeCursor;
		}
	}

}
