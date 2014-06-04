<?php

	if (isset($_GET['uzytkownik'])) $uzytkownik = $_GET['uzytkownik'];
	$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
	$zapytanie = "SELECT nazwisko, imie, email,foto, username from uzytkownicy where username = '$uzytkownik'";
	$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('Nie udało się pobrać danych z bazy');
	mysqli_close($polaczenie);

?>
	
	<table class="uzytk">
		<tr>
			<th> Zdjęcie </th>
			<th> Imię </th>
			<th> Nazwisko </th>
			<th> E-mail </th>
			
		</tr>
	
<?php

	if (mysqli_num_rows($rezultat) == 0) echo '<tr> <td colspan="6"> Nie znaleziono użytkowników </td></tr>'; 
	
	else {
		$wiersz = mysqli_fetch_assoc($rezultat);
		
		echo '<h2>' . $wiersz['username'] . '</h2>';
	
		echo '<tr>
			<td> <img class="avatar" src="' . FOLD_OBR . $wiersz['foto'] . '"/> </td>  
			<td> ' . $wiersz['imie'] . ' </td>
			<td>' . $wiersz['nazwisko'] . ' </td>
			<td>' . $wiersz['email']; 
			
		echo '</td></tr>';
		}
	
	?>
	</table>
		
		
	
	
	