<?php
class DivisionManager{
	public function __construct($db){
		$this->db = $db;
	}

	//fonction permetant de lister toutes les divisions
	public function getList(){

		$listeDivisions = array();
		$sql = 	'SELECT div_num,div_nom FROM division ORDER BY div_nom';
		$req = $this->db->query($sql);

		while ($division = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDivisions[]= new Division($division);
		}

		return $listeDivisions;
		$req -> closeCursor();
	}
	public function getDivisionById($id){
		if(!is_null($id))
		
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
