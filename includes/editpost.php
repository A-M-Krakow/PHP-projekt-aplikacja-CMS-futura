<?php

 if (isset($_POST['EdIdPostu']) && !empty($_POST['EdIdPostu'])) {
    $IdPostu = $_POST['EdIdPostu']; }
 else header ('Location: index.php');
 $formularz=true;
 
$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');

if (isset($_POST['edytuj'])) {
$formularz=false;
$IdPostu = $_POST['EdIdPostu'];
$temat = mysqli_real_escape_string($polaczenie, trim($_POST['temat']));
$tresc = mysqli_real_escape_string($polaczenie, trim($_POST['tresc']));
$IdKategorii =$_POST['IdKategorii'];

$zapytanie = "update posty set temat='$temat', tresc='$tresc', idKategorii='$IdKategorii'  where idPostu='$IdPostu';";
mysqli_query($polaczenie, $zapytanie) or die ('nie udało się wstawić rekordów do bazy');
header ("Location: post.php?IdPostu=$IdPostu");


mysqli_close($polaczenie);
}

if ($formularz) {


$zapytanie = " select posty.temat, posty.tresc, posty.data_utw, posty.IdPostu,
               uzytkownicy.idk, uzytkownicy.username, kategorie.nazwa, kategorie.IdKategorii 
               from kategorie inner join posty on 
               posty.IdKategorii = kategorie.IdKategorii inner join 
               uzytkownicy on posty.idk = uzytkownicy.idk 
               where posty.IdPostu = '$IdPostu'";
$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('nie można pobrać danych z bazy danych');






mysqli_close($polaczenie);



echo ('<table cellpadding="0"  style="width: 100%;" >');
          
$wiersz = mysqli_fetch_assoc($rezultat); 

  
    
    if (($wiersz['idk'] == $idk)) {
    
      
    ?>
    
    
    <form method="POST" action="edit.php">
    
      <table class="post">
      <tr><td> <label for "temat"> Autor: </label></td><td><input type="text" disabled id="username" name="username" value="<?php  echo $wiersz['username']; ?>"> <input type="hidden" id="EdIdPostu" name="EdIdPostu" value="<?php  echo $wiersz['IdPostu']; ?>">  </td></tr>
       <tr><td> <label for "temat"> Data dodania: </label></td><td><input type="text" disabled id="data_utw" name="data_utw" value="<?php  echo $wiersz['data_utw']; ?>"> </td></tr>
      <tr><td> <label for "temat"> Kategoria: </label></td><td><?php require('includes/listakategorii.php'); ?></td></tr>
      <tr><td> <label for "temat"> Temat: </label></td><td><input type="text" id="temat" name="temat" value="<?php  echo $wiersz['temat']; ?>"> </td></tr>
      <tr><td><label for "tresc"> Treść: </label></td><td><textarea cols="60" rows="15" id="tresc" name="tresc"><?php  echo $wiersz['tresc']; ?></textarea></td></tr>
      <tr><td colspan="2" align="right"> <input type="submit" name="edytuj" id="edytuj" value="Zapisz"></td></tr>
   </form>
   <form method="POST" action="editpost.php">
   
   
   </table>
    </form>
    
    <?php
    
  
   
    
    }
    
    else echo 'Nie masz uprawnień do edycji tego postu!';
    
  
}
?>

