<?php
// $UserManager = new UserManager($db);
$UserManager = $soapClass['UserManager'];

$users = $UserManager->getAll();
$UserManager->upDateConnected($_SESSION['id']);
$count = 0;
while ( isset($users[$count]) )
{
	$test = $UserManager->isConnected($users[$count]->id_user);
	if ($test) 
		$color = 'green';
	else
		$color = 'red';
	require('module/user/views/user.phtml');
	$count++;
}	
?>