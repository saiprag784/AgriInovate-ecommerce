<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriInovate | Innovating Agriculture</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="container navbar">
        <a href="index.php" class="logo">Agri<span>Inovate</span></a>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="#features">Features</a>
            <a href="login.php">Login</a>
            <a href="register.php" style="color: var(--primary); font-weight: 700;">Join Now</a>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container">
        <h1>Cultivating the Future of <span style="color: var(--primary);">Agriculture</span></h1>
        <p>Connecting farmers with innovative technology, expert insights, and sustainable practices to revolutionize the way we grow together.</p>
        <div style="display: flex; gap: 2rem; justify-content: center;">
            <a href="register.php" class="btn" style="width: auto;">Start Your Journey</a>
            <a href="login.php" class="btn" style="width: auto; background-color: var(--secondary); box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);">User Login</a>
        </div>
    </div>
</section>

<section class="features" id="features">
    <div class="container">
        <div class="feature-grid">
            <div class="feature-card">
                <i class="fas fa-seedling"></i>
                <h2>Smart Farming</h2>
                <p>Leverage modern technology to monitor and optimize your crop yields with precision and ease.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-handshake"></i>
                <h2>Market Access</h2>
                <p>Connect directly with buyers and markets to get the best value for your hard-earned produce.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-lightbulb"></i>
                <h2>Expert Insights</h2>
                <p>Access a wealth of knowledge from agricultural experts to improve your farming techniques.</p>
            </div>
        </div>
    </div>
</section>

<footer style="padding: 4rem 0; background: var(--white); border-top: 1px solid var(--gray-border); text-align: center;">
    <div class="container">
        <p style="font-size: 1.4rem; color: var(--text-muted);">&copy; 2024 AgriInovate. All rights reserved. Designed for Agricultural Excellence.</p>
    </div>
</footer>

</body>
</html>
