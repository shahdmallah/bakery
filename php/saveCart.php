<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakery";

// Establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'] ?? null; // Get the logged-in user's ID
    $cart = json_decode(file_get_contents('php://input'), true); // Decode the cart data

    if ($userId && $cart) {
        // Clear previous cart items before saving the new ones (if needed)
        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);

        foreach ($cart as $item) {
            // Save each item in the database
            $stmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_name, product_price, product_image, quantity) 
                                   VALUES (:user_id, :name, :price, :image, :quantity)");
            $stmt->execute([
                ':user_id' => $userId,
                ':name' => $item['name'],
                ':price' => $item['price'],
                ':image' => $item['image'],
                ':quantity' => $item['quantity']
            ]);
        }

        echo json_encode(["success" => true]); // Respond with success
    } else {
        echo json_encode(["error" => "Invalid data"]); // Respond with error
    }
}
?>

