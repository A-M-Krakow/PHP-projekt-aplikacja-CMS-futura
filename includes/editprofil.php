<?php
if ((isset($_SESSION['idk']))) {
$login='';
$imie='';
$nazwisko='';
$email='';
$formularz=true;
if (isset($_POST['imie'])) $imie=trim($_POST['imie']);
if (isset($_POST['nazwisko'])) $nazwisko=trim($_POST['nazwisko']);
if (isset($_POST['email'])) $email=trim($_POST['email']);

$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');

$pobranie ="select username, imie, nazwisko, email, foto from uzytkownicy where idk='$idk'";
$dane = mysqli_query($polaczenie, $pobranie) or die ('nie można pobrać danych z bazy');
$daneuz = mysqli_fetch_assoc($dane);





if (isset($_POST['zarejestruj'])) {
	if (empty ($imie)) echo '<br /><span class="uwaga">  Musisz podać imię! </span>';
	if (empty ($nazwisko)) echo '<span class="uwaga"> <br /> Musisz podać nazwisko! </br></span>';
	if (empty ($email) || (!preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $email))) echo '<br />Musisz podać poprawny adres e-mail';


	
	if (!empty ($imie) && !empty ($nazwisko) && !empty ($email) && (preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $email))) {
		
		
		
		
		$imie=mysqli_real_escape_string($polaczenie, $imie);
		$nazwisko=mysqli_real_escape_string($polaczenie, $nazwisko);
		$email=mysqli_real_escape_string($polaczenie, $email);			
		
		$sprawdzenie = "SELECT * FROM uzytkownicy WHERE username='$login'";
		$rezultat=mysqli_query($polaczenie, $sprawdzenie);
		$rejestracja = "UPDATE uzytkownicy set imie='$imie', nazwisko='$nazwisko', email='$email' where idk='$idk';";
		mysqli_query ($polaczenie, $rejestracja) or die ('nie można wstawić rekordu do bazy danych');
		mysqli_close($polaczenie);		
		
		
	
	$formularz=false;
	echo 'Zmieniłeś dane, <a href="zobaczprofil.php?uzytkownik=' . $username . ' ">Zobacz swój profil</a>';
	
	
	
	}


}


if ($formularz) {
?>
<img class="avatar" src="<?php echo  FOLD_OBR . $daneuz['foto'] ?>"/> <br/>
<a href="dodajfoto.php"> Zmień zdjęcie </a> | <a href="zmienhaslo.php"> Zmień hasło </a>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<label for="imie"> Imię: </label> <input type="text" id="imie" name="imie" value="<?php echo $daneuz['imie'] ?>"/> <br />
	<label for="nazwisko"> Nazwisko: </label> <input type="text" id="nazwisko" name="nazwisko"  value="<?php echo $daneuz['nazwisko'] ?>" />  <br />
	<label for="email"> E-mail: </label> <input type="text" id="email" name="email" value="<?php echo $daneuz['email'] ?>" />  <br />
	<input type="submit" id="zarejestruj" name="zarejestruj" value="Zmień dane">
</form>

<?php }
}
else header ('location: login.php');
?>
