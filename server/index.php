<?php
// ini_set('display_errors',1);
session_start();

// var_dump($_GET);
// var_dump($_POST);
// var_dump($_SESSION);
// exit;

spl_autoload_register(function($class)
{
    $accessClass = [
    	'User' => 'module/user/model/'.$class.'.class.php',
    	'UserManager' => 'module/user/model/'.$class.'.class.php', 
    	'Message' => 'module/message/model/'.$class.'.class.php',
    	'MessageManager' => 'module/message/model/'.$class.'.class.php', 
    ];
    require($accessClass[$class]);
});



require('apps/listeErrors.php');
require('config.php');

try
{
    $db = new PDO('mysql:dbname='.$config['bdd'].';host='.$config['host'], $config['login'], $config['password']);
}
catch (PDOException $e)
{
	// require('views/errors500.phtml');
	die();
	// $_GET['page'] = 'errors';
}

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
	// if (in_array($_GET['page'], $ajax ))
	// {
	// 	$page = $_GET['page'];

	// 	$accessAjax = [
 //    		'listeMessage' => 'module/message/apps/'.$page.'.php',
 //    		'footer' => 'apps/'.$page.'.php',
 //    	];
 //    	require($accessAjax[$page]);
 //    }
?>