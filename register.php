<?php   
require('configuration_details/config.php');

    // If the values are posted, insert them into the database.
if (isset($_POST) && !empty($_POST))
{
    $username2   = mysqli_real_escape_string($db,$_POST['username']);
    $email2      = mysqli_real_escape_string($db,$_POST['email']);
    $password2   = mysqli_real_escape_string($db,$_POST['password']);
    $repassword2 = mysqli_real_escape_string($db,$_POST['repassword']);
    
    $fileTypeImg   = true; 
    $passwordMatch = strcmp($password2,$repassword2);
    $failureMsg    = null;
    
    $file        = $_FILES['proPic']['tmp_name'];
    if($file != null)
    {   $image   = addslashes(file_get_contents($file));     
        $imgSize = getimagesize($file);
                                               
        if($imgSize == false){  $fileTypeImg = false;   }
    }
    else    {   $image = null;      }
    if( ($passwordMatch == 0) && ($fileTypeImg == true) )
    {
        $query= "INSERT INTO `users` (username, dp, email, password) 
                    VALUES ('$username2', '$image', '$email2','$password2');";
        $result = mysqli_query($db, $query);
        if($result) 
        {   $sucessMsg  = "User Created Successfully.";   
            header("location: login.php");
        }
        else{   $failureMsg = "User Registration Failed";     }
    }
    else            
    {   
        if(($passwordMatch != 0)   ) {  $failureMsg  = "Passwords don't match ";          }   
        if(($fileTypeImg   != true)) {  $failureMsg .= "Please select an image file";    }  
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="utf-8"><title>Sign Up</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/myStyles.css" type="text/css">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/myScripts.js" type="text/javascript"></script>
</head>
<body id="registerBody">
    <br/>
    <div class="container col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
    <form class="form-signin" method="POST" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Sign Up</h2>
<!-- shows failue (sucess) msgs -->
        <?php if(isset($sucessMsg)){ ?>
            <div class="alert alert-success" role="alert"> <?php echo $sucessMsg; ?> </div>
        <?php } ?>
        <?php if(isset($failureMsg)){ ?>
            <div class="alert alert-danger"  role="alert"> <?php echo $failureMsg; ?> </div>
        <?php } ?>

        <label for="inputUsername" class="sr-only">User Name :</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="User Name" required autofocus/>
        <label for="inputEmail" class="sr-only">Email address :</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus/>
        <label for="inputPassword" class="sr-only">Password :</label>
        <input type="password" name="password" id="inputPassword" class="form-control" 
               placeholder="Password" required autofocus/>
        <label for="checkPassword" class="sr-only">Re-Enter Password :</label>
        <input type="password" name="repassword" id="checkPassword" class="form-control" 
               placeholder="Re-enter Password" required autofocus/>
        <br/>
        
        <label for="image" class="sr-only"> Select Profile Pic : </label>
        <div class="input-group col-xs-12">
            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                <input id="dpName" type="text" class="form-control input-lg" disabled 
                       placeholder="Picture(Max:500kb)*required">
            <span id="browse" class="input-group-btn">
                <label id="image" class="btn btn-lg btn-primary input-lg btn-block browse" type="button">
                    <i class="glyphicon glyphicon-search"></i> Browse
                    <input id="proPic" name="proPic" type="file" class="hidden" required>
                </label>
            </span>
        </div>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="insertDB">Register</button> 
        <a      class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
        
    </form>
    </div>
</body>





