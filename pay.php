<?php
$sessionId = $_GET['session_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pay Now</title>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
</head>
<body>

<h2>Redirecting to Payment...</h2>

<script>
    
const cashfree = Cashfree({
    mode: "sandbox" //sandbox 
});

cashfree.checkout({
    paymentSessionId: "<?php echo $sessionId; ?>",
    redirectTarget: "_self",
    onSuccess: function(data) {
        //    Force redirect after payment
        window.location.href = "success.php?order_id=" + data.order.order_id;
    },
    onFailure: function(data) {
        alert("Payment Failed ");
    }
});
</script>


</body>
</html>
