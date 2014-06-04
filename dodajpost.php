<?php 
require_once('includes/startsession.php'); 
require_once('includes/parametry.php'); 
$tytul_strony = "Dodaj artykuł";
require_once('includes/header.php');
?>

  <body>
  
   <div id="Strona">
            <div id="Naglowek">
                <?php require_once('includes/logo.php'); ?>
                <div id="ObszarLogowania">
                  <?php require_once('includes/obszarLogowania.php'); ?>
                </div>
            </div>

            <div id="Tresc">
              
               <div id="Lewa"> <?php require_once ('includes/lewa.php'); ?></div>
              
                <div id="Prawa"> 
                  <h1> <?php echo $tytul_strony ?> </h1>
                  <?php require_once ('includes/dodajpost.php'); ?>
                </div>
                 


            </div>
  
	 <div id="stopka"> <?php include_once('includes/stopka.php')?> </div>
    </div>
  
  
  
  
  </body>
  
  </html>