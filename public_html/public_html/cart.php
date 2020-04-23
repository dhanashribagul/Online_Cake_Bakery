<?php
include('header.php');
require 'connect.php';
$status="";
if (isset($_SESSION["shopping_cart"]) && isset($_SESSION["username"]) && !empty($_SESSION["shopping_cart"])){
    if (isset($_POST['action']) && $_POST['action']=="remove"){
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
                if($_POST["code"] == $key){
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='box' style='color:red;'>
                Product is removed from your cart!</div>";
                }
                if(empty($_SESSION["shopping_cart"]))
                unset($_SESSION["shopping_cart"]);
                    }		
                }
        }
        
        if (isset($_POST['action']) && $_POST['action']=="change"){
          foreach($_SESSION["shopping_cart"] as &$value){
            if($value['code'] === $_POST["code"]){
                $value['quantity'] = $_POST["quantity"];
                break; 
            }
        }
        }
        
        if (isset($_POST['checkoutDetails'])){
            $name=$email=$phone=$address=$comment='';
            function flash($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $nErr=$emErr=$pErr=$address='';
            $name=$email=$phone=$address=$comment='';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = flash($_POST['name']);
            $email = flash($_POST['email']);
            $phone = flash($_POST['phone']); 
           $address = flash($_POST['address']);
            $comment = flash($_POST['comment']); 
            }else{}
            if($name!='' && $email!='' && $phone!='' && $address!=''){
                  $sql = "INSERT INTO userinfo (name,email,mobile,address,comment) VALUES ('".$name."','".$email."','".$phone."', '".$address."', '".$comment."')";
                if ($conn->query($sql) === TRUE) {
                    unset($_SESSION['shopping_cart']);
                    echo'<script> location.replace("checkout.php"); </script>';
                } else {
                    $error= "Error: Something went wrong";
                }
                    $conn->close();
            }else{
               $error= "Error: Please fill all required fields in Form"; 
            }
        }else{
     // echo'<script> location.replace("index.php"); </script>';
  }
  }else{
     echo'<script> location.replace("index.php"); </script>';
  }
?>
<div class="container">
            <section>
                <div class="row">
                    <div class="col-sm-10 my-3 mx-auto text-center">
                        <h2>Your Shopping Cart</h2>
                    </div>
                </div>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php">
<img src="img/cart-icon.png" /> Cart
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><img src="img/<?php echo $product["image"]; ?>" width="50" height="40" /></td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<div class="container">
        <section>
            <div class="row">
                <?php 
                if(isset($_SESSION['username']) && $_SESSION['username']!='' && !isset($_POST['checkoutDetails'])){
                    $user = $_SESSION['username'];
                    $sql = "SELECT * FROM dbAuth WHERE uname = '$user'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                        $name = $row['fname'];
                        $email = $row['email'];
                        $phone = $row['mob'];
                        $address = $row['addr1'];
                    mysqli_close($conn);   
                }
                
                if(!empty($_SESSION["shopping_cart"])){
                ?>
                <div class="col-sm-8 p-4 my-3 mx-auto border"> 
                    <h2 class="text-center">Order Now</h2>
                    <div><?php if(isset($error) && $error!=''){echo $error;} ?></div>
                    <form method="post" class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" minlength='8' maxlength='20' onkeypress='validateName(event)' autocomplete="off" value="<?php echo $name?>" id="name" name="name" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  id="email"  autocomplete="off" onkeypress='validateEmail(event)' value="<?php echo $email?>" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="phone" name="phone" maxlength="10" minlength="10" autocomplete="off" onkeypress='validateNumber(event)' value="<?php echo $phone?>" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" onkeypress='validateAddress(event)' minlength="10" maxlength="20" autocomplete="off" id="address" name="address" value="<?php echo $address?>" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="comment" minlength="3" maxlength="150" name="comment" onkeypress='validateComment(event)' placeholder="Further Details - Upto 150 characters allowed..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" name="checkoutDetails" class="btn btn-primary text-center">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php 
                }else{
                    
                }
                ?>
            </div>
        </section>   
    </div>
</div>
</body>
</html>