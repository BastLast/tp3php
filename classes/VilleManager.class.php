<?php
class VilleManager{
	public function __construct($db){
		$this->db = $db;
	}

	public function addville($ville){

		$req = $this->db->prepare(
			'INSERT INTO ville (vil_nom) VALUES (:nomVille)'
		);

		$req ->bindValue(':nomVille',$ville->getNomVille(),PDO::PARAM_STR);

		$req -> execute();
	}


}
