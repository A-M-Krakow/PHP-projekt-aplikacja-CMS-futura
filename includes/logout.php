<?php
	session_start();
	if (isset($_SESSION['idk']) || isset($_SESSION['username'])) {

		$_SESSION=array();

		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-3600, '/');
		}
	}
	
	if(isset($_COOKIE['idk']) || isset($_COOKIE['username'])) {
			setcookie('username','',time()-3600, '');
			setcookie('idk','',time()-3600, '');
			}
	
	
	session_destroy();
	$strgw='index.php';
	header('location:'.$strgw);
	
	
?>