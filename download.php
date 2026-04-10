<?php
include 'config.php';

$token = $_GET['token'] ?? '';

if(!$token){
    die("Invalid access");
}

//    Check token
$stmt = $conn->prepare("SELECT * FROM orders WHERE download_token=? AND payment_status='SUCCESS'");
$stmt->bind_param("s", $token);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if(!$order){
    die("Unauthorized access ❌");
}

//    Get ebook
$stmt = $conn->prepare("SELECT * FROM ebooks WHERE id=?");
$stmt->bind_param("i", $order['ebook_id']);
$stmt->execute();
$ebook = $stmt->get_result()->fetch_assoc();

$file = "ebooks/files/".$ebook['file'];

if(file_exists($file)){

    //  Optional: One-time download
    $conn->query("UPDATE orders SET download_token=NULL WHERE order_id='".$order['order_id']."'");

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$ebook['title'].'.pdf"');
    readfile($file);
    exit;

} else {
    echo "File not found";
}
?>