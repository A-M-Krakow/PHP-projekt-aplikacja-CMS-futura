<?php

  $polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');
  $que = "select IdKategorii, Nazwa from kategorie";
  $rez = mysqli_query($polaczenie, $que);
  
?> 
<select id="IdKategorii" name="IdKategorii">

<?php
while ($kat = mysqli_fetch_array($rez)) {
?>
<option value="<?php echo  $kat['IdKategorii'] ?>" <?php if (isset($wiersz['IdKategorii']) && ($wiersz['IdKategorii'] == $kat['IdKategorii'])) echo 'selected';  ?> > <?php echo $kat['Nazwa'] ?> </option >
<?php
}
?>
</select>



