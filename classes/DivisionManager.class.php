<?php
class DivisionManager{
	public function __construct($db){
		$this->db = $db;
	}
		
	//fonction permetant de lister toutes les divisions
	public function getList(){

		$listeDivisions = array();
		$req = $this->db->prepare('SELECT div_num,div_nom FROM division ORDER BY div_nom');
		$req->execute();

		while ($division = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDivisions[]= new Division($division);
		}

		return $listeDivisions;
		$req -> closeCursor();
	}

	//cette fonction permet de récuperer une division en fonction d'une id
	public function getDivisionById($id){
		if(isset($id))

		$req=$this->db->prepare(
			'SELECT * FROM division where num_num=$id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		return $res;
		$req->closeCursor();
	}

}
