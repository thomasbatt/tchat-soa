<?php

// var_dump($_GET);
// var_dump($_POST);
// var_dump($_SESSION);
// exit;

$errrors = [
	'IdMessage' => '',
	'password' => '',
	'IdMessage_exist' => ''
];

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'create_message')
	{
		if (isset( $_POST['content'] ))
		{
			// $MessageManager = new MessageManager($db);
			$MessageManager = new soapClient($wsdl.'MessageManager',$soapOptions);

			try
			{
				// $manager = new UserManager($db);
				$manager = new soapClient($wsdl.'UserManager',$soapOptions);
				// $author = $manager->getById($_SESSION['id']);
				$author = $manager->getById($_SESSION['id'])->id_user;
				$MessageManager->create($author, $_POST['content']);
				$_SESSION['limit'] = 10;
				header('Location: messages');
				exit;
			}
			catch (Exception $e)
			{
				$IdMessage = $_POST['content'];
				$error = $e->getMessage();
			}
		}
	}
	else if ($action == 'more_message')
	{
		$_SESSION['limit'] = $_SESSION['limit'] + 10;
		header('Location: messages');
		exit;
	}
	else
		$error = "Erreur interne (filou détecté !!!)";

}






?>