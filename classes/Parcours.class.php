<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;
	
	public function __construct($valeur=array()){
		if (!empty($valeur){
			$this->affecte($valeur);
		}
	}
	public fonction affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			swith($attribut){
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
	public function setParNum($valeur){
		$this->par_num=$numPark;
		
	}
	public function setParKm($valeur){
		$this->par_km=$numPark;
		
	}
	public function setVille1($valeur){
		$this->vil_num1=$Ville;
		
	}
	public function setVille2($valeur){
		$this->vil_num2=$Ville;
		
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