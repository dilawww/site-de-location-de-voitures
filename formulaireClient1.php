<?php 
session_start();
if (isset($_POST['submit'])) {
	@$permis=htmlentities($_POST['permis']);
	@$password =md5(htmlentities($_POST['password']));
	//se connecter a la base de données 
		$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//requete preparer pour selection tous les champs de la table client 
	$req=$bdd->prepare('SELECT * FROM client WHERE permisClient=? AND password=? ');
	$req ->execute(array( @$permis ,@$password));
	$users=$req->fetch();
	
		if ($users['permisClient'] && $users['password']) {
			$_SESSION['permis']=$users['permisClient'];
			$_SESSION['numero']=$users['numeroTlph'];
			$_SESSION['adresse']=$users['adresse'];
			$_SESSION['nom']=$users['nom'];
			$_SESSION['prenom']=$users['prenom'];
			$_SESSION['password']=$users['password'];
		header('Location: accueil.php');
			}
		
	}

?>	
<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style/style1.css">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	  <link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
	<meta charset="utf-8">
</head>
<body>
		<?php 
  include('header/header.php');

?>
	<form action="" method="post">

	<div class="formulaire1" style="margin-bottom: 40px; margin-left: 450px">
		<div class="parg">
		<p>Connexion </p>
		</div>
		<div class="input">	
		<input type="number" name="permis" placeholder="  N° du permis" required>
		<input type="password" name="password" placeholder="  Mot de passe" required>
		</div>
		<div class="lien">
		<a href="formulaireClient2.php" style="color: black;"> Créer un compte  </a>
		<a href="motDePasseOublier.php" style="color: black;"> Mot de passe oublié? </a>
		</div>
<?php 
$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//requete preparer pour selection tous les champs de la table client 
if (isset($_POST['submit'])) {
	$req=$bdd->prepare('SELECT * FROM client ');
	$req ->execute();
	$users=$req->fetch();
	
		if ($users['permisClient']!=@$permis || $users['password']!=@$password){
			 echo '<div class="alert alert-danger">
  <strong>Attention!</strong>N°permis ou mot de passe incorrect . 
</div>';
		}
	}
		?>
		<div class="bouton">
		<input  type="submit" id="submit" name="submit"value="Connexion ">
		</div>
	
</div>	
<?php 
if(isset($_GET['m'])){
?>
<div class="flash-data" data-flashdata="<?=$_GET['m'];?>"></div>
<?php } ?>
<script  src="sweetAlert/jquery-3.5.1.min.js"></script>
<script  src="sweetAlert/sweetalert2.all.min.js"></script>
<script>
const flashdata=$('.flash-data').data('flashdata');
 if (flashdata) {
 	Swal.fire({
 		icon: 'success',
 		type :'success',
 		title : 'Succès  '
 	})
 }
 </script>
</form>
<?php include('footer/footer.php');?>
</body>
</html>
