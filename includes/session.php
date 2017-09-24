<?php
session_start();
//if login is mandetory to use the page    
if(!isset($_SESSION['login_user']))
{
    header("location: login.php");
}


//use json to store session in local storage !!! then auto login
?>