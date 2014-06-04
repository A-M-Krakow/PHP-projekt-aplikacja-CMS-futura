<?php
if (isset($_SESSION['idk']) || isset($_SESSION['username']));
else header ('Location: login.php');

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}

$formularz=true;

if (!empty($_FILES['foto']['tmp_name']) && isset($_POST['rozmiar'])) {

  
    if ($_FILES['foto']['size']<$_POST['rozmiar']) {
      
      if (is_image($_FILES['foto']['tmp_name'])) {
      
        $polaczenie = mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB) or die ('nie można połączyć z bazą danych');
        $los = rand(1,9999);
        $foto = $los . $_FILES['foto']['name'];
        $target=FOLD_OBR . $foto;
        
        
        $zapytanie = "SELECT foto from uzytkownicy where idk='$idk';";
        $rezultat = mysqli_query($polaczenie, $zapytanie);
      
        if (mysqli_num_rows($rezultat) == 1) {
          $wiersz = mysqli_fetch_assoc($rezultat);
          if (is_file(FOLD_OBR . $wiersz['foto']) && ($wiersz['foto']!='brak.jpg') ) {
            @unlink(FOLD_OBR . $wiersz['foto']);
          }
        }
        if (move_uploaded_file ($_FILES['foto']['tmp_name'],$target)) {
          
          $dodanie = "UPDATE Uzytkownicy SET foto='$foto' 	WHERE idk='$idk'";
          mysqli_query($polaczenie, $dodanie);
          $formularz=false;
          @unlink($_FILES['foto']['tmp_name']);	
          echo 'Zdjęcie zostało wysłane, <br />
          <a href="zobaczprofil.php?uzytkownik=' . $username . ' ">zobacz swój profil </a>';
				
        }
		
        else { echo 'Wystąpił błąd. <br /> Nie wysłano zdjęcia <br />  Spróbuj jeszcze raz!';
          @unlink($_FILES['foto']['tmp_name']);	
          $formularz = true; 
        }
      
        mysqli_close($polaczenie);
      }
      else {
        echo ('Przesłany plik nie jest zdjęciem!');
        $a = getimagesize($_FILES['foto']['tmp_name']);
        echo $a[2];
      }
    }
  
	
	else { 
    echo 'Przesłany plik ma zbyt duży rozmiar <br /> Spróbuj jeszcze raz!';
    echo $_FILES['foto']['size'];
    echo $_POST['rozmiar'];
    @unlink($_FILES['foto']['tmp_name']);	
    $formularz = true; 
  }
	
		
}



if ($formularz) {

?>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
	<label for="foto">Dodaj zdjęcie </label> <input type="file" name="foto" id="foto" /> </br> 
  <input type="hidden" name="rozmiar" id="rozmiar" value="1572864" />
	<input type="submit" name="dodajfoto" id="dodajfoto" value="Dodaj zdjęcie" />
</form>
Maksymalny rozmiar zdjęcia to 1.5MB <br /> 
Akceptowane formaty zdjęć: gif, jpeg, png, bmp<br /> 
<?php }

?>

