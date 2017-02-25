<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');
require('vendor/autoload.php');

$soapAccess = ['Message','MessageManager','User','UserManager'];
$soapOptions = array(
   	// 'wsdl_cache' => 0,
   	// 'trace' => 1,
   	'exceptions'=> 1
); 
 
$uri = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$wsdl = $uri."?wsdl=";
$soap = $uri."?class=";
$requireClass = array_merge(['ConnectionDB'],$soapAccess);
$i=0;
while(isset($requireClass[$i])){
	require('model/' . $requireClass[$i] . '.class.php'); 
	$i++;
}
// ini_set('soap.wsdl_cache_enabled', 0);


if(isset($_GET['wsdl']) && in_array($_GET['wsdl'], $soapAccess ))
{
	try
	{
		$class = $_GET['wsdl'];
		$serviceURI = $soap.$_GET['wsdl'];
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
else if( isset($_GET['class']) && in_array($_GET['class'], $soapAccess ) )
{
	session_start();
	try{
			$serversoap = new SoapServer($wsdl.$_GET['class'],$soapOptions);
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

	}
	catch(SoapFault $e)
	{
		error_log("SOAP ERROR: ". $e->getMessage());
		echo("SOAP ERROR: ". $e->getMessage());
	}
	die();
}
else
{
	echo 'Erreur. Seules les classes suivantes sont partagées: ';
	$i=0;
	while(isset($soapAccess[$i])){
		echo $soapAccess[$i]." / ";
		$i++;
	}
}

