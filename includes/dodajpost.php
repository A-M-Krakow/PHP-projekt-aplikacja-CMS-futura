<?php


 $formularz=true;
 
$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');

if (isset($_POST['dodaj'])) {

if (!empty($_POST['temat']) && !empty($_POST['tresc'])) {
$formularz=false;
$temat = mysqli_real_escape_string($polaczenie, trim($_POST['temat']));
$tresc = mysqli_real_escape_string($polaczenie, trim($_POST['tresc']));
$IdKategorii = $_POST['IdKategorii'];

$zapytanie = "insert into posty (temat, tresc, IdKategorii, idk) values ('$temat', '$tresc', '$IdKategorii', '$idk');";
mysqli_query($polaczenie, $zapytanie) or die ('nie udało się wstawić rekordów do bazy');
echo 'dodano artykuł do bazy';


mysqli_close($polaczenie);
}
else echo '<span class="uwaga"> Musisz wypełnić wszystkie pola! </span>';
}
if ($formularz) {












echo ('<table cellpadding="0"  style="width: 100%;" >');
          
$wiersz = mysqli_fetch_assoc($rezultat); 

  
    
    if ((isset($_SESSION['idk']))) {
    
      
    ?>
    
    
    <form method="POST" action="dodajpost.php">
    
      <table class="post">
      <tr><td> <label for "temat"> Kategoria: </label></td><td><?php require('includes/listakategorii.php'); ?></td></tr>
      <tr><td> <label for "temat"> Temat: </label></td><td><input type="text" id="temat" name="temat" value="<?php  echo $wiersz['temat']; ?>"> </td></tr>
      <tr><td><label for "tresc"> Treść: </label></td><td><textarea cols="60" rows="15" id="tresc" name="tresc"><?php  echo $wiersz['tresc']; ?></textarea></td></tr>
      <tr><td colspan="2" align="right"> <input type="submit" name="dodaj" id="dodaj" value="Zapisz"></td></tr>
   </form>
   <form method="POST" action="editpost.php">
   
   
   </table>
    </form>
    
    <?php
    
  
   
    
    }
    
    else echo 'Nie masz uprawnień aby dodawać posty!';
    
  
}
?>

