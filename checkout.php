<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['state'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout | AgriInovate</title>

   <link rel="stylesheet" href="style.css">
   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
   
<header class="header">
    <div class="container navbar">
        <a href="home.php" class="logo">Agri<span>Inovate</span></a>
        <nav class="nav-links">
            <a href="home.php">home</a>
            <a href="shop.php">shop</a>
            <a href="cart.php">cart</a>
            <a href="orders.php">orders</a>
            <a href="#">about</a>
        </nav>
        <div class="icons">
            <i class="fas fa-search"></i>
            <a href="update_profile.php"><i class="fas fa-user"></i></a>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_rows_number; ?>)</span></a>
            <a href="home.php?logout=<?php echo $user_id; ?>" style="font-size: 1.5rem; margin-left: 1rem; color: #ef4444;">Logout</a>
        </div>
    </div>
</header>

<section class="display-order">
   <div class="container">
      <?php  
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
               $grand_total += $total_price;
      ?>
      <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₹'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
      <div class="grand-total"> Grand Total : <span>₹<?php echo $grand_total; ?>/-</span> </div>
   </div>
</section>

<section class="checkout">
   <div class="container">
      <form action="" method="post">
         <h3>Place Your Order</h3>
         <div class="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" required placeholder="enter your name">
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="number" name="number" required placeholder="enter your number">
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" required placeholder="enter your email">
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="method">
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
                  <option value="paypal">paypal</option>
                  <option value="paytm">paytm</option>
               </select>
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="number" name="flat" required placeholder="e.g. flat no.">
            </div>
            <div class="inputBox">
               <span>address line 02 :</span>
               <input type="text" name="street" required placeholder="e.g. street name">
            </div>
            <div class="inputBox">
               <span>city :</span>
               <input type="text" name="city" required placeholder="e.g. mumbai">
            </div>
            <div class="inputBox">
               <span>state :</span>
               <input type="text" name="state" required placeholder="e.g. maharashtra">
            </div>
            <div class="inputBox">
               <span>country :</span>
               <input type="text" name="country" required placeholder="e.g. india">
            </div>
            <div class="inputBox">
               <span>pin code :</span>
               <input type="number" name="pin_code" required placeholder="e.g. 123456">
            </div>
         </div>
         <input type="submit" value="order now" class="btn" name="order_btn">
      </form>
   </div>
</section>

</body>
</html>
