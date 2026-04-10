<?php
include 'config.php';

//  Get ebook id safely
$id = intval($_GET['id']);

// Fetch ebook
$stmt = $conn->prepare("SELECT * FROM ebooks WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if(!$data){
    die("Invalid eBook");
}

// Create order id
$orderId = "ORD_" . time() . rand(100,999);

// Save order in DB
$status = "PENDING";
$stmt = $conn->prepare("INSERT INTO orders(order_id, ebook_id, payment_status) VALUES(?,?,?)");
$stmt->bind_param("sis", $orderId, $id, $status);
$stmt->execute();

// Payload
$payload = [
    "order_id" => $orderId,
    "order_amount" => $data['price'],
    "order_currency" => "INR",
    "customer_details" => [
        "customer_id" => "CUST_" . rand(1000,9999),
        "customer_name" => "Test User",
        "customer_email" => "user@email.com",
        "customer_phone" => "9999999999"
    ],
    "order_meta" => [
    "return_url" => "http://localhost/ebook/success.php?order_id={order_id}"

    ]
];

// CURL API call
// $ch = curl_init("https://api.cashfree.com/pg/orders");
$ch = curl_init("https://sandbox.cashfree.com/pg/orders");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "x-client-id: ".$appId,
        "x-client-secret: ".$secretKey,
        "x-api-version: 2022-09-01",
        "Content-Type: application/json"
    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$response = curl_exec($ch);

if(curl_errno($ch)){
    die("Curl Error: " . curl_error($ch));
}

$result = json_decode($response, true);

//  Redirect to checkout
if(isset($result['payment_session_id'])){
    header("Location: pay.php?session_id=".$result['payment_session_id']);
    exit;
} else {
    echo "Payment failed";
    echo "<pre>";
    print_r($result);
}
?>