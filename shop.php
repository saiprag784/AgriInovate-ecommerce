<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop | AgriInovate</title>

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

<section class="products">
   <div class="container">
      <h1 class="title">Latest Products</h1>

      <div class="product-grid">

         <?php
            $category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
            if($category != ''){
               $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category = '$category'") or die('query failed');
            }else{
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            }

            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" class="product-card">
            <img src="uploaded_img/images/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty" style="grid-column: 1/-1; padding: 5rem; font-size: 2rem; color: var(--text-muted);">No products added yet in this category!</p>';
         }
         ?>
      </div>
   </div>
</section>

</body>
</html>
