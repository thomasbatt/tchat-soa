<?php
$limit = 10;
if ( isset( $_SESSION['limit'] ))
	$limit = $_SESSION['limit'];

// $MessageManager = new MessageManager($db);
$MessageManager = $soapClass['MessageManager'];
// $MessageManager = new SoapClient($wsdl."MessageManager",$soapOptions);


$messages = $MessageManager->getAll($limit);
// var_dump($messages);
// var_dump( $MessageManager->__getLastRequest());
// exit;
$count = sizeof($messages)-1;
// var_dump($messages);
while ( isset($messages[$count]) )
{
	$message = $messages[$count];
	// var_dump($message);
	$date = date( "H:i" , strtotime($message->create_message));
	if( $message->idUser_message == $_SESSION['id'] )
		require('module/message/views/MessageConnect.phtml');		
	else
		require('module/message/views/Message.phtml');
	$count--;
}	
?>