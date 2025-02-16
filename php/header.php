<?php
session_start();
$isLoggedIn = isset($_SESSION["user_id"]); // Check if user is logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutie Pies</title>
    <link rel="stylesheet" href="../css/headerstyle.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
<header class="header">
    <div class="headerCont">
        <div class="logo">
            <a href="../php/page1.php">
                <img src="../images/bakery.png" alt="Cutie Pies Logo">
            </a>
        </div>
        <div class="icons">
            <a href="#search">
                <img src="../images/search.png" alt="search" />
            </a>
            <a href="../HTML/checkout.html">
                <img src="../images/shopping-cart.png" alt="cart" />
            </a>

            <?php if ($isLoggedIn): ?>
                <!-- Show logout option if the user is logged in -->
                <a href="../php/logout.php" onclick="saveCartBeforeLogout(event)">
                    <img src="../images/logout.png" alt="logout" />
                </a>
            <?php else: ?>
                <!-- Show login/profile option if the user is not logged in -->
                <a href="../HTML/page2.html">
                    <img src="../images/user.png" alt="login" />
                </a>
            <?php endif; ?>
        </div>
        <div class="hamburger-menu" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="navigation" id="navMenu">
            <ul>
                <li>
                    <a href="#order-online">Order Online</a>
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
</body>
</html>

<script>
    // Ensure the script is loaded after the page content
    document.addEventListener("DOMContentLoaded", () => {
        // Highlight the active navigation link
        const navLinks = document.querySelectorAll("nav.navigation a");
        const currentPath = window.location.pathname;

        navLinks.forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add("active");
            }
        });

        // Initialize the hamburger menu toggle
        const menuToggle = document.querySelector(".hamburger-menu");
        const navMenu = document.getElementById("navMenu");
        menuToggle.addEventListener("click", () => {
            navMenu.classList.toggle("open");
        });
    });

    // Function to save the cart before logout
    function saveCartBeforeLogout(event) {
        event.preventDefault(); // Prevent immediate navigation

        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        fetch("http://localhost/Bakery/php/saveCart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ cart })
        })
            .then(response => {
                if (!response.ok) throw new Error("Failed to save cart.");
                return response.json();
            })
            .then(() => {
                console.log("Cart saved successfully.");
                window.location.href = event.target.closest("a").href; // Redirect after saving
            })
            .catch(error => {
                console.error("Error saving cart:", error);
                alert("An error occurred while saving your cart. Please try again.");
                window.location.href = event.target.closest("a").href; // Proceed with logout even on error
            });
    }

    // Function to toggle the menu on small screens
    function toggleMenu() {
        document.getElementById("navMenu").classList.toggle("open");
    }
</script>
