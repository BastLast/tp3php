<?php
class Etudiant{
	private $dep_num;
	private $dep_nom;
	private $vil_num;

	public function __construct($valeur = array()){
		if (!empty($valeur)){
			$this ->affecte($valeur);
		}

	}

	public function affecte($donnees){
		foreach($donnees as $attribut =>$valeur){

			switch($attribut){
				case 'dep_num': $this->setDepNum($valeur);
				break;
				case 'dep_num': $this->setDepNom($valeur);
				break;
				case 'vil_num': $this->setVilNum($valeur);
				break;
			}
		}
	}

	public function setDepNum($depNum){
		$this->dep_num=$depNum;
	}
	public function setDepNom($depNum){
		$this->dep_num=$depNom;
	}
	public function setDepNum($vilNum){
		$this->dep_num=$depnum;
	}

	public function getDepNum(){
		return $this->dep_num;
	}
	public function getDepNom(){
		return $this->dep_Nom;
	}
	public function getvilNum(){
		return $this->vil_num;
	}

}
