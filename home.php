<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>AgriInovate | Home</title>

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

<div class="home-hero">
    <div class="content">
        <h4>"JAY JAWAN, JAY KISSAN"</h4>
        <h1>FEEDING CRAVINGS, ONE <br> HARVEST AT A TIME</h1>
        <p>Sow the future, shop smart; quality seeds delivered to your doorstep. Grow with confidence, access premium seeds, fertilizer and pesticides all online.</p>
        <a href="#" class="btn">About Us</a>
    </div>
</div>

<section class="shop-category">
    <div class="container">
        <h1>SHOP BY CATEGORY</h1>
        <div class="category-flex">
            <div class="category-card">
                <img src="uploaded_img/images/seeds.png" alt="Seeds">
                <h2>SEEDS</h2>
                <p>Seeds are the reproductive structures of seed plants, containing a miniature plant (embryo) and stored food, all encased in a protective seed coat.</p>
                <a href="shop.php?category=seeds" class="category-btn">Seeds</a>
            </div>
            <div class="category-card">
                <img src="uploaded_img/images/fertilizer.png" alt="Fertilizer">
                <h2>FERTILIZER</h2>
                <p>Fertilizers provide the major nutrients (nitrogen, phosphorus and potassium) and important secondary elements that plants need.</p>
                <a href="shop.php?category=fertilizer" class="category-btn">Fertilizer</a>
            </div>
            <div class="category-card">
                <img src="uploaded_img/images/pesticides.png" alt="Pesticides">
                <h2>PESTICIDES</h2>
                <p>Pesticides kill or control forms of animal and plant life considered to be damage or be a nuisance in agriculture and domestic life.</p>
                <a href="shop.php?category=pesticides" class="category-btn">Pesticides</a>
            </div>
            <div class="category-card">
                <img src="uploaded_img/images/tools.png" alt="Tools">
                <h2>TOOLS</h2>
                <p>Farmers utilize a wide array of tools, to cultivate land, plants and harvest crops, including tractors, cultivators, harvesters and irrigation systems.</p>
                <a href="shop.php?category=tools" class="category-btn">Tools</a>
            </div>
        </div>
    </div>
</section>

</body>
</html>
