<?php
include('no-header.php');
require 'connect.php';
$userErr=$passErr=$fErr=$ad1Err=$emErr=$phErr='';
$user=$pass=$f=$ad1=$em=$ph='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(empty($_POST["username"])){
   $userErr = "<div class='text-danger'>*UserName is required</div>";
}else{
   $user = flash($_POST['username']); 
}
if(empty($_POST["pwd"])){
    $passErr = "<div class='text-danger'>*Password is required</div>";
}else{
   $pass = flash(password_hash($_POST['pwd'], PASSWORD_BCRYPT));
}
if(empty($_POST["name"])){
    $fErr = "<div class='text-danger'>*Name is required</div>";
}else{
   $f = flash($_POST['name']);
}
if(empty($_POST["address"])){
    $ad1Err = "<div class='text-danger'>*Address is required</div>";
}else{
   $ad1 = flash($_POST['address']);
}
if(empty($_POST["email"])){
    $emErr="<div class='text-danger'>*Email is required</div>";
}else{
  $em = flash($_POST['email']);
}
if(empty($_POST["phone"])){
   $phErr ="<div class='text-danger'>*Phone is required</div>";
}else{
   $ph = flash($_POST['phone']); 
}
}else{
}
function flash($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if(isset($_POST["submitSave"]) && isset($_POST["username"]) && ($_POST["username"])!='' && isset($_POST["pwd"]) && ($_POST["pwd"])!='' && isset($_POST["name"]) && ($_POST["name"])!='' && isset($_POST["address"]) && ($_POST["address"])!='' && isset($_POST["email"]) && ($_POST["email"])!='' && isset($_POST["phone"]) && ($_POST["phone"])!=''){
    $sqlSel = "SELECT uname FROM dbAuth WHERE uname = '$user'";
    $result = mysqli_query($conn,$sqlSel);
    $count = mysqli_num_rows($result);
    if($count!=0){
        echo "Username is already available"; 
        $conn->close();
    }
    else{
        $sqlSel = "SELECT email FROM dbAuth WHERE email = '$em'";
        $result = mysqli_query($conn,$sqlSel);
        $count = mysqli_num_rows($result);
        if($count!=0){
            echo "Email-id is already available"; 
            $conn->close();
        }else{
            $sql = "INSERT INTO dbAuth (uname,password,fname,addr1,email,mob) VALUES ('".$user."','".$pass."','".$f."', '".$ad1."', '".$em."', '".$ph."')";
            if ($conn->query($sql) === TRUE) {
                echo'<script> location.replace("login.php"); </script>';
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "Error: Something went wrong";
            }
            $conn->close();
        }
    }
}
?>

  <div class="container">
    <section>
        <div class="row">
            <div class="col-sm-8 p-4 my-3 mx-auto border">
            <div class="p-4 my-3 text-center border">
                        Already have an Account? <a href="login.php">Login</a>
                    </div> 
                <h2 class="text-center p-3">Sign Up</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="needs-validation" name="form1" id="signupForm" novalidate="novalidate">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" minlength='8' maxlength='20' onkeypress='validateName(event)' autocomplete="off" name="name" placeholder="Your Name" required>
                                <span class="error text-danger" id="fErr"><?php echo $fErr;?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" autocomplete="off" name="username" minlength='6' maxlength='8' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" onkeypress='validateUser(event)' placeholder="Username" required>
                                 <span class="error text-danger" id="userErr"><?php echo $userErr;?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="password" class="form-control" id="pwd" autocomplete="off" name="pwd" onkeypress='validatePassword(event)' minlength="8" maxlength="12" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[#!@$^=_/&.])(?=.*[A-Z]).{8,12}"
  title="Must contain at least one  number and one uppercase and lowercase letter and special character, and at least 8 or more characters" required>
                                 <span class="error text-danger" id="passErr"><?php echo $passErr;?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" autocomplete="off" name="email" onkeypress='validateEmail(event)' placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                 <span class="error text-danger" id="emErr"><?php echo $emErr;?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="phone"  autocomplete="off" name="phone" onkeypress='validateNumber(event)' placeholder="Phone" maxlength="10" minlength="10" required>
                                 <span class="error text-danger" id="phErr"><?php echo $phErr;?></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control"  onkeypress='validateAddress(event)' minlength="10" maxlength="50" id="address" autocomplete="off" name="address" placeholder="Address" required>
                                 <span class="error text-danger" id="ad1Err"><?php echo $ad1Err;?></span>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" name="submitSave" class="btn btn-primary text-center">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>   
</div>
</body>
</html>