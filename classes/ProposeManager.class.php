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


	//fonction permettant de rechercher des trajets en fonction de criteres donnés en parametre
	public function search($villeD,$villeA,$date,$heuremin,$precision){

		$req = $this->db->prepare("SELECT p.par_num,per_num,pro_date,pro_time,pro_place,pro_sens FROM propose p
			JOIN parcours pp ON p.par_num = pp.par_num
			WHERE
			((pp.vil_num1 = 10 AND pp.vil_num2 = 11 AND p.pro_sens = 0)
			OR
			(pp.vil_num1 = 11 AND pp.vil_num2 = 10 AND p.pro_sens = 1))
			AND pro_date = '2018-10-31'
			AND pro_time > 0
			ORDER BY pro_date,pro_time");
			$req->execute();

			$listePropose=array();

			while($propose=$req->fetch(PDO::FETCH_OBJ)){
				$listePropose[]=new Propose($propose);
			}
			return $listePropose;
			$req->closeCursor();
		}
	}
