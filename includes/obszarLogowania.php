	<?php 
	
	if (isset($_SESSION['username']) && (isset($_SESSION['idk']))) {
   $idk = $_SESSION['idk'];
   $username = $_SESSION['username'];
   require_once('includes/zalogowany.php');
   
	}
	else {
   require_once('includes/niezalogowany.php');
	}


