<?php   require('configuration_details/config.php');    ?>

<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="utf-8"><title>BLOG</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">    
    <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/myStyles.css" type="text/css">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/myScripts.js" type="text/javascript"></script>
</head>
    
<header><?php include('includes/header.php'); ?></header>
     
<body style="padding-top : 100px;" id="blogBody">
   
<?php 
if(isset($_POST) && !empty($_POST))
            {
                $blogId      = $_POST['publicComment'];
                $ComUsername = $_SESSION['login_user'];
                $com         = mysqli_real_escape_string($db,$_POST['posting']);
                $comDate     = date("Y-m-d");
            
                $query3  = "INSERT INTO `blogcomments` (blogid, username, comment, date) 
                VALUES ('$blogId','$ComUsername','$com','$comDate');";
            
                $result3 = mysqli_query($db,$query3);
            }    
?>
<div class="container" id="changeNav">
    <div id="blogRow" class="row">
        <?php
        /*displaying the blog posts on cards*/
        $query  = "SELECT id, name, date, image, content FROM blogposts;";
        $result = mysqli_query($db,$query);
        while($row = mysqli_fetch_array($result))  
        {
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="blogBorder">
                <h2  class="blogTitle card-header"><?php echo $row['name']; ?></h2>
                
                <?php echo '<img class="blogImage img-thumnail card-img-overlay"
                            src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'"/>  ';?>
                
                <div class="blogBox   card-block">
                <form method="POST" class="blogComments"><!-- form block level element acts as div -->
                <?php
                /*Hidden comment section of each blog (blogid or $row['id']) shown on button(checkbox) click*/
                    $cid = $row['id'];                                      
                    $query2 = "SELECT username, comment, date FROM blogcomments WHERE blogid = '$cid';";
                    $result2 = mysqli_query($db,$query2);
            
                    while($row2 = mysqli_fetch_array($result2))/*show previous comments*/
                    {
                        echo '<span class="glyphicon glyphicon-user"></span> ';
                        echo "<strong> ".$row2['username']."</strong> ";
                        echo "<sub> &nbsp; &nbsp; Posted - ".$row2['date']."</sub><br/>";
                        echo $row2['comment']."<br/><br/>";
                    }
                    echo '<label ><input name="publicComment" type="checkbox" class="commentCheck" required            value="'.$row['id'].'"/> &nbsp; <sup>Post a public comment</sup></label><br/>';
                    
                    echo '<input type="text" name="posting" ';
                        if(!isset($_SESSION['login_user']))
                        {   echo 'placeholder="login to comment" disabled required autofocus />';   }
                        else                               
                        {   echo 'placeholder="leave a comment"   enabled required autofocus />';   }
                    
                    echo '<button class="btn btn-primary postComment" type="submit" ';
                        if(!isset($_SESSION['login_user'])){   echo ' disabled> &nbsp; Post &nbsp; </button>';   }
                        else                               {   echo '  enabled> &nbsp; Post &nbsp; </button>';   }
            
                    echo '<br/><br/>';
                    
                ?>
                </form>
                    <p class="blogText  card-text"><?php echo $row['content']; ?></p>
                    
                    <small class="blogDate text-muted">Posted : <?php echo $row['date']; ?></small>
                    
                    <label class="btn btn-primary blogButton"><input class="blogCheck" type="checkbox">&nbsp; Comments &nbsp;</label>
                </div>
            </div>
        </div>
        <?php } ?>
        
    </div>
</div>    
    
</body>


