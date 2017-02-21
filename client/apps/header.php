<?php
if (isset($_SESSION['id'], $_SESSION['login'])) 
	require('views/headerConnect.phtml');	
else 
	require('views/header.phtml');
?>