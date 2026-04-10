<?php
include '../config.php';

if(isset($_POST['upload'])){
    $title = $_POST['title'];
    $price = $_POST['price'];

    $file = $_FILES['file']['name'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['file']['tmp_name'], "../ebooks/".$file);
    move_uploaded_file($_FILES['image']['tmp_name'], "../ebooks/".$image);

    $conn->query("INSERT INTO ebooks(title, price, file, image) 
    VALUES('$title','$price','$file','$image')");

    echo "Uploaded!";
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title"><br>
    <input type="number" name="price" placeholder="Price"><br>
    
    <label>eBook File:</label>
    <input type="file" name="file"><br>
    
    <label>Cover Image:</label>
    <input type="file" name="image"><br>

    <button name="upload">Upload</button>
</form>