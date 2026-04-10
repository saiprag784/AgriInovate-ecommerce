<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart | AgriInovate</title>

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

<section class="shopping-cart">
   <div class="container">
      <h1 class="title">Products in your Cart</h1>

      <div class="box-container">
         <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
         ?>
         <div class="box">
            <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('remove this from cart?');"></a>
            <img src="uploaded_img/images/<?php echo $fetch_cart['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_cart['name']; ?></div>
            <div class="price">₹<?php echo $fetch_cart['price']; ?>/-</div>
            <form action="" method="post">
               <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
               <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" class="qty">
               <input type="submit" name="update_cart" value="update" class="btn" style="background-color: var(--secondary); border-radius: 5px; padding: 0.8rem 2rem;">
            </form>
            <div class="sub-total"> Sub Total : <span>₹<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
         </div>
         <?php
            $grand_total += $sub_total;
               }
            }else{
               echo '<p class="empty" style="grid-column: 1/-1; padding: 5rem; font-size: 2rem; color: var(--text-muted); text-align: center;">your cart is empty</p>';
            }
         ?>
      </div>

      <div class="cart-total">
         <p>Grand Total : <span>₹<?php echo $grand_total; ?>/-</span></p>
         <div style="display: flex; gap: 2rem; justify-content: center;">
            <a href="shop.php" class="btn" style="background-color: var(--secondary);">Continue Shopping</a>
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">Delete All</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
         </div>
      </div>
   </div>
</section>

</body>
</html>
