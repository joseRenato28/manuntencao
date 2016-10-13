<?php
	require_once('../template.php');
	session_start();
	$_SESSION['id_usuario'];
	session_destroy();
	$TPL = new Template;
	$TPL->login();

?>