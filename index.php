<?php
	if(isset($_SESSION['email'])){
		
		session_destroy();
		unset($_SESSION['email']);
	}else {
		
	}
	require_once("controleur/controleur.class.php");
	$unControleur= new Controleur(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Orange</title>
	<meta charset="utf-8">
</head>

<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<center>
		<?php
		if(!isset($_SESSION['email'])){
			require_once ("vue/vue_connexion.php");
		}
		if (isset($_POST['seConnecter'])){
			$email = $_POST['email'];
			$mdp = $_POST['mdp'];		
				$unUser = $unControleur->verifConnexion($email, $mdp);
				var_dump($unUser);
			if ($unUser !=null){
				$_SESSION['nom'] = $unUser['nom'];
				$_SESSION['prenom'] = $unUser['prenom'];
				$_SESSION['email'] = $unUser['email'];
				$_SESSION['role'] = $unUser['role'];
				//header("Location: index.php?page=1");

			} else {
				echo "<br>Votre identifiant ou mot de passe est incorrect";
			}
		}

		if  (isset($_SESSION['email'])){
			echo '
					<h1>Site d intervention d Orange</h1>s
					<a href="index.php?page=1">
						<img src="image/home.png" height="100" width="100" alt="Page d accueil">
					</a>
					<a href="index.php?page=2">
						<img src="image/client.png" height="100" width="100" alt="Gestion des clients">
					</a>
					<a href="index.php?page=3">
						<img src="image/produit.png" height="100" width="100" alt="Gestion des produits">
					</a>
					<a href="index.php?page=4">
						<img src="image/technicien.png" height="100" width="100" alt="Gestion des techniciens">
					</a>
					<a href="index.php?page=5">
						<img src="image/intervention.png" height="100" width="100" alt="Gestion des interventions">
					</a>
					<a href="index.php?page=6">
						<img src="image/deconnexion.png" height="100" width="100" alt="Déconnexion">
					</a>
					<h2>Bienvenue chez Orange</h2>
				';
				
				echo "<p style='text-align:center;'> Bonjour ". $_SESSION['prenom'] . ". Vous êtes ". $_SESSION['role']. "</p>";
		}
		if(isset($_GET['page'])){
			$page= $_GET['page'];
		} else {
			$page = 1; //Page par défaut= index.php
		}
		switch ($page){
			case 1 : require_once ("index.php"); break;
			case 2 : require_once ("gestion_client.php"); break;
			case 3 : require_once ("gestion_produit.php"); break;
			case 4 : require_once ("gestion_technicien.php"); break;
			case 5 : require_once ("gestion_intervention.php"); break;
			case 6 : session_destroy();
			unset($_SESSION['email']);
			header("Location: index.php?page=1");
			break;
		}
	?>
</body>
</html>