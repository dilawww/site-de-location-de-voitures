<?php
session_start();
@$password= md5(htmlentities($_POST['password']));
@$nom=htmlentities($_POST['nom']);
@$prenom=htmlentities($_POST['prenom']);
@$permis=htmlentities($_POST['permis']);
@$numero=htmlentities($_POST['numero']);
@$adresse=htmlentities($_POST['adresse']);
$verifier_mot_passe=true;//pour verifier si tous les condition sont faites
$verifier_numero=true;
$verifier_permis=true;
?>
<?php
if (isset($_POST['submit'])) {
	//modifier un client de la base de donnees si seulement tout les champs sont valide 
	if ($verifier_permis==true && $verifier_numero==true && $verifier_mot_passe==true) {
      $bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     $pdostat = $bdd->prepare('UPDATE   client set permisClient=?,nom=?,prenom=?,numeroTlph=?,adresse=?,password=? WHERE permisClient=? LIMIT 1');
$executeisok=$pdostat->execute(array(@$permis,@$nom,@$prenom,@$numero,@$adresse,@$password,@$_SESSION['permis']));  
header('Location: formulaireClient1.php?m=1');
       	}
       }
?>
<!DOCTYPE html>
<html>
<head>
	<title>bienvenue</title>
	
	<link rel="stylesheet" href="style/bootstrap.min.css">
	 <link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
    <link rel="stylesheet" href="fonts/icons.css">
    
  <link rel="stylesheet prefetch" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

  <link rel="stylesheet" href="fonts/style.css">
	<meta charset="utf-8">
</head>
<body>
<?php include('header/header1.php');?>
	<form action="" method="post"  >

	<div class="formulaire2" style="margin-top: 100px; margin-left: 500px;height: 570px;margin-bottom: 50px;">
		<p class="parg" style="font-size: 35px;"> Modifier vos information  </p>
		<div class="input">	
		<input type="text" style="width: 458px;" name="nom" value="<?php echo ucwords($_SESSION['nom']);?>" required>
		
		<input type="text" style="width: 458px;" name="prenom" value="<?php echo ucwords($_SESSION['prenom']); ?>" required>
		
		<input type="text" style="width: 458px;" name="adresse"   value="<?php echo ucwords($_SESSION['adresse']); ?>" required>
	    <input type="number" style="width: 458px;" name="permis"  value="<?php echo ($_SESSION['permis']); ?>" required>
	    <?php 
        if (isset($_POST['submit'])) {
        	//verifier le teille de le chaine permis 
        	if (strlen(@$permis)!=7) {
        		echo "<label> Le n° de votre permis n'est pas valide </label> ";
                $verifier_permis=false;
        	}
        }
	    ?>
	    <input type="number"  style="width: 458px;" name="numero" value="0<?php echo ($_SESSION['numero']); ?>" required>
	    <?php 
	    if (isset($_POST['submit'])) {
	    	//verifier le teille de le chaine numero 
	     if (strlen(@$numero)!=10) {
   	echo "<label> le n° de votre téléphone n'est pas valide </label>";
   	$verifier_numero=false;       }
   }
	    ?>
		<input type="password" style="width: 458px;" name="password" value="<?php echo ($_SESSION['password']); ?>" required>
		<?php 
         if (isset($_POST['submit'])) {
         	//verifier le teille de le chaine password
         	if (strlen(@$password)<8) {
         	 echo "<label> votre mot de passe doit avoir au moins 8 caractéres</label>";
         	 $verifier_mot_passe=false;
         	}
         }

		?>
		</div>
		<div class="bouton">
		<input type="submit" style="background-color: #9ACD31;color: black;margin-left: 180px;margin-top: 20px" value="Modifier " name="submit">
		
		</div>
	
</div>	
</form>
<?php include('footer/footer.php'); ?>
</body>
</html>
