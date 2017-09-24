<?php
//require('config.php');
   session_start();
    $userSession = $_SESSION['login_user'];
   
   if(session_destroy()) 
   {
       header("Location: /myWebsite/home.php");
   }
?>
