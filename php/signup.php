<?php
$host = "localhost";
$dbname = "bakery";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $email = trim($_POST["email"]);
    $birthday = trim($_POST["birthday"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($birthday) || empty($password) || empty($confirmPassword)) {
        die("All fields are required.");
    }

    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Combine first and last name into full name
    $fullName = $firstName . " " . $lastName;

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO Users (FullName, Email, Password, Birthday) VALUES (:fullName, :email, :password, :birthday)");
        $stmt->bindParam(":fullName", $fullName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":birthday", $birthday);

        $stmt->execute();

        echo "Account created successfully!";

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry for unique field
            echo "Email is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
