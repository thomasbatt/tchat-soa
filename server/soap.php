<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');
require('vendor/autoload.php');

require('ConnectionDB.class.php');
require('module/user/model/User.class.php');
require('module/user/model/UserManager.class.php');
require('module/message/model/Message.class.php');
require('module/message/model/MessageManager.class.php');

// function __autoload($class_name){
//     require('model/' . $class_name . '.php'); 
// }

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
	catch (Exception $e)
	{
		error_log("PHP2WSDL ERROR: ". $e->getMessage());
		echo("PHP2WSDL ERROR: ". $e->getMessage());
	}
	die();
}

if(isset($_GET['class']))
{
	session_start();
	try{
		ini_set('soap.wsdl_cache_enabled', 0);
		$soapAccess = ['Message','MessageManager','User','UserManager'];
		if (in_array($_GET['class'], $soapAccess ))
		{
			$serversoap = new SoapServer(
				"http://localhost/openclassrooms/webservice-soa/tchat-soa/server/soap.php?wsdl=".$_GET['class'],
				// null,
				array(
				// 'wsdl_cache' => 0,
				// 'trace' => 1,
				'exceptions'=> 1
				)
			);
			$serversoap->setClass($_GET['class'],$dbConfig);
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$serversoap->setPersistence(SOAP_PERSISTENCE_SESSION);
			  	$serversoap->handle();
			}else
			{
			  echo "Ce serveur SOAP peut gérer la class ".$_GET['class']." avec les methodes suivantes : ";
			  $functions = $serversoap->getFunctions();
			  var_dump($functions);
			}
		}else
		{
			echo 'Class non autorisée. Les methodes partagées sont: ';
			$i=0;
			while(isset($soapAccess[$i])){
				echo $soapAccess[$i]." / ";
				$i++;
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

