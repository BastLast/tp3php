<?php
class Avis{
	private $per_num;
	private $per_per_num;
	private $par_num;
	private $avi_comm;
	private $avi_note;
	private $avi_date;
	

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
				case 'per_per_num': $this->setPerPerNum($valeur);
				break;
				case 'par_num': $this->setParNum($valeur);
				break;
				case 'avi_comm': $this->setAviComm($valeur);
				break;
				case 'avi_note': $this->setAviNote($valeur);
				break;
				case 'avi_date': $this->setAviDate($valeur);
				break;
			}
		}
	}
	public function setPerNum($perNum){
		$this->per_num=$perNum;
	}
	public function setPerPerNum($perPerNum){
		$this->per_per_num=$perPerNum;
	}
	public function setParNum($parNum){
		$this->par_num=$parNum;
	}
	public function setAviComm($aviComm){
		$this->avi_comm=$aviComm;
	}
	public function setAviNote($aviNote){
		$this->avi_note=$aviNote;
	}
	public function setAviDate($aviDate){
		$this->avi_date=$aviDate;
	}
	

	public function getPerNum(){
		return $this->per_num;
	}
	public function getPerPerNom(){
		return $this->per_per_nom;
	}
	public function getParNum(){
		return $this->par_num;
	}
	public function getAviComm(){
		return $this->avi_comm;
	}
	public function getAviNote(){
		return $this->avi_note;
	}
	public function getAviDate(){
		return $this->avi_date;
	}
	

}