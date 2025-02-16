<?php
session_start();
$isLoggedIn = isset($_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutie Pies</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>

<header class="header">
    <div class="headerCont">
        <div class="icons">
            <a href="#search">
                <img src="../images/search.png" alt="search" />
            </a>
            <a href="../HTML/checkout.html">
                <img src="../images/shopping-cart.png" alt="cart" />
            </a>


            <?php if ($isLoggedIn): ?>

                <a href="logout.php">
                    <img src="../images/logout.png" alt="logout" />
                </a>
            <?php else: ?>

                <a href="../HTML/page2.html">
                    <img src="../images/user.png" alt="login" />
                </a>
            <?php endif; ?>
        </div>

        <nav class="navigation">
            <ul>
                <li>
                    <a href="../HTML/order.html">Order Online</a>
                    <ul class="dropdown">
                        <li><a href="#cakes">Cakes</a></li>
                        <li><a href="#pies">Pies</a></li>
                        <li><a href="#cookies">Cookies</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#visit-us">Visit Us</a>
                    <ul class="dropdown">
                        <li><a href="#locations">Locations</a></li>
                        <li><a href="#hours">Hours</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#about-us">About Us</a>
                    <ul class="dropdown">
                        <li><a href="#team">Our Team</a></li>
                        <li><a href="#history">Our History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#new">New</a>
                    <ul class="dropdown">
                        <li><a href="#specials">Specials</a></li>
                        <li><a href="#events">Events</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div class="image-container">
    <img src="../images/cake.png" alt="Cake Image">
    <div class="text-overlay">
        <h1 style="font-family: Serif;">Let's eat cake!</h1>
        <p style="font-family: Monospace;">Time for a treat</p>
        <a href="../HTML/order.html" class="cta-button">Shop now!</a>
    </div>
    <div class="product-info">
        <h1>Our Products</h1>
        <p>Our bakery has been making Palestine’s favorite baked goods the old-fashioned way: from scratch, in small batches, and using the finest ingredients.</p>
        <a href="../HTML/order.html" class="view-button">View all!</a>
    </div>
</div>

<div class="row">
    <div class="column">
        <img src="../images/best-sellers.png" alt="Best sellers" style="width:100%">
        <figcaption>Sample packs</figcaption>
    </div>
    <div class="column">
        <img src="../images/brownies.png" alt="Brownies" style="width:100%">
        <figcaption>Brownies</figcaption>
    </div>
    <div class="column">
        <img src="../images/cakes.png" alt="Cakes" style="width:100%">
        <figcaption>Cakes</figcaption>
    </div>
    <div class="column">
        <img src="../images/cupcakes.png" alt="Cupcake" style="width:100%">
        <figcaption>Cupcakes</figcaption>
    </div>
    <div class="column">
        <img src="../images/cookies.png" alt="Cookies" style="width:100%" >
        <figcaption>Cookies</figcaption>
    </div>
</div>
<div class="logo">
    <img src="../images/bakery.png" alt="Cutie Pies Logo">
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Subscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="newsletter-container">
    <div class="newsletter-content">
        <h1>Join our Newsletter</h1>
        <p>Get the freshest Zaina&Shahd Bakery updates and offers right to your inbox! Plus, enjoy 10% off on your birthday when you share the date with us!</p>
        <input type="email" class="email-input" placeholder="ENTER YOUR EMAIL ADDRESS">
        <button type="submit" class="submit-button" onclick="subscribe()">→</button>
    </div>
</div>

<script>
    function subscribe() {
        const emailInput = document.querySelector('.email-input');
        const email = emailInput.value;

        if (email === "") {
            alert("Please enter your email address before subscribing!");
        } else {
            alert("Thank you for subscribing!");
            emailInput.value = ""; // Clear the input field after subscription
        }
    }
</script>
</body>
</html>

</div>
</body>
</html>
</html>
