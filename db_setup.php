<?php

include 'config.php';

// Create products table
$create_products = "CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Create cart table
$create_cart = "CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Create orders table
$create_orders = "CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Initial products
$insert_products = "INSERT INTO `products` (`name`, `price`, `image`, `category`) VALUES
('Hybrid Sunflower Seeds', '450', 'seeds.png', 'seeds'),
('Organic Wheat Seeds', '320', 'seeds.png', 'seeds'),
('NPK Fertilizer', '850', 'fertilizer.png', 'fertilizer'),
('Urea Fertilizer', '400', 'fertilizer.png', 'fertilizer'),
('Neem Oil Pesticide', '250', 'pesticides.png', 'pesticides'),
('Insecticide Spray', '600', 'pesticides.png', 'pesticides'),
('Gardening Tool Kit', '1200', 'tools.png', 'tools'),
('Heavy Duty Shovel', '750', 'tools.png', 'tools')
ON DUPLICATE KEY UPDATE name=name;";

if(mysqli_query($conn, $create_products) && mysqli_query($conn, $create_cart) && mysqli_query($conn, $create_orders)){
    mysqli_query($conn, $insert_products);
    echo "<h1>Database Updated Successfully!</h1>";
    echo "<p>All necessary tables (cart, products, orders) have been created and sample data added.</p>";
    echo "<a href='home.php'>Go back to Home</a>";
} else {
    echo "<h1>Error updating database: " . mysqli_error($conn) . "</h1>";
}

?>
