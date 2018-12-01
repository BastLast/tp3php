<?php
class AvisManager{

	public function __construct($db){
		$this->db = $db;
	}

//fonction permettant de supprimer les avis écrits par une personne à partir de son id
public function supAvisOfPersonneByid($id){

		if(isset($id)){

		$req=$this->db->prepare(
			'DELETE FROM avis WHERE per_num = :id || per_per_num= :id'
		);

		$req->bindValue(':id',$id,PDO::PARAM_STR);
		return $req->execute();
		$req->closeCursor;
		}
	}

}
