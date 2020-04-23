<?php
	session_start();
	$page = basename($_SERVER['PHP_SELF']);
	if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['username']);
    unset($_SESSION['shopping_cart']);
    echo'<script> location.replace("index.php"); </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
     <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'none'; img-src 'self';
          script-src 'self'; style-src 'self'">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" type='text/css' media='all'>
    <link rel="stylesheet" href="css/main.css" rel="stylesheet" type='text/css' media='all'>
    <link href="css/font-awesome.min.css" rel="stylesheet" type='text/css' media='all'>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>
 
     <script src="js/script.js"></script> 
  
</head>
  <body>

    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a href="#" class="navbar-brand">
                <img src="img/logo.png" class="img-logo" alt="Cake Bakery">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="index.php" <?php if($page == 'index.php'){ echo ' class="nav-item nav-link active"';}?> class="nav-item nav-link" style="font-weight:bold">Home</a>
                </div>
                <div class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['username']) AND $_SESSION['username']!=''){
                            echo '
                            <a href="#" class="nav-item nav-link active"><b>Welcome,</b>'.$_SESSION['username'].'</a>
                            <a href="index.php?action=logout" class="nav-item nav-link active" style="font-weight:bold"><i class="fa fa-power-off" aria-hidden="true"></i></a>';
                            }
                            else{
                            echo ' <a href="login.php" class="nav-item nav-link" style="color:blue" >Login</a>
                            <a href="signup.php" class="nav-item nav-link" style="color:blue">Signup</a>';
                        }?>
               </div>
            </div>
        </nav>
    </header>