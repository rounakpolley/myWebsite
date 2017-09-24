<?php
//include('includes/session.php');  //if login is mandetory to use the page
session_start();                    //else start a session
$page = null;
$currentPage = $_SERVER['PHP_SELF'];
if($currentPage == '/myWebsite/home.php')   $page = 1;
if($currentPage == '/myWebsite/about.php')  $page = 2;
if($currentPage == '/myWebsite/blog.php')   $page = 3;
// /myWebsite/home.php
// /myWebsite/about.php
// /myWebsite/blog.php
?>

<nav id="myWebsiteNav" class="navbar navbar-default navbar-fixed-top">
    <div id="myNav" class="container col-xs-12 col-md-offset-1 col-md-10">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-                  expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" >
                <img id="myWebsiteLogo" src="resources/logo.png" alt="Website logo" >
            </a>
        </div>
        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="navLi navOptions
                <?php if($page == 1) echo 'navActive';?> ">
                <a href="/myWebsite/home.php" ><span>HOME</span></a></li>
            <li class="navLi navOptions
                <?php if($page == 2) echo 'navActive';?> ">
                <a href="/myWebsite/about.php"><span>ABOUT</span></a></li>
            <li class="navLi navOptions
                <?php if($page == 3) echo 'navActive';?> ">
                <a href="/myWebsite/blog.php" ><span>BLOG</span></a></li>
              <!--<input type="text" disabled placeholder="">-->
                <?php 
                    if(!isset($_SESSION['login_user'])) 
                    {  
                        echo '<li class="navLi"><img id="navImg" src="/myWebsite/resources/NoDp.png" 
                                alt="default profile image"/></li>
                              <li class="navLi" id="navUsers"><a><span>&nbsp; Guest &nbsp; User &nbsp;</a></li>';
                    }
                    else
                    {  if(strlen($_SESSION['login_user'])>15)
                        {
                            $fullUser  = $_SESSION['login_user'];
                            $shortUser = substr($fullUser,0,10).'..';
                            
                        echo '<li class="navLi"><img id="navImg" class="img-thumnail"
                               src="data:image/jpeg;base64,'.base64_encode($_SESSION['profile_pic']).' "/></li>
                              <li class="navLi" id="navUsers"><a><span> '.$shortUser.' </span></a></li>';
                        }
                       else
                       {
                       echo '<li class="navLi"><img id="navImg" class="img-thumnail"
                               src="data:image/jpeg;base64,'.base64_encode($_SESSION['profile_pic']).' "/></li>
                              <li class="navLi" id="navUsers"><a><span> '.$_SESSION['login_user'].' </span></a></li>';    
                       }
                    }
                ?>
            <li>
                <?php if(!isset($_SESSION['login_user'])){?>
                    <a id="navButton" type="button" class="btn btn-default navbar-btn" href="/myWebsite/login.php" >
                        LOGIN</a>
                <?php }?>
                <?php if( isset($_SESSION['login_user'])){?>
                    <a id="navButton" type="button" class="btn btn-default navbar-btn" href="/myWebsite/includes/logout.php" >
                        LOGOUT</a>
                <?php }?>
            </li>
          </ul>
        </div>
        
    </div>
</nav>