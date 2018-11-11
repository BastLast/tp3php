<?php
class Division{
	private $div_num;
	private $div_nom;

	public function __construct($valeur = array()){
		if (!empty($valeur)){
			$this ->affecte($valeur);
		}

	}

	public function affecte($donnees){
		foreach($donnees as $attribut =>$valeur){

			switch($attribut){
				case 'div_num': $this->setDivNum($valeur);
				break;
				case 'div_nom': $this->setDivNom($valeur);
				break;
			}
		}
	}
	public function setDivNum($divNum){
		$this->div_num=$divNum;
	}
	public function setDivNom($divNom){
		$this->div_nom=$divNom;
	}


	public function getDivNum(){
		return $this->div_num;
	}

		public function getDivNom(){
			return $this->div_nom;
		}

}
