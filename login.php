<?php
require('configuration_details/config.php');
session_start();
   if(isset($_POST) && !empty($_POST)) 
   {    $username3 = mysqli_real_escape_string($db,$_POST['username']);
        $password3 = mysqli_real_escape_string($db,$_POST['password']); 
      
        $query  = "SELECT dp, email FROM users WHERE username = '$username3' and password = '$password3';";
        $result = mysqli_query($db,$query);
        $row    = mysqli_fetch_array($result);
        $count  = mysqli_num_rows($result);

        //$query2 = "UPDATE users SET active = 1 WHERE username = '$username3' and password = '$password3';";
        //mysqli_query($db,$query2);
        
        if($count == 1) {    $_SESSION['login_user']  = $username3;
                             $_SESSION['profile_pic'] = $row['dp'];
                             header("location: home.php");
                        }
        else            {  $error = "Your User Name or Password is invalid";  }
   }
?>

<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="utf-8"><title>Login</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/myStyles.css" type="text/css">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
</head>
<body id="loginBody">
    <br/><br/><br/>
    <div class="container col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
    <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Login</h2>
        <?php if(isset($error)){ ?><div class="alert alert-danger"  role="alert"> <?php echo $error; ?> </div><?php } ?>
        <label for="inputUsername" class="sr-only">User Name :</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="User Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password :</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
        <hr/>
        <button class="btn btn-lg btn-primary btn-block" type="submit"      >Login</button>
        <a      class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
    </form>
    </div>
</body>