<table cellpadding="0"  class="post" >

<?php
 
while ($wiersz = mysqli_fetch_array($rezultat)) {

  ?>

		<tr  >
				<td class="tytul"><a href="post.php?IdPostu=<?php echo $wiersz['IdPostu'];?>"> <?php echo $wiersz['temat'] ?> </a> </br>
				<a style="font-size: 10px; font-face: arial;" href="posty.php?IdKategorii=<?php echo $wiersz['IdKategorii']; ?>"><?php echo $wiersz['nazwa']; ?></a></td><td style="vertical-align: bottom;">
						<?php 
                  if ((!empty($idk) && $idk==$wiersz['idk'])) {
            
            ?>
						<form  style="text-align: right"; action="edit.php" method="POST">
								<button type="submit"name="EdIdPostu" id="EdIdPostu"  value="<?php echo $wiersz['IdPostu'] ?>" style="font-size: 10px;"> edytuj</button>
								<button  type="submit"name="UsIdPostu" id="UsIdPostu"  value="<?php echo $wiersz['IdPostu'] ?>" style="font-size: 10px;"> usuń </button>
						</form>
						<?php      
                    }
               
                    ?>
				</td>
		</tr>
		<tr>
				<td colspan="3" class="trescpostu"><?php echo substr($wiersz['tresc'],0,512) . '<a href="post.php?IdPostu=' . $wiersz['IdPostu']. ' ">... <br />... czytaj dalej </a>'  ?> </td>
		</tr>
		<tr>
				<td colspan="3" class="podpis"><?php echo $wiersz['data_utw'] ?> </br>
						autor: <a href="zobaczprofil.php?uzytkownik=<?php echo $wiersz['username'] ?>"> <?php echo $wiersz['username'] ?> </a></td>
		</tr>
		
		<?php
      
    }
    ?>
</table>
