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
		$listePersonne=array();
		$sql='SELECT per_num,per_nom,per_prenom FROM personne ORDER BY per_num';
		$req=$this->db->query($sql);
		
		while($personne=$req->fetch(PDO::FETCH_OBJ)){
			$listePersonne[]=new Personne($personne);
		}
		return $listePersonne;
		$req->closeCursor();
	}
	//fonction permettant de compter le nombre de personne
	public function countPersonne(){
		$res=array();
		$sql='SELECT count(per_num) as total FROM personne';
		$req=$this->db->query($sql);
		$res = $req->fetch(PDO::FETCH_OBJ);
		$nbPersonne=$res->total;
		return $nbPersonne;
		$req-> closeCursor();
	}

	public function getPersonneByLogin($login){
		$req=$this ->db->prepare
		("SELECT per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd  FROM personne where per_login = :login");
		$req ->bindValue(':login',$login,PDO::PARAM_STR);
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_OBJ);
		return $resu;
		$req -> closeCursor();
	}
	
	public function estEtudiant($id){
		
		if(!is_null($id)){

			$req = $this->db->prepare(
			'SELECT per_num FROM etudiant WHERE per_num = :id'
			);
			$req->bindValue(':id',$id,PDO::PARAM_STR);
		 	$req->execute();

			return $req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();
		} else {
			return FALSE;
		}
	}
	public function getPersonneById($id){
		if(!is_null($id))
		
		$req=$this->db->prepare(
			'SELECT * FROM personne where per_num= :id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
	
		$res=$req->fetch(PDO::FETCH_OBJ);
		return new Personne($res);
		$req->closeCursor();
	}

}
