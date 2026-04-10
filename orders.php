<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders | AgriInovate</title>

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

<section class="placed-orders">
   <div class="container">
      <h1 class="title">Placed Orders</h1>

      <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>₹<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'tomato'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty" style="grid-column: 1/-1; padding: 5rem; font-size: 2rem; color: var(--text-muted); text-align: center;">no orders placed yet!</p>';
      }
      ?>
      </div>
   </div>
</section>

</body>
</html>
