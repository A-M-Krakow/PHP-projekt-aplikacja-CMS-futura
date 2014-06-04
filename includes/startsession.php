<?php
session_start();
  if (!isset($_SESSION['idk'])) {
    if(isset($_COOKIE['idk']) && isset($_COOKIE['username'])) {
    $_SESSION['idk']=$_COOKIE['idk'];
    $_SESSION['username'] = $_COOKIE['username'];
    }
    }
    ?>