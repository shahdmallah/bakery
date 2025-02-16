<?php
header('Content-Type: application/json');

// Use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files (ensure these paths are correct based on your setup)
require 'C:\xampp\htdocs\Bakery\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\Bakery\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\Bakery\PHPMailer-master\src\SMTP.php';

try {
    // Retrieve the JSON payload
    $inputJSON = file_get_contents('php://input');
    $orderDetails = json_decode($inputJSON, true);

    // Validate the data
    if (!$orderDetails || !isset($orderDetails['cart']) || empty($orderDetails['cart'])) {
        throw new Exception("Invalid order data received.");
    }

    $address = $orderDetails['address'];
    $orderNote = $orderDetails['orderNote'] ?? 'No notes provided';
    $deliveryDate = $orderDetails['deliveryDate'];
    $total = $orderDetails['total'];
    $cart = $orderDetails['cart'];

    // Save the order to the database (example)
    // Here you'd normally use a database query to insert the order
    // For example:
    // $orderId = saveOrderToDatabase($address, $deliveryDate, $total, $cart);

    $orderId = rand(1000, 9999); // Mock order ID for testing

    // Generate order summary for email
    $orderSummary = "Order ID: $orderId\n";
    $orderSummary .= "Delivery Address: $address\n";
    $orderSummary .= "Order Note: $orderNote\n";
    $orderSummary .= "Delivery Date: $deliveryDate\n";
    $orderSummary .= "Order Items:\n";

    foreach ($cart as $item) {
        $subtotal = $item['quantity'] * $item['price'];
        $orderSummary .= "- " . $item['name'] . ": " . $item['quantity'] . " x $" . number_format($item['price'], 2) . " = $" . number_format($subtotal, 2) . "\n";
    }

    $orderSummary .= "\nTotal: $" . number_format($total, 2);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Set up the SMTP server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'smallah60@gmail.com';  // Your SMTP username
    $mail->Password = 'wpoh bdfu uymo svdh';  // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;  // Typically for TLS

    // Sender's email
    $mail->setFrom('smallah60@gmail.com', 'Bakery System');

    // Recipient's email
    $mail->addAddress('shahdrayeq@gmail.com');

    // Content of the email
    $mail->isHTML(false);  // Set to plain text email
    $mail->Subject = "New Order - Order ID: $orderId";
    $mail->Body = $orderSummary;

    // Send the email
    $mail->send();

    // Respond with success
    echo json_encode(['success' => true, 'data' => ['order_id' => $orderId]]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => "Order placed but email could not be sent. Error: {$mail->ErrorInfo}"]);
}
?>
