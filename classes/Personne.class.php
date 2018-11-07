<?php
class Personne{
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;
	
	public function __construct($valeur = array()){
		if (!empty($valeur)){
			$this ->affecte($valeur);
		}
		
	}
	
	public function affecte($donees){
		foreach($donnees as $attribut =>$valeur){
			
			switch($attribut){
				case 'per_num': $this->setPerNum($valeur);
				break;
				case 'per_nom': $this->setPerNom($valeur);
				break;
				case 'per_prenom': $this->setPerPrenom($valeur);
				break;
				case 'per_tel': $this->setPerTel($valeur);
				break;
				case 'per_mail': $this->setPerMail($valeur);
				break;
				case 'per_login': $this->setPerLogin($valeur);
				break;
				case 'per_pwd': $this ->setPerPwd($valeur);
				break;
			}
		}
	}
	public function setPerNum($perNum){
		$this->per_num=$perNum;
	}
	public function setPerNom($perNom){
		$this->per_nom=$perNom;
	}
	public function setPerPrenom($perPrenom){
		$this->per_prenom=$perPrenom;
	}
	public function setPerTel($perTel){
		$this->per_tel=$perTel;
	}
	public function setPerMail($perMail){
		$this->per_mail=$perMail;
	}
	public function setPerLogin($perLogin){
		$this->per_Login=$perLogin;
	}
	public function setPerPwd($perPwd){
		$this->per_Pwd=$perPwd;
	}
	
	public function getPerNum(){
		return $this->per_Num;
	}
	public function getPerNom(){
		return $this->per_Nom;
	}
	public function getPerPrenom(){
		return $this->per_prenom;
	}
	public function getPerTel(){
		return $this->per_tel;
	}
	public function getPerMail(){
		return $this->per_mail;
	}
	public function getPerLogin(){
		return $this->per_Login;
	}
	public function getPerPdw(){
		return $this->per_pwd;
	}
}