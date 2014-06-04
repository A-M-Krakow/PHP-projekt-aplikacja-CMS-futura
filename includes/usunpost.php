<?php

 if (isset($_POST['UsIdPostu']) && !empty($_POST['UsIdPostu'])) {
    $IdPostu = $_POST['UsIdPostu']; }
 else header ('Location: index.php');
 
 $formularz=true;
 $polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie ma połączenia z bazą danych');

  if (isset($_POST['usun'])) {
    
    if($_POST['usun']=="tak") {
      $formularz=false;
      $IdPostu = $_POST['UsIdPostu'];
      $zapytanie = "delete from posty where idPostu='$IdPostu';";
      mysqli_query($polaczenie, $zapytanie) or die ('nie udało się wstawić rekordów do bazy');
      echo 'Post został usunięty <br /> <a href="index.php"> Wróć do strony głównej </a>';
      mysqli_close($polaczenie);
    }
    else {
      header ("Location: post.php?IdPostu=$IdPostu");
    }

  }

  else {
  
?>
  Czy chcesz usunąć ten post <span class="uwaga"> NA ZAWSZE </span>?
  
  <form method="POST" action="edit.php">
    <input type="radio" name="usun" id="usun" value="tak"> TAK 
    <input type="radio" name="usun" id="usun" value="nie" checked> NIE 
    <input type="hidden" name="UsIdPostu" id="UsIdPostu" value="<?php echo $IdPostu ?>" />
    <input type="submit" value="OK" />
  </form>

<?php
}

