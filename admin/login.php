<?php
session_start();

if(isset($_POST['login'])){
    if($_POST['username']=="admin" && $_POST['password']=="1234"){
        $_SESSION['admin']=true;
        header("Location: index.php");
    } else {
        $error="Invalid login";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="login-box">
<h2>Admin Login</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
<input type="text" name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<button class="btn btn-primary" name="login">Login</button>
</form>
</div>