<?php

class PersonneManager{

	public function __construct($db){
		$this->db = $db;
	}

	//fonction permettant d'jouter une Personne
	public function addPersonne($Personne){
		$req=$this ->db->prepare
		('INSERT INTO personne (per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd)
		VALUES (:nom,:prenom,:tel,:mail,:login,:pwd)');

		$req ->bindValue(':nom',$Personne->getPerNom(),PDO::PARAM_STR);
		$req ->bindValue(':prenom',$Personne->getPerPrenom(),PDO::PARAM_STR);
		$req ->bindValue(':tel',$Personne->getPerTel(),PDO::PARAM_STR);
		$req ->bindValue(':mail',$Personne->getPerMail(),PDO::PARAM_STR);
		$req ->bindValue(':login',$Personne->getPerLogin(),PDO::PARAM_STR);
		$req ->bindValue(':pwd',$Personne->getPerPwd(),PDO::PARAM_STR);

		$req->execute();
	}

	//fonction permettant de lister toutes les personnes
	public function getList(){

		$req = $this->db->prepare('SELECT per_num,per_nom,per_prenom FROM personne ORDER BY per_num');
		$req->execute();

		$listePersonne=array();

		while($personne=$req->fetch(PDO::FETCH_OBJ)){
			$listePersonne[]=new Personne($personne);
		}
		return $listePersonne;
		$req->closeCursor();
	}

	//fonction permettant de compter le nombre de personne
	public function countPersonne(){
		$res=array();
		$req = $this->db->prepare("SELECT count(per_num) as total FROM personne");
		$req->execute();
		$res = $req->fetch(PDO::FETCH_OBJ);
		$nbPersonne=$res->total;
		return $nbPersonne;
		$req-> closeCursor();
	}

	//fonction permettant de recuperer une personne à partir d'une id
	public function getPersonneByLogin($login){
		$req=$this ->db->prepare
		("SELECT per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd  FROM personne where per_login = :login");
		$req ->bindValue(':login',$login,PDO::PARAM_STR);
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_OBJ);
		return $resu;
		$req -> closeCursor();
	}

	//fonction permettant de verifier si une personne est un étudiant
	public function estEtudiantByid($id){

		if(isset($id)){

			$req = $this->db->prepare(
				'SELECT per_num FROM etudiant WHERE per_num = :id'
			);
			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			return $req->fetch(PDO::FETCH_OBJ);
			$req->closeCursor();
		}
	}

	//fonction permettant de recuperer une personne à partir d'une id
	public function getPersonneById($id){

		if(isset($id)){

			$req=$this->db->prepare(
				'SELECT per_num,per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne where per_num= :id'
			);
			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();

			$res=$req->fetch(PDO::FETCH_OBJ);
			return new Personne($res);
			$req->closeCursor();
		}
	}

//fonction permettant de supprimer une personne à partir de son id
	public function supPersonneByid($id){
		$db = new Mypdo();
		$etudiantManager=new EtudiantManager($db);
		$salarieManager=new SalarieManager($db);
		$avisManager = new AvisManager($db);
		$proposeManager = new ProposeManager($db);
		if(isset($id)){
			$avisManager->supAvisOfPersonneByid($id);
			$proposeManager->supProposeOfPersonneByid($id);
			if($this->estEtudiantByid($id)){
				$etudiantManager->supEtudiantByid($id);
			} else {
				$salarieManager->supSalarieByid($id);
			}

			$req=$this->db->prepare(
				'DELETE FROM personne WHERE per_num = :id'
			);

			$req->bindValue(':id',$id,PDO::PARAM_STR);
			$req->execute();
			$req->closeCursor();
		}
	}

	//fonction permettant de mettre à jour une personne
	public function updatePersonne($personne){
		if(isset($personne)){
			$req=$this->db->prepare(
				'UPDATE personne SET per_nom= :per_nom, per_prenom= :per_prenom, per_tel= :per_tel, per_mail= :per_mail,
				per_login= :per_login, per_pwd= :per_pwd
				WHERE per_num= :per_num'
			);
			$req->bindValue(':per_num',$personne->getPerNum(),PDO::PARAM_STR);
			$req->bindValue(':per_nom',$personne->getPerNom(),PDO::PARAM_STR);
			$req->bindValue(':per_prenom',$personne->getPerPrenom(),PDO::PARAM_STR);
			$req->bindValue(':per_tel',$personne->getPerTel(),PDO::PARAM_STR);
			$req->bindValue(':per_mail',$personne->getPerMail(),PDO::PARAM_STR);
			$req->bindValue(':per_login',$personne->getPerLogin(),PDO::PARAM_STR);
			$req->bindValue(':per_pwd',$personne->getPerPwd(),PDO::PARAM_STR);
			return $req->execute();
			$req->closeCursor();
		}
	}

}
