<?php
include('productDb.php');
$status="";
if(isset($_POST['buyNow'])){
if(!isset($_SESSION['username']) && $_SESSION['username']==""){
    echo'<script> location.replace("login.php"); </script>';
}
else{
    if (isset($_POST['code']) && $_POST['code']!=""){
        $code = $_POST['code'];
        $result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $code = $row['code'];
        $price = $row['price'];
        $image = $row['image'];
        
        $cartArray = array(
            $code=>array(
            'name'=>$name,
            'code'=>$code,
            'price'=>$price,
            'quantity'=>1,
            'image'=>$image)
        );
        
        if(empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'>Product is added to your cart!</div>";
        }else{
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if(in_array($code,$array_keys)) {
                $status = "<div class='box' style='color:red;'>
                Product is already added to your cart!</div>";	
            } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
            $status = "<div class='box'>Product is added to your cart!</div>";
            }
            }
        }
}
}
?>
        <div class="container">
            <section>
                <div class="row">
                    <div class="col-sm-10 my-3 mx-auto text-center">
                        <h2>Our Cakes</h2>
                    </div>
                </div> 

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="message_box" style="margin:10px 0px;">
                            <?php echo $status; ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="cart_div">
                            <a href="cart.php"><img src="img/cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
                        </div>
                    </div>
                </div>
<?php
}

$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='img/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' name='buyNow' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }
mysqli_close($con);
?>

<div style="clear:both;"></div>
</div>