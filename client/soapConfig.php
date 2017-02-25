<?php

// ------------------------------ URI SERVER SOAP ------------------------------
// $uri = preg_replace(['/index.php/','/client/'],["soap.php","server"],'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']);

$uri = "http://tchat.webatt.fr/server/soap.php";

// -----------------------------------------------------------------------------

$wsdl = $uri."?wsdl=";
$soap = $uri."?class=";
$soapOptions = array(
   	// 'wsdl_cache' => 0,
   	// 'trace' => 1,
   	'exceptions'=> 1
); 
// ini_set('soap.wsdl_cache_enabled', 0);


function soapDebug($soapClass,$nameMethode,$param){
	try{
		$taballservices=$soapClass->$nameMethode($param);


		echo nl2br("GetFunctions:\n");  var_dump($soapClass->__getFunctions()); echo nl2br("\n\n");
		echo nl2br("GetTypes:\n");  var_dump($soapClass->__getTypes()); echo nl2br("\n\n");
		echo nl2br("Request Header:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastRequestHeaders()))."\n");
		echo nl2br("REQUEST:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastRequest()))."\n");
		echo nl2br("Response Header:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastResponseHeaders()))."\n");
		echo nl2br("Response:\n" . htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastResponse()))."\n");
		

		echo nl2br("Result of: ".$nameMethode."\n"); 
		var_dump($taballservices);
		 echo nl2br("\n\n");
		 die();

		//On renvoie le résutat de notre méthode, pour voir...
	}catch(SoapFault $fault){
		echo '</pre><br/><br/> ErrorException Message : <br/>',
		$fault->getMessage(),
		'<br/> Response : <br/>',
		$soapClass->__getLastResponse();
		'Request : <br/><br/><br/><pre>';
		echo nl2br("\n\n");
		
		echo nl2br("GetFunctions:\n");  var_dump($soapClass->__getFunctions()); echo nl2br("\n\n");
		echo nl2br("GetTypes:\n");  var_dump($soapClass->__getTypes()); echo nl2br("\n\n");
		echo nl2br("Request Header:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastRequestHeaders()))."\n");
		echo nl2br("REQUEST:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastRequest()))."\n");
		echo nl2br("Response Header:\n".htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastResponseHeaders()))."\n");
		echo nl2br("Response:\n" . htmlentities(str_ireplace('><', ">\n<",$soapClass->__getLastResponse()))."\n");
		die();
	}


}
