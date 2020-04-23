<?php
include('no-header.php');
require 'connect.php';
@session_start();
$userError=$passError='';
$myusername = $password ='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn,$_POST['un']);
    $password = mysqli_real_escape_string($conn,$_POST['pwd']);
}
if(isset($_POST['buttonLogin']) && $myusername!='' &&  $password!=''){
    $sql = "SELECT password FROM dbAuth WHERE uname = '$myusername'";
    $result = mysqli_query($conn,$sql);
      if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $hash = $row['password'];
       if(password_verify($password, $hash)){
        $_SESSION['username'] = $myusername;
        echo'<script> location.replace("index.php"); </script>';
       }else{
        $error = "Your Login Name or Password is invalid";
        echo "<p><center>$error</center></p>";  
       }
    }else {
       $error = "Your Login Name or Password is invalid";
       echo "<p><center>$error</center></p>";
    }
}else {
       $error = "Please fill the login details properly";
       echo "<p><center>$error</center></p>";
    }
?>
    <div class="container">
        <section class="my-col">
            <h2 class="text-center p-3">Login</h2>
            <div class="row">
                <div class="col-sm-4 p-4 my-3 ml-auto mr-auto border"> 
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation" method="post" id="loginForm" novalidate="novalidate">
                        <div class="form-group">
                          <input type="text" class="form-control" id="un" name="un" autocomplete="off" minlength='6' maxlength='8' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" onkeypress='validateUser(event)' placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" id="pwd" name="pwd" onkeypress='validatePassword(event)' minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[#!@$^=_/&.])(?=.*[A-Z]).{8,12}" placeholder="Enter password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="buttonLogin" class="btn btn-primary text-center">Submit</button>
                        </div>
                      </form>
                      <div class="p-4 my-3 text-center border">
                        Don't have an account? <a href="signup.php">Sign up</a>
                    </div>
                </div>
            </div>
        </section>   
    </div>
    
    </body>
</html>