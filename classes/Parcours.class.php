<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;

	public function __construct($valeur=array()){
		if (!empty($valeur)){
			$this->affecte($valeur);
		}
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch($attribut){
				case 'par_num':$this ->setParNum($valeur);
				break;
				case 'par_km':$this->setParKm($valeur);
				break;
				case 'vil_num1':$this->setVille1($valeur);
				break;
				case 'vil_num2':$this->setVille2($valeur);
				break;
			}
		}
	}


	public function setParNum($numPar){
		$this->par_num=$numPar;

	}
	public function setParKm($nbkm){
		$this->par_km=$nbkm;

	}
	public function setVille1($ville){
		$this->vil_num1=$ville;

	}
	public function setVille2($ville){
		$this->vil_num2=$ville;

	}
	public function getParNum(){
		return $this->par_num;
	}
	public function getParKm(){
		return $this->par_num;
	}
	public function getVille1(){
		return $this->vil_num1;
	}
	public function getVille2(){
		return $this->vil_num2;
	}

}
