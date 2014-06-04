<?php 
require_once('includes/startsession.php'); 
require_once('includes/parametry.php'); 
$tytul_strony = "Edycja profilu";
require_once('includes/header.php');
?>

  <body>
  
   <div id="Strona">
            <div id="Naglowek">
           
                <?php require_once('includes/logo.php'); ?>
               
                <div id="ObszarLogowania">
                  <?php include_once('includes/obszarLogowania.php'); ?>
                </div>
            </div>

            <div id="Tresc">
              
               <div id="Lewa"> <?php include_once ('includes/lewa.php'); ?></div>
              
                <div id="Prawa"> 
                  <h1> <?php echo $tytul_strony ?> </h1>
                  <?php include_once ('includes/editprofil.php'); ?>
                </div>
                 


            </div>
   
	 <div id="stopka"> <?php include_once('includes/stopka.php')?> </div>
    </div>
  
  
  
  
  </body>
  
  </html>