<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');
require('vendor/autoload.php');

require('module/user/model/User.class.php');
require('module/user/model/UserManager.class.php');
require('module/message/model/Message.class.php');
require('module/message/model/MessageManager.class.php');

try
{
    $db = new PDO('mysql:dbname='.$config['bdd'].';host='.$config['host'], $config['login'], $config['password']);
}
catch (PDOException $e)
{
	error_log("PDO ERROR: ". $e->getMessage());
	echo("PDO ERROR: ". $e->getMessage());
	die();
}

if(isset($_GET['wsdl']))
{
	try
	{
		$class = $_GET['wsdl'];
		$serviceURI = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?class='.$_GET['wsdl'];
		$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
		// Generate thw WSDL from the class adding only the public methods that have @soap annotation.
		$wsdlGenerator->generateWSDL(true);
		$wsdlXML = $wsdlGenerator->dump();
		echo(header('content-type: text/xml'));
		echo $wsdlXML;
	}
	catch (PDOException $e)
	{
		error_log("PHP2WSDL ERROR: ". $e->getMessage());
		echo("PHP2WSDL ERROR: ". $e->getMessage());
	}
	die();
}

if(isset($_GET['class'])){
	try{
		session_start();
		ini_set('soap.wsdl_cache_enabled', 0);
		$serversoap = new SoapServer(
			// "http://localhost/openclassrooms/webservice-soa/server/tchat/soap.php?wsdl=".$_GET['class']
			null,
			array(
			'uri' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?class='.$_GET['class'],
			'wsdl_cache' => 0,
			'trace' => 1,
			'exceptions'=> 1
			)
		);
		$soapAccess = ['Message','MessageManager','User','UserManager'];
		if (in_array($_GET['class'], $soapAccess )){

			$serversoap->setClass($_GET['class'],$db);
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				// $serversoap->setPersistence(SOAP_PERSISTENCE_SESSION);
			  	$serversoap->handle();
			} else {
			  echo "Ce serveur SOAP peut gérer la class ".$_GET['class']." avec les methodes suivantes : ";
			  $functions = $serversoap->getFunctions();
			  var_dump($functions);
			}
		}
	}
	catch(SoapFault $e)
	{
		error_log("SOAP ERROR: ". $e->getMessage());
		echo("SOAP ERROR: ". $e->getMessage());
	}
	die();
}

