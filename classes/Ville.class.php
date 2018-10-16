<?php
class Ville{
	
	private $vil_nom;
	public function __construct($newVille){
		$this->vil_nom=$newVille;
	}
	public function setNomVille($newVille){
		$this->vil_nom=$newVille;
		
	}
	public function getNomVille(){
		return $this->vil_nom;
	}
}