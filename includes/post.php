<?php

 if (isset($_GET['IdPostu']) && !empty($_GET['IdPostu'])) {
$IdPostu = $_GET['IdPostu']; }
 else header ('Location: index.php');
 
 
$polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');





$zapytanie = " select posty.idk, posty.temat, posty.tresc, posty.data_utw, posty.IdPostu,
               uzytkownicy.username, kategorie.nazwa, kategorie.IdKategorii 
               from kategorie inner join posty on 
               posty.IdKategorii = kategorie.IdKategorii inner join 
               uzytkownicy on posty.idk = uzytkownicy.idk 
               where posty.IdPostu = '$IdPostu'";
$rezultat = mysqli_query($polaczenie, $zapytanie) or die ('nie można pobrać danych z bazy danych');
$wiersz = mysqli_fetch_assoc($rezultat); 
mysqli_close($polaczenie);

?>
<table cellpadding="0"  style="width: 100%;">
    

  
    
    
     
      
   
    
    
   
    
      <table class="post">
      <tr>
        <td colspan="2">
        
        <table class="tytul" width="100%">
          <tr>
              <td style="border: 0;"><span class="tytul"><?php  echo $wiersz['temat']; ?></span></td>
              <td style="text-align: right; border: 0;">
                 <?php if ((!empty($idk) && $idk==$wiersz['idk']))  { ?> <form style="display: inline;" action="edit.php" method="POST">
                  <button type="submit"name="EdIdPostu" id="EdIdPostu"  value="<?php echo $wiersz['IdPostu'] ?>" style="font-size: 10px;"> edytuj           </button>
                  <button type="submit"name="UsIdPostu" id="UsIdPostu"  value="<?php echo $wiersz['IdPostu'] ?>" style="font-size: 10px;"> usuń           </button>
                </form> <?php } ?>
              </td>
          </tr>
        </table>
        
        
        
        </td>
      </tr>
     
     
     
      <tr><th>Kategoria: </th><td><a href="posty.php?IdKategorii=<?php echo $wiersz['IdKategorii']; ?>"><?php echo $wiersz['nazwa']; ?></a></td></tr>
      <tr><th> Autor: </th><td ><?php  echo $wiersz['username']; ?> </td></tr>
      <tr><th>Treść: </th><td ><?php  echo $wiersz['tresc']; ?></td></tr>
      <tr><th>Dodany: </th><td > <?php  echo $wiersz['data_utw']; ?> </td></tr>
      
      
   
    
   
   </table>

    

