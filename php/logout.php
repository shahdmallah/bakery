<?php

session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out</title>
    <script>
        localStorage.removeItem("cart");
        window.location.href = "../HTML/page2.html";
    </script>
</head>
<body>
Logging out, please wait...
</body>
</html>
