<?php
	$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
	$zapytanie = "SELECT IdKategorii, nazwa from kategorie";
	$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('Nie udało się pobrać danych z bazy');
	mysqli_close($polaczenie);


	

	


	if (mysqli_num_rows($rezultat) == 0) echo 'Nie znaleziono żadnych kategorii!'; 
	
	
	else {
    echo '<p class="menu">  Menu: </p>';
    
    require_once('includes/kategorie.php');
    require_once('includes/wyszukiwarka.php'); }
    
    
    if (isset($_SESSION['username']) && (isset($_SESSION['idk']))) { echo '<br /> <p class="menu">Użytkownik: </p>'; require_once('includes/menudod.php'); };
    
     
		
		
		
		

	?>
	
		
		
	
	
	