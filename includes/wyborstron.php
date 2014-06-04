
<?php  


if ($iloscStron >1) {

echo 'Strona  <select name="strona" id="strona">';

    for ($i=1; $i<=$iloscStron; $i++) { ?>
    
    <option value="<?php echo $i ?>"<?php if ($i== $strona) echo 'selected' ?> > <?php echo $i ?> </option>
    <?php
     }
       
    ?> 
        </select> / <?php 
        echo $iloscStron ;
        echo '<input type="submit" value="przejdź" />';
      
        
        }