<?php
if ((isset($_SESSION['idk']))) {
$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
$zapytanie = "SELECT IdKategorii, Nazwa from kategorie;";
$rezultat = mysqli_query($polaczenie, $zapytanie);



if (isset($_POST['zmiennazwe']) && !empty($_POST['zmiennazwe']) && $_POST['zmiennazwe']!=" ") {
$Nazwa = mysqli_real_escape_string($polaczenie, trim($_POST['zmiennazwe']));
$IdKategorii = $_POST['IdKategorii'];

$zmiana = "update kategorie set Nazwa = '$Nazwa' where IdKategorii = '$IdKategorii'";
mysqli_query($polaczenie, $zmiana) or die ('nie można zmienić rekordów w bazie danych');
header ('location: edkategorie.php');
}

if (isset($_POST['dodajkat']) && !empty($_POST['dodajkat']) && $_POST['dodajkat']!=" ") {
$Nazwa = mysqli_real_escape_string($polaczenie, trim($_POST['dodajkat']));


$zmiana = "insert into kategorie (Nazwa) values ('$Nazwa');";
mysqli_query($polaczenie, $zmiana) or die ('nie można zmienić rekordów w bazie danych');
header ('location: edkategorie.php');
}

if (isset($_POST['usunkat']) && !empty($_POST['usunkat'])) {
$IdKategorii = $_POST['usunkat'];
$zmiana = "delete from kategorie where IdKategorii = '$IdKategorii'";
mysqli_query($polaczenie, $zmiana) or die ('nie można zmienić rekordów w bazie danych');
header ('location: edkategorie.php');
}


while ($wiersz = mysqli_fetch_array($rezultat)) {
$IdKategorii = $wiersz['IdKategorii'];
echo '  <br /><br /> <form method="POST" action="' . $_SERVER['PHP_SELF'] . '">
        <input type="text" name="zmiennazwe" id="zmiennazwe" value="' . $wiersz['Nazwa'] .'" /> 
        <input type="hidden" name="IdKategorii" id="IdKategorii" value="' . $wiersz['IdKategorii'] .'" />
        <input type="submit" value="Zmień nazwę" /> </form>';
        
$liczenie = "select count(*) as ilosc from posty where idkategorii = '$IdKategorii'";
$result = mysqli_query($polaczenie, $liczenie);
$ilepostow = mysqli_fetch_assoc($result);
if ($ilepostow['ilosc'] == 0) {


        
        echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">
        <button type="submit" name="usunkat" id="usunkat" value="' . $wiersz['IdKategorii'] .'" /> Usuń kategorię </button> 
        </form>  ';
        }
else echo '<a href="posty.php?IdKategorii='. $wiersz['IdKategorii'] . '"> Zobacz artykuły (' . $ilepostow['ilosc']. ') </a>';

}

 echo '<form style="text-align: right;" method="POST" action="' . $_SERVER['PHP_SELF'] . '">
        <input type="text" name="dodajkat" id="dodajkat" /> 
        
        <input type="submit" value="Dodaj kategorię" /> </form> ';
     
        
    mysqli_close($polaczenie); }
    
else header ('location: login.php');