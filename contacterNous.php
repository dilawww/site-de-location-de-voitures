<?php
session_start();
@$email=htmlentities($_POST['email']);
@$message=htmlentities($_POST['message']);
if (isset($_POST['envoyer'])) {
$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req=$bdd->prepare('INSERT INTO message(email,message,permisClient) VALUES (?,?,?)');
$req->execute(array(@$email,@$message,$_SESSION['permis']));
header('Location: contacterNous.php?m=1');
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Contactez nous</title>
	
		<link rel="stylesheet" href="style/bootstrap.min.css">
		<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
    <link rel="stylesheet" href="fonts/icons.css">
		
	<meta charset="utf-8">
</head>
<body>
<?php 
include('header/header1.php');
?>

<form action="" method="post">
	<div style="display: grid;box-shadow: 0 5px 8px 8px rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);margin-top: 62px;width: 650px;margin-left: 330px; margin-top:100px;margin-bottom: 50px;">
		<p style="    text-align: center;font-size: 40px;padding-top: 20px;">Contacter nous</p>
		<input style="    width: 288px;margin-top: 30px;margin-left: 200px;" type="email" name="email" placeholder="Veuillez saisir votre email " required>
		<textarea style="width:100px;margin-top: 40px;margin-left:0px;height: 120px;text-align: center;" name="message" placeholder="Veuillez saisir votre message ici" required></textarea>
		<input style="width: 288px;margin-top: 40px;margin-left: 200px;margin-bottom: 35px" type="submit" name="envoyer" value="Envoyer">
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
 		type :'success',
 		title : 'Succès '
 	})
 }
 </script>
</form>
<?php include('footer/footer.php'); ?>
</body>
</html>