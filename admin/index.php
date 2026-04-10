<?php include 'auth.php'; ?>
<?php include 'header.php'; ?>


<h2>📚 eBooks</h2>

<a href="add.php" class="btn btn-success">➕ Add eBook</a>
<a href="logout.php" class="btn btn-danger">Logout</a>

<?php if(isset($_GET['msg'])) echo "<div class='alert'>Action Successful</div>"; ?>

<table>
<tr>
<th>ID</th>
<th>Title</th>
<th>Price</th>
<th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM ebooks");

while($row = $res->fetch_assoc()){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td>₹<?php echo $row['price']; ?></td>

<td>
<a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
<a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>

<?php } ?>
</table>

<?php include 'footer.php'; ?>