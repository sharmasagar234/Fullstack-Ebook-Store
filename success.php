<?php
include 'config.php';

$order_id = $_GET['order_id'] ?? '';

if(!$order_id){
    die("Invalid Order");
    }
    
    //    Cashfree API se verify
    
    $ch = curl_init("https://sandbox.cashfree.com/pg/orders/".$order_id); curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "x-client-id: ".$appId,
            "x-client-secret: ".$secretKey,
            "x-api-version: 2022-09-01"
        ]
        ]);
        
        $response = curl_exec($ch);
        $result = json_decode($response, true);
        
        //    Check payment status
if(isset($result['order_status']) && $result['order_status'] == "PAID"){
    
    //    Generate secure token
    $token = bin2hex(random_bytes(16));
    
    //    Update DB
    $stmt = $conn->prepare("UPDATE orders SET payment_status='SUCCESS', download_token=? WHERE order_id=?");
    $stmt->bind_param("ss", $token, $order_id);
    $stmt->execute();
    
    echo "<h2>Payment Successful   </h2>";
    echo "<a href='download.php?token=".$token."'>Download eBook</a>";
    
    } else {
        echo "<h2>Payment Not Completed </h2>";
        }
        ?>
<!-- $ch = curl_init("https://sandbox.cashfree.com/pg/orders/".$order_id);    -->

        