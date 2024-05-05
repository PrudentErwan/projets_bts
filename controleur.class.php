<?php
	require_once("modele/modele.class.php");
	class Controleur{
		private $unModele;
		public function __construct(){
			$this->unModele= new Modele();
		}
		public function insertClient ($tab){
			$this->unModele->insertClient ($tab);
		}
		public function selectAllClient (){
			return $this->unModele->selectAllClient();
		}
		public function selectLikeClient ($filtre){
			return $this->unModele->selectLikeClient($filtre);
		}
		public function deleteClient($idclient){
			$this->unModele->deleteClient ($idclient);
		}
		public function selectWhereClient($idclient){
			return $this->unModele->selectWhereClient ($idclient);
		}
		public function UpdateClient($tab){
			$this->unModele->UpdateClient ($tab);
		}
		public function insertTechnicien ($tab){
			$this->unModele->insertTechnicien ($tab);
		}
		public function selectAllTechnicien (){
			return $this->unModele->selectAllTechnicien();
		}
		public function insertProduit ($tab){
			$this->unModele->insertProduit ($tab);
		}
		public function selectAllProduit (){
			return $this->unModele->selectAllProduit();
		}
		public function selectProduitClient ($idclient){
			return $this->unModele->selectProduitClient($idclient);
		}
		public function count ($table){
			return $this->unModele->count($table);
		}
		public function verifConnexion ($email, $mdp){
			return $this->unModele->verifConnexion($email, $mdp);
		}
	}
?>