<?php
class Propose{
	private $per_num;
	private $par_num;
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
				case 'par_num': $this->setParNum($valeur);
				break;
				case 'pro_date': $this->setProDate($valeur);
				break;
				case 'pro_time': $this->setProTime($valeur);
				break;
				case 'pro_place': $this->setProPlace($valeur);
				break;
				case 'pro_sens': $this->setProSens($valeur);
				break;

			}
		}
	}

	public function getPerNum(){
		return $this->per_num;
	}

	public function getParNum(){
		return $this->par_num;
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
