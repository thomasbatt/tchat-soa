<?php
$error = '';
spl_autoload_register(function($class)
{
    require('models/'.$class.'.class.php');
});
/*	AVANT :
function __autoload($class)
{
    require('models/'.$class.'.class.php');
}
*/
session_start();
// $_SESSION['id'] = 1;
// $_SESSION['login'] = 'admin';
$db = @mysqli_connect('localhost', 'root', 'troiswa', 'tchat');
if (isset($_SESSION['id']))
{
	$page = 'tchat';
	$access = ['logout', 'tchat'];
}
else
{
	$page = 'login';
	$access = ['login', 'register'];
}
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access))
		$page = $_GET['page'];
	else
	{
		header('Location: '.$page);
		exit;
	}
}
$traitements = ['login'=>'user','register'=>'user','logout'=>'user','tchat'=>'message'];
if (isset($traitements[$page]))
	require('apps/traitement_'.$traitements[$page].'.php');
require('apps/skel.php');
?>
