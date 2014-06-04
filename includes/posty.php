<?php

 if (isset($_GET['IdKategorii']) && !empty($_GET['IdKategorii'])) {
    $IdKategorii = $_GET['IdKategorii']; }
 else header ('Location: index.php');
 
 $sortuj = 4;

if (isset ($_POST['sortuj'])) {
$sortuj = $_POST['sortuj']; }

switch ($sortuj) {

  case 1: $sort = 'username asc'; break;
  case 2: $sort = 'username desc'; break;
  case 3: $sort = 'data_utw asc'; break;
  case 4: $sort = 'data_utw desc'; break;
  case 5: $sort = 'temat asc'; break;
  case 6: $sort = 'temat desc'; break;
  case 7: $sort = 'tresc asc'; break;
  case 8: $sort = 'tresc desc'; break;
  default: $sort = 'data_utw desc'; break;
  }

    
    
    $strona = 1;

if (isset($_POST['strona'])) $strona = $_POST['strona'];

$naStronie = 5;

$start = ($strona-1)*$naStronie ;

$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');
$zapytanie = " select posty.temat, posty.tresc, posty.data_utw, posty.IdPostu,
               uzytkownicy.idk, uzytkownicy.username, kategorie.nazwa, kategorie.IdKategorii
               from kategorie inner join posty on 
               posty.IdKategorii = kategorie.IdKategorii inner join 
               uzytkownicy on posty.idk = uzytkownicy.idk 
               where kategorie.IdKategorii = '$IdKategorii'" ;
$zapytanie .= "order by $sort LIMIT $start, $naStronie ";              

            
$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('nie można pobrać danych z bazy danych');

$zap2 = "select count(*) as ilPostow from posty where IdKategorii= '$IdKategorii'";
$rez2 = mysqli_query($polaczenie, $zap2) or die ('nie można pobrać danych z bazy danych');
$il=mysqli_fetch_assoc($rez2);
$iloscPostow = $il['ilPostow'];
$iloscStron = ceil($iloscPostow / $naStronie);

mysqli_close($polaczenie);
?>


Znaleziono artykułów: <?php echo $iloscPostow;  ?>

<form id="sortowanie" name="sortowanie" action="<?php echo $_SERVER ['PHP_SELF'] ?>?IdKategorii=<?php echo $IdKategorii ?>" method="post">
		<label for="sortow">Sortuj według: </label>
		<select name="sortuj" id="sortuj">
				<option value="1" <?php if ($sortuj == 1) echo 'selected' ?> > Autora rosnąco </option>
				<option value="2" <?php if ($sortuj == 2) echo 'selected' ?> > Autora malejąco </option>
				<option value="3" <?php if ($sortuj == 3) echo 'selected' ?> > Daty rosnąco </option>
				<option value="4" <?php if ($sortuj == 4) echo 'selected' ?> > Daty malejąco </option>
				<option value="5" <?php if ($sortuj == 5) echo 'selected' ?> > Tematu rosnąco </option>
				<option value="6" <?php if ($sortuj == 6) echo 'selected' ?> > Tematu malejąco </option>
				<option value="7" <?php if ($sortuj == 7) echo 'selected' ?> > Treści rosnąco </option>
				<option value="8" <?php if ($sortuj == 8) echo 'selected' ?> > Treści malejąco </option>
		</select>
		<input type="submit" value="sortuj" />
</form>



<?php
          
if (mysqli_num_rows($rezultat)!=0) {
?><form style="text-align: right;" action="<?php echo $_SERVER ['PHP_SELF'] ?>?IdKategorii=<?php echo $IdKategorii ?>" method="POST">
<?php require('wyborStron.php'); ?>
<input type="hidden" name="sortuj" id="sortuj" value="<?php echo $sortuj ?>">
    </form>

    <?php require('includes/wyswietlaniepostow.php'); ?>
     

 
    
    
     


  <form style="text-align: right;" action="<?php echo $_SERVER ['PHP_SELF'] ?>?IdKategorii=<?php echo $IdKategorii ?>" method="POST">
<?php require('wyborStron.php'); ?>
<input type="hidden" name="sortuj" id="sortuj" value="<?php echo $sortuj ?>">
    </form> <?php
}
else echo '<hr size="1" color="silver"/> Nie znaleziono artykułów w tej kategorii';
?>

