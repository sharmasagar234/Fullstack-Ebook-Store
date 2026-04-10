<?php 
include '../config.php';

//    ID get karo
$id = intval($_GET['id']);

//    Data fetch karo
$stmt = $conn->prepare("SELECT * FROM ebooks WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

//  Agar data nahi mila
if(!$data){
    die("Invalid eBook ID");
}

//    Update logic
if(isset($_POST['update'])){
    
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Image upload (optional)
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../ebooks/images/".$image);
    } else {
        $image = $data['image']; // old image
    }

    $stmt = $conn->prepare("UPDATE ebooks SET title=?, price=?, image=? WHERE id=?");
    $stmt->bind_param("sdsi", $title, $price, $image, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit eBook</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4">

<h3>Edit eBook</h3>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" value="<?php echo $data['title']; ?>" class="form-control mb-3">

<label>Price</label>
<input type="number" name="price" value="<?php echo $data['price']; ?>" class="form-control mb-3">

<label>Current Image</label><br>
<img src="../ebooks/images/<?php echo $data['image']; ?>" width="120" class="mb-3"><br>

<label>Change Image</label>
<input type="file" name="image" class="form-control mb-3">

<button name="update" class="btn btn-primary">Update</button>

</form>

</div>
</div>

</body>
</html>