<?php
session_start();
if (isset($_POST['submit'])) {
	@$login=htmlentities($_POST['login']);
	@$password = htmlentities($_POST['password']);
	//se connecter a la base de données
	$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//requete preparer pour selection tous les champs de la table client
	$req=$bdd->prepare('SELECT * FROM administrateur');
	$req ->execute();
	$users=$req->fetch();

		if ($users['login']==@$login && $users['password']==@$password) {
			$_SESSION['login']=$users['login'];
			$_SESSION['password']=$users['password'];
		header('Location: admin/accueil.php');
			}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrateur</title>


	<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
	 <link rel="stylesheet" href="style/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="style/style1.css">

	<meta charset="utf-8">
</head>
<body>
		<?php
  include('header/header.php');

?>
	<form action="" method="post">

	<div class="formulaire1" style="margin-bottom: 40px;">
		<div class="parg">
		<p>Connexion Admin </p>
		</div>
		<div class="input">
		<input type="text" name="login" placeholder="Nom utilisiteur" required>
		<input type="password" name="password" placeholder="  Mot de passe" required>
		</div>
		<?php
		$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	//requete preparer pour selection tous les champs de la table client
if (isset($_POST['submit'])) {
	$req=$bdd->prepare('SELECT * FROM administrateur ');
	$req ->execute();
	$users=$req->fetch();

		if ($users['login']!=@$login || $users['password']!=@$password){
			 echo '<div class="alert alert-danger">
  <strong>Attention!</strong>Nom utilisateur ou mot de passe incorrect .
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
