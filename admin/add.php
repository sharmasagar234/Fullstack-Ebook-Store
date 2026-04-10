<?php
include '../config.php';
include 'auth.php';

if(isset($_POST['add'])){

    $title = $_POST['title'];
    $price = $_POST['price'];

    //  PDF
    $pdfName = $_FILES['file']['name'];
    $pdfTmp  = $_FILES['file']['tmp_name'];

    //  Image
    $imgName = $_FILES['image']['name'];
    $imgTmp  = $_FILES['image']['tmp_name'];

    //    Rename (important)
    $pdfNew = time() . "_" . $pdfName;
    $imgNew = time() . "_" . $imgName;

    // Move files
    move_uploaded_file($pdfTmp, "../ebooks/files/" . $pdfNew);
    move_uploaded_file($imgTmp, "../ebooks/images/" . $imgNew);

    //    Insert DB
    $stmt = $conn->prepare("INSERT INTO ebooks(title, price, file, image) VALUES(?,?,?,?)");
    $stmt->bind_param("siss", $title, $price, $pdfNew, $imgNew);
    $stmt->execute();

    header("Location: index.php?msg=added");
}
?>

<?php include 'header.php'; ?>

<h2>Add eBook</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Title" required>
<input type="number" name="price" placeholder="Price" required>

<label>Upload PDF</label>
<input type="file" name="file" accept="application/pdf" required>

<label>Upload Thumbnail</label>
<input type="file" name="image" accept="image/*" required>

<button class="btn btn-success" name="add">Add eBook</button>

</form>

<?php include 'footer.php'; ?>