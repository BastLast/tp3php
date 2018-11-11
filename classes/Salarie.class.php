<?php
class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;

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
				case 'sal_telprof': $this->setSalTelprof($valeur);
				break;
				case 'fon_num': $this->setFonNum($valeur);
				break;
			}
		}
	}
	public function setPerNum($perNum){
		$this->per_num=$perNum;
	}
	public function setSalTelprof($saltelprof){
		$this->sal_telprof=$saltelprof;
	}
	public function setFonNum($fonnum){
		$this->fon_num=$fonnum;
	}


	public function getPerNum(){
		return $this->per_Num;
	}
	public function getDepNum(){
		return $this->sal_telprof;
	}
	public function getFonNum(){
		return $this->fon_num;
	}

}
