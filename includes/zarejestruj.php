<?php
$login='';
$imie='';
$nazwisko='';
$email='';
$formularz=true;
if (isset($_POST['login'])) $login=trim($_POST['login']);
if (isset($_POST['haslo'])) $haslo=trim($_POST['haslo']);
if (isset($_POST['haslo2'])) $haslo2=trim($_POST['haslo2']);
if (isset($_POST['imie'])) $imie=trim($_POST['imie']);
if (isset($_POST['nazwisko'])) $nazwisko=trim($_POST['nazwisko']);
if (isset($_POST['email'])) $email=trim($_POST['email']);

if (isset($_POST['zarejestruj'])) {
	if ($haslo != $haslo2) echo '<br /><span class="uwaga"> Hasło i potwierdzenie hasła nie zgadzają się! </span>';
	if (empty ($imie)) echo '<br /><span class="uwaga">  Musisz podać imię! </span>';
	if (empty ($login)) echo '<br /><span class="uwaga">  Musisz podać login! </span>';
	if (empty ($nazwisko)) echo '<span class="uwaga"> <br /> Musisz podać nazwisko! </br></span>';
	if (empty ($email) || (!preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $email))) echo '<br />Musisz podać poprawny adres e-mail';
  if (empty ($haslo) || (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|-]).{8,30}$/',$haslo))) echo '<br /><span class="uwaga"> Hasło powinno mieć pomiędzy 8 a 30 znaków i musi zawierać przynajmniej: <br />jedną małą literę, jedną dużą literę, jedną cyfrę, jeden znak specjalny </span>';

	
	if (!empty ($login) && !empty ($imie) && !empty ($nazwisko) && !empty ($email) && (preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $email)) && $haslo==$haslo2 && (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|-]).{8,30}$/',$haslo) )) {
		
		
		$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
		
		$imie=mysqli_real_escape_string($polaczenie, $imie);
		$nazwisko=mysqli_real_escape_string($polaczenie, $nazwisko);
		$email=mysqli_real_escape_string($polaczenie, $email);		
		$login=mysqli_real_escape_string($polaczenie, $login);	
		$haslo=mysqli_real_escape_string($polaczenie, $haslo);
		
		$sprawdzenie = "SELECT * FROM uzytkownicy WHERE username='$login'";
		$rezultat=mysqli_query($polaczenie, $sprawdzenie);
		if (mysqli_num_rows($rezultat) == 0) {
		$rejestracja = "INSERT INTO uzytkownicy (username, password, imie, nazwisko, email, foto) values ('$login', SHA('$haslo'), '$imie', '$nazwisko', '$email', 'brak.jpg');";
		mysqli_query ($polaczenie, $rejestracja) or die ('nie można wstawić rekordu do bazy danych');
		mysqli_close($polaczenie);		
		
		
	
	$formularz=false;
	echo 'Zarejestrowałeś się, <a href="login.php">Zaloguj się </a>';
	
	}
	else echo '<span class="uwaga"> <br />Taka nazwa użytkownika już istnieje. <br /> Wybierz inną.</span>';
	}


}


if ($formularz) {
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<label for="imie"> Login: </label> <input type="text" id="login" name="login" value="<?php echo $login ?>"/> <br />
	<label for="imie"> Hasło: </label> <input type="password" id="haslo" name="haslo"/> <br />
	<label for="imie"> Potwierdź hasło: </label> <input type="password" id="haslo2" name="haslo2"/> <br />
	<label for="imie"> Podaj imię: </label> <input type="text" id="imie" name="imie" value="<?php echo $imie ?>"/> <br />
	<label for="nazwisko"> Podaj nazwisko: </label> <input type="text" id="nazwisko" name="nazwisko"  value="<?php echo $nazwisko ?>" />  <br />
	<label for="email"> Podaj adres e-mail: </label> <input type="text" id="email" name="email" value="<?php echo $email ?>" />  <br />
	<input type="submit" id="zarejestruj" name="zarejestruj" value="Zarejestruj">
</form>

<?php }
?>