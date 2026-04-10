<?php
$order_id = $_GET['order_id'] ?? '';

if(!$order_id){
    die("Invalid Order");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Completed</title>
</head>
<body style="text-align:center; font-family: Arial;">

<h2>Payment Completed   </h2>

<p>Redirecting to download page...</p>

<!--  Auto Redirect -->
<script>
setTimeout(function(){
    window.location.href = "success.php?order_id=<?php echo $order_id; ?>";
}, 3000);
</script>

<!-- Manual Button -->
<p>If not redirected automatically, click below:</p>

<a href="success.php?order_id=<?php echo $order_id; ?>" 
   style="background:green; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">
    👉 Download eBook
</a>

</body>
</html>