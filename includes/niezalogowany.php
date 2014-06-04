 <?php echo 'Nie jesteś zalogowany!<br/>';
    $infoBlad='';
    $user_name='';
    $user_password='';
    if(!isset($_SESSION['idk']) && !isset($_SESSION['username'])) {
    
      if (isset($_POST['zaloguj']) && !empty($_POST['user_name']) && !empty($_POST['user_password'])) {
        $polaczenie=mysqli_connect(DB_HOST, DB_UZYT, DB_HAS, DB);
        $user_name=mysqli_real_escape_string($polaczenie, trim($_POST['user_name']));
        $user_password=mysqli_real_escape_string($polaczenie, trim($_POST['user_password']));
        $zapytanie="SELECT idk, username FROM uzytkownicy WHERE username='$user_name' and password=SHA('$user_password')";
        $rezultat = mysqli_query($polaczenie, $zapytanie);
        if (mysqli_num_rows($rezultat) == 1) {
          $wiersz = mysqli_fetch_array($rezultat);
          $_SESSION['idk'] = $wiersz['idk'];
          $_SESSION['username'] = $wiersz['username'];
				
				  if (isset($_POST['zapamietaj'])) {
            setcookie('idk', $wiersz['idk'], time()+(60*60*8));
            setcookie('username', $wiersz['username'], time()+(60*60*8));
          }
              header ('Location: index.php');
			
			
		
        }
		
        else {
          $infoBlad='<b>Złe dane logowania!</b>';
        }
			
        
		
      }
    
	
    }
    if (!isset($_SESSION['idk']) || !isset($_SESSION['username'])) {
      echo $infoBlad;
      ?>
      <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <label for="login"> Login: <input type="text" name="user_name" id="user_name" value="<?php echo $user_name ?>" />
        <label for="Hasło"> Hasło: <input type="password" name="user_password" id="user_password"/>
        <input type="checkbox" id="zapamietaj" name="zapamietaj" /> Pamiętaj logowanie
        <input type="submit" value="zaloguj" name="zaloguj" id="zaloguj" />
      </form><br />
      <?php
    }
    else {
      header ('Location: index.php');
    }
	
	?>
	
    <a href="zarejestruj.php"> Zarejestruj się </a> <br />
	

	