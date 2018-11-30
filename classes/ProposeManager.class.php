<?php
class ProposeManager{
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function supPropose($id){
		
		if(isset($id)){
		
		$req=$this->db->prepare(
			'DELETE FROM propose WHERE per_num = :id'	
		);
		
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		return $req->execute();
		$req->closeCursor;
		}
	}

}