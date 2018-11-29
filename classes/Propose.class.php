<?php
class Propose{
	private $par_num;
	private $per_num;
	private $pro_date;
	private $pro_time;
	private $pro_place;
	private $pro_sens;
	
	public function __construct($valeur = array()){
		if (!empty($valeur)){
			$this ->affecte($valeur);
		}

	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut =>$valeur){

			switch($attribut){
				case 'per_num': $this->setPerNum($valeur);
				break;
				case 'per_num': $this->setPerNum($valeur);
				break;
				case 'por_date': $this->setPorDate($valeur);
				break;
				case 'por_time': $this->setPorTime($valeur);
				break;
				case 'por_place': $this->setPorPlace($valeur);
				break;
				case 'por_sens': $this->setPorSens($valeur);
				break;
				
			}
		}
	}
	public function getParNum(){
		return $this->par_num;
	}

	public function getPerNum(){
		return $this->per_num;
	}

	public function getProDate(){
		return $this->pro_date;
	}

	public function getProTime(){
		return $this->pro_time;
	}

	public function getProPlace(){
		return $this->pro_place;
	}

	public function getProSens(){
		return $this->pro_sens;
	}
	
	public function setParNum($parNum){
		$this->par_num = $parNum;
	}

	public function setPerNum($perNum){
		$this->per_num = $perNum;
	}

	public function setProDate($proDate){
		$this->pro_date = $proDate;
	}

	public function setProTime($proTime){
		$this->pro_time = $proTime;
	}

	public function setProPlace($proPlace){
		$this->pro_place = $proPlace;
	}

	public function setProSens($proSens){
		$this->pro_sens = $proSens;
	}
	
}