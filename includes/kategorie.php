<?php
	$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
	$zapytanie = "SELECT IdKategorii, nazwa from kategorie";
	$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('Nie udało się pobrać danych z bazy');
	mysqli_close($polaczenie);


	

	


	if (mysqli_num_rows($rezultat) == 0) echo 'Nie znaleziono żadnych kategorii!'; 
	
	
	else { 
   echo ' <ul class="kategorie">';
		while ($wiersz = mysqli_fetch_array($rezultat)) {
	
		echo '<li><a href="posty.php?IdKategorii=' . $wiersz['IdKategorii'] . '"> >> ' . $wiersz['nazwa'] . ' << </a></li>';
		}
		
		echo '</ul>';
	}
	?>
	
		
		
	
	
	