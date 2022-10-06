<?php
session_start();
@$password= htmlentities($_POST['password']);
@$nom=htmlentities($_POST['nom']);
@$prenom=htmlentities($_POST['prenom']);
@$email=htmlentities($_POST['email']);
@$permis=htmlentities($_POST['permis']);
@$numero=htmlentities($_POST['numero']);
@$adresse=htmlentities($_POST['adresse']);
@$passwordrepaet=htmlentities($_POST['passwordrepaet']);
$verifier_mot_passe=true;//pour verifier si tous les condition sont faites
$verifier_numero=true;
$verifier_permis=true;
$verifier_mot_passe_repeat=true;
?>


<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="style/style1.css">
	<link rel="stylesheet" href="style/bootstrap.min.css">
		<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
	<meta charset="utf-8">
</head>
<body>
	<?php 
  include('header/header.php');

?>
	<form action="" method="post"  >

	<div class="formulaire2" style="height: 800px; margin-top: 100px; margin-left: 450px;margin-bottom:40px">
		<p class="parg"> Créer un nouveau compte  </p>
		<div class="input">	
		<input type="text" name="nom" placeholder=" Votre Nom" required>
		<input type="text" name="prenom" placeholder=" Votre Prénom" required>
		<input type="email" name="email" placeholder=" Votre Email" required>
		<input type="text" name="adresse" placeholder=" Votre Adresse" required>
	    <input type="number" name="permis" placeholder="  N° du permis" required>
	    <?php 
        if (isset($_POST['submit'])) {
        	//verifier le teille de le chaine permis 
        	if (strlen(@$permis)!=7) {
        		echo "<label> Le n° de votre permis n'est pas valide </label> ";
                $verifier_permis=false;
        	}
        }
	    ?>
	    <input type="number" name="numero" placeholder=" N° du Téléphone" required>
	    <?php 
	    if (isset($_POST['submit'])) {
	    	//verifier le teille de le chaine numero 
	     if (strlen(@$numero)!=10) {
   	echo "<label> le n° de votre téléphone n'est pas valide </label>";
   	$verifier_numero=false;       }
   }
	    ?>
		<input type="password" name="password" placeholder="  Mot de passe" required>
		<?php 
         if (isset($_POST['submit'])) {
         	//verifier le teille de le chaine password
         	if (strlen(@$password)<8) {
         	 echo "<label> votre mot de passe doit avoir au moins 8 caractéres</label>";
         	 $verifier_mot_passe=false;
         	}
         }

		?>
		<input type="password" name="passwordrepaet" placeholder=" Confirmer le mot de passe" required>
		<?php 
		if (isset($_POST['submit'])) {
			//verifier si l'utilisateur a saisie le meme password
       	if (@$password!=@$passwordrepaet) {
       		echo "<label> veuillez saisir le même mot de passe</label>";
       	    $verifier_mot_passe_repeat=false;
       	}
       
       }
		?>
		</div>
		
		<div style="margin-top: 37px;">
			<input style="margin-right: 354px;width: 159px;font-size: 24px;" class="btn-success" type="submit" name="submit" value="S'inscrire">
			<input style="width: 159px;font-size: 24px;margin-top: -48px;margin-left: 467px;padding-left: 24px;" type="reset"  class="btn-success"  value="Annuler">
		</div>
	<?php
if (isset($_POST['submit'])) {
	//on ajoute un client a la base de donnees si seulement tout les champs sont valide 
	if ($verifier_permis==true && $verifier_numero==true && $verifier_mot_passe==true && $verifier_mot_passe_repeat==true) {
       $bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
       $req=$bdd->prepare('INSERT INTO client(permisClient,nom,prenom,email,adresse,numeroTlph,password) VALUES (?,?,?,?,?,?,?)');
       $req->execute(array(@$permis,@$nom,@$prenom,@$email,@$adresse,@$numero,md5(@$password)));
       echo '<div class="alert alert-success">
  <strong>Bravo!</strong> Votre compte a été crée. 
</div>';
       	}
       }
?>
	
</div>	
</form>
<?php 
include('footer/footer.php');
?>
</body>
</html>
