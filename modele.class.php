<?php
	class Modele {
		private $unPDO;
		public function __construct(){
			try {
				$url="mysql:host=localhost:3306;dbname=orange_efrei";
				$user="root";
				$mdp="";
				$this->unPDO= new PDO ($url, $user, $mdp);
			}
			catch(PDOException $exp){
				echo "Erreur de connexion: ".$exp->getMessage();
			}
		}
		public function insertClient($tab){
			$requete="insert into client values (null, :nom, :prenom, :adresse, :email);";
			$donnees=array(
				":nom"=>$tab['nom'],
				":prenom"=>$tab['prenom'],
				":adresse"=>$tab['adresse'],
				":email"=>$tab['email'],
			);
			$insert=$this->unPDO->prepare ($requete);
			$insert->execute($donnees);
		}
		public function selectAllClient(){
			$requete="select * from client;";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		public function selectLikeClient($filtre){
			print_r($filtre);
			$requete="select * from client where nom like :filtre or prenom like :filtre or adresse like :filtre or email like :filtre;";
			$donnees=array(":filtre"=>"%".$filtre."%");
			print_r($donnees);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetchAll();
		}
		public function deleteClient($idclient){
			$requete="delete from client where idclient= :idclient;";
			$donnees=array(":idclient"=>$idclient);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
		}
		public function selectWhereClient($idclient){
			$requete="select * from client where idclient= :idclient;";
			$donnees=array(":idclient"=>$idclient);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetch(); //Ne pas fetchAll sous peine de faire un tableau de tableau. Avec fetch() on obtient 1 tableau simple
		}
		public function UpdateClient($tab){
			$requete="update client set nom=:nom, prenom=:prenom, adresse=:adresse, email=:email where idclient= :idclient";
			$donnees=array(
				":nom"=>$tab['nom'],
				":prenom"=>$tab['prenom'],
				":adresse"=>$tab['adresse'],
				":email"=>$tab['email'],
			);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
		}
		public function insertTechnicien($tab){
			$requete="insert into technicien values (null, :nom, :prenom, :specialite, :dateembauche);";
			$donnees=array(
				":nom"=>$tab['nom'],
				":prenom"=>$tab['prenom'],
				":specialite"=>$tab['specialite'],
				":dateembauche"=>$tab['dateembauche'],
			);
			$insert=$this->unPDO->prepare ($requete);
			$insert->execute($donnees);
		}
		public function selectAllTechnicien(){
			$requete="select * from technicien;";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		public function insertProduit($tab){
			$requete="insert into produit values (null, :designation, :prixAchat, :dateAchat, :categorie, :idclient);";
			$donnees=array(
				":designation"=>$tab['desi'],
				":prixAchat"=>$tab['prixachat'],
				":dateAchat"=>$tab['dateachat'],
				":categorie"=>$tab['categorie'],
				":idclient"=>$tab['idclient'],
			);
			$insert=$this->unPDO->prepare ($requete);
			$insert->execute($donnees);
		}
		public function selectAllProduit(){
			$requete="select * from produit;";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		public function selectProduitClient ($idclient){
			$requete="select * from produit where idclient=:idclient;";
			$donnees=array(":idclient"=>$idclient);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetchAll();
		}
		public function count($table){
			$requete="select count(*) as nb from ".$table;
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetch();
		}
		public function verifConnexion($email, $mdp){
			$requete="select * from user where email=:email and mdp=:mdp ";
			$donnees=array(":email"=>$email, ":mdp"=>$mdp);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetch();
		}
	}
?>