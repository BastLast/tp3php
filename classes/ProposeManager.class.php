<?php
class ProposeManager{
	
	
	
	public function supPropose($id){
		
		if(!is_null($id)){
		
		$req=$this->db->prepare(
			'DELETE FROM propose WHERE per_num = :id || per_per_num= :id'	
		);
		
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		return $req->execute();
		$req->closeCursor;
		}
	}

}