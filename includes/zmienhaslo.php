<?php
$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');


if (isset($_POST['has']) && isset($_POST['noweh']) && isset($_POST['noweh2'])) {

$has=mysqli_real_escape_string($polaczenie, trim($_POST['has']));
$noweh=mysqli_real_escape_string($polaczenie, trim($_POST['noweh']));
$noweh2=mysqli_real_escape_string($polaczenie, trim($_POST['noweh2']));

$sprawdzenie = "SELECT idk, username FROM uzytkownicy WHERE idk='$idk' and password=SHA('$has')";
$wynik = mysqli_query($polaczenie, $sprawdzenie) or die ('Nie można pobrać danych z bazy danych');

if (mysqli_num_rows($wynik) == 1) {
  if ($noweh == $noweh2) {
    
    if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|-]).{8,30}$/',$noweh)) {

      $zapytanie = "update uzytkownicy set password=SHA('$noweh') where idk='$idk'";
      mysqli_query($polaczenie, $zapytanie);
      mysqli_close($polaczenie);
      
      echo 'Twoje hasło zostało zmienione. <a href="index.php"> Przejdź do strony głównej </a>';

    }

    else echo '<span class="uwaga"> Nowe hasło powinno mieć pomiędzy 8 a 30 znaków i musi zawierać przynajmniej: <br />jedną małą literę, jedną dużą   literę, jedną cyfrę, jeden znak specjalny </span>';
  
  }
  
  else echo '<span class="uwaga"> Hasło i potwierdzenie hasła nie zgadzają się </span>';






}
else echo 'Podałeś nieprawidłowe hasło!';



}














?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
  <label for="haslo"> Dotychczasowe hasło: </label> <input type="password" name="has" id="has" /></br>
  <label for="noweh"> Nowe hasło: </label> <input type="password" name="noweh" id="noweh" /></br>
  <label for="noweh2"> Potwierdzenie nowego hasła </label> <input type="noweh2" name="noweh2" id="haslo" /></br>
  <input type="submit" value="Zmień hasło" />
</form>