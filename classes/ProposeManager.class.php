<?php
class ProposeManager{

	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'jouter une proposition de trajet
	public function addPropose($Propose){
		$req=$this->db->prepare
		('INSERT INTO propose (par_num,per_num,pro_date,pro_time,pro_place,pro_sens)
		VALUES (:parnum,:pernum,:prodate,:protime,:places,:sens)');

		$req ->bindValue(':parnum',$Propose->getParNum(),PDO::PARAM_STR);
		$req ->bindValue(':pernum',$Propose->getPerNum(),PDO::PARAM_STR);
		$req ->bindValue(':prodate',$Propose->getProDate(),PDO::PARAM_STR);
		$req ->bindValue(':protime',$Propose->getProTime(),PDO::PARAM_STR);
		$req ->bindValue(':places',$Propose->getProPlace(),PDO::PARAM_STR);
		$req ->bindValue(':sens',$Propose->getProSens(),PDO::PARAM_STR);


		$req->execute();
	}

	//fonction permettant de supprimer les trajets proposés par une personne à partir de l'id de la personne
	public function supProposeOfPersonneByid($id){

		if(isset($id)){

			$req=$this->db->prepare(
				'DELETE FROM propose WHERE per_num = :id'
			);

			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			$req->closeCursor();
		}
	}

}
