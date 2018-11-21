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

	public function getList(){
		$listePersonne=array();
		$sql='SELECT per_num,per_nom,per_prenom FROM personne ORDER BY per_num';
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

}
