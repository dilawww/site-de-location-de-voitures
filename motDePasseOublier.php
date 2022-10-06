<?php
session_start();
if (isset($_POST['submit'])) {
	@$permis=htmlentities($_POST['permis']);
	@$password =htmlentities($_POST['password']);
	@$passwordrepeat =htmlentities($_POST['passwordrepeat']);
	$verifier_mot_passe=true;
	$verifier_permis=true;
	$verifier_mot_passe_repeat=true;
	//se connecter a la base de données 
}
?>	
<!DOCTYPE html>
<html>
<head>
	<title>bienvenue</title>
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
	<form action="" method="post">

	<div class="formulaire1" style="margin-bottom: 40px;">
		<div class="parg">
		<p>Mot de passe oublié ? </p>
		</div>
		<div class="input">	
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
		<input type="password" name="password" placeholder="Nouveau mot de passe " required>
		<?php 
         if (isset($_POST['submit'])) {
         	//verifier le teille de le chaine password
         	if (strlen(@$password)<8) {
         	 echo "<label> votre mot de passe doit avoir au moins 8 caractéres</label>";
         	 $verifier_mot_passe=false;
         	}
         }

		?>
		<input type="password" name="passwordrepeat" placeholder="Répéter le mot de passe" required>
		<?php 
		if (isset($_POST['submit'])) {
			//verifier si l'utilisateur a saisie le meme password
       	if (@$password!=@$passwordrepeat) {
       		echo "<label> veuillez saisir le même mot de passe</label>";
       	    $verifier_mot_passe_repeat=false;
       	}
       
       }
		?>
		</div>
		

		<div class="bouton">
		<input  type="submit" id="submit" name="submit"value="Valider ">
<?php
if (isset($_POST['submit'])) {
	

if ($verifier_mot_passe==true && $verifier_permis==true && $verifier_mot_passe_repeat==true) {
		$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//requete preparer pour selection tous les champs de la table client 
	$req=$bdd->prepare('UPDATE client  SET password=? where permisClient=? ');
	$req ->execute(array(md5(@$password) ,@$permis));
 echo '<div class="alert alert-success">
  <strong>Bravo!</strong> Votre mot de passe a été modifieé. 
</div>';	
}
}
?>
		</div>
	
</div>	

</form>
<?php include('footer/footer.php');?>
</body>
</html>
