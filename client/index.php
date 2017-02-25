<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// var_dump($_GET);
// var_dump($_POST);
// var_dump($_SESSION);
// exit;

session_start();

require('apps/listeErrors.php');
require('soapConfig.php');

if (isset($_SESSION['id']))
{
	$page = 'messages';
	$access = [ 'messages', 'profil' ];
	$ajax = [
		'listMessage'=>'module/message/apps/listMessage.php',
		'footer'=>'apps/footer.php'
	];
}
else
{
	$page = 'home';
	$access = ['home'];
	$ajax = [];
}
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access ))
		$page = $_GET['page'];
	else if (isset($ajax[$_GET['page']])) {
		$page = $ajax[$_GET['page']];
	}
	else
	{
		header('Location: '.$page);
		exit;
	}
}

$traitement_action = [
	'register' => 'User',
	'login' => 'User',
	'logout' => 'User',
	'information' => 'User',
	'create_message' => 'Message',
	'more_message' => 'Message',
];

if (isset($_POST['action'])) 
{
	$action = $_POST['action'];
	if (isset($traitement_action[$action])) 
	{
		$value = $traitement_action[$action];
		require('apps/traitement'.$value.'.php');
	}
}

if (!isset($_GET['ajax']))
	require('apps/skel.php');
else
	require($page);

?>