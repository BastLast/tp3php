<?php
class Etudiant{
	private $per_num;
	private $dep_num;
	private $div_num;

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
				case 'dep_num': $this->setDepNum($valeur);
				break;
				case 'div_num': $this->setDivNum($valeur);
				break;
			}
		}
	}
	public function setPerNum($perNum){
		$this->per_num=$perNum;
	}
	public function setdep_num($depNum){
		$this->dep_num=$depNum;
	}
	public function setDivNum($divnum){
		$this->div_num=$divnum;
	}


	public function getPerNum(){
		return $this->per_Num;
	}
	public function getDepNum(){
		return $this->dep_num;
	}
	public function getDivNum(){
		return $this->div_num;
	}

}
