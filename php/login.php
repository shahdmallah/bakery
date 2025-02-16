<?php
session_start();
$host = "localhost";
$dbname = "bakery";
$username = "root";
$password = "";

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate the inputs
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Check if email and password are provided
        if (empty($email) || empty($password)) {
            die("Email and password are required.");
        }

        // Query to check user email
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and password is correct
            if ($user && password_verify($password, $user['Password'])) {
                // Start session and store user details
                $_SESSION["user_id"] = $user["UserID"];
                $_SESSION["user_email"] = $user["Email"];
                $_SESSION["user_fullname"] = $user["FullName"];

                // Redirect to dashboard or homepage
                header("Location: page1.php");
                exit;
            } else {
                // If email or password is incorrect
                echo "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        die("Email and password are required.");
    }
}
?>
