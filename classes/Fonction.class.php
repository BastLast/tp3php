<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeur = array()){
		if (!empty($valeur)){
			$this ->affecte($valeur);
		}

	}

	public function affecte($donees){
		foreach($donnees as $attribut =>$valeur){

			switch($attribut){
				case 'fon_num': $this->setFonNum($valeur);
				break;
				case 'fon_libelle': $this->setFonLib($valeur);
				break;
			}
		}
	}
	public function setFonNum($fonNum){
		$this->fon_num=$fonNum;
	}
	public function setFonLib($fonLib){
		$this->fon_libelle=$fonnum;
	}


	public function getFonNum(){
		return $this->fon_num;
	}

		public function getFonLib(){
			return $this->fon_libelle;
		}

}
