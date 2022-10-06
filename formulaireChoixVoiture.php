<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Choisir une voiture</title>
	
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
</head>
<body>
  <?php include('header/header1.php') ?>
	<form action="actionFormulaireChoixVoiture.php" method="post">
	<div class="formulaire1" style =" margin-bottom: 45px;margin-left: 390px;">
		    <p style="font-size: 30px;margin-top: 57px;"> Louer une voiture avec vos critéres   </p>
		<select name="marque" required style="margin-top: 21px;width: 474px;">
			<option selected disabled hidden> Choisir la marque de la voiture </option>
			<option value="audi">audi</option>
			<option value="Dacia">Dacia</option>
			<option value="Hyundai">Hyundai</option>
			<option value="Kia">Kia</option>
			<option value="Renault">Renault</option>
			<option value="Toyota">Toyota</option>
			<option value="Nissan">Nissan</option>
			<option value="Peugeot">Peugeot</option>
		</select>
		<select name="categorie" required style="margin-top: 21px;width: 474px;">
			<option selected disabled hidden> Choisir la catégorie de la voiture </option>
			<option value="Micro-urbaines">Micro-urbaines</option>
			<option value="Mini-citadines">Mini-citadines</option>
			<option value="citadines polyvalentes">citadines polyvalentes</option>
			<option value="compactes">compactes</option>
			<option value="berlines taille S">berlines taille S </option>
			<option value=" berlines taille M">berlines taille M</option>
			<option value="berlines taille L">berlines taille L</option>
		</select>
		<select name="couleur" required style="margin-top: 21px;width: 474px;">
			<option selected disabled hidden> Choisir la couleur de la voiture </option>
			<option value="Noir">Noir</option>
			<option value="blanc">blanc</option>
			<option value="Gris">gris</option>
			<option value="Rouge ">Rouge</option>
		</select>
		<select name="moteur" required style="margin-top: 21px;width: 474px;">
			<option selected disabled hidden> Choisir le moteur de la voiture </option>
			<option value="diesel">Diesel</option>
			<option value="essence">essence</option>
			
		</select>
		<select name="boite" required style="margin-top: 21px;width: 474px;">
			<option selected disabled hidden> Choisir la boite de la voiture </option>
			<option value="automatique">boite automatique</option>
			<option value="manuelle">Boite manuelle</option>
		</select>
		<div class="bouton">
		<input type="submit" style="margin-top: 25px;margin-left: 150px;width:20% "  name="submit" value="Valider">
		
		</div>
	
</div>	
</form>
<?php include('footer/footer.php'); ?>

</body>
</html>
