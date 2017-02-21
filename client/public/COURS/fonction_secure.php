// -------------QUATRE FONCTIONS------------------------


// ----------mysqli_real_escape_string-------------
<?php
$login = mysqli_real_escape_string($db, $login);
?>

// ---------------password_hash--------------------
<?php
$password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
$password = mysqli_real_escape_string($db, $password);
// http://fr2.php.net/manual/fr/function.password-hash.php
$query = "INSERT INTO users (login, password) VALUES('".$login."', '".$password."')";
?>

// --------------password_verify--------------------
<?php
// http://fr2.php.net/manual/fr/function.password-verify.php
if (password_verify($password, $user['password']))
?>


// -------------- htmlentities ----------------------
	
<strong>Erreur :</strong> <?=htmlentities($error)?>


// ------------------ session -----------------------

session_start();
//--------------
$_SESSION['id'] = $user['id'];
$_SESSION['login'] = $user['login'];
//--------------
session_destroy();
$_SESSION = array();


