<?php
include '../config.php';
include 'auth.php';

$id = intval($_GET['id']);

// get file
$res = $conn->query("SELECT file FROM ebooks WHERE id=$id");
$data = $res->fetch_assoc();

$file = "../ebooks/".$data['file'];

if(file_exists($file)){
    unlink($file);
}

// delete db
$conn->query("DELETE FROM ebooks WHERE id=$id");

header("Location: index.php?msg=deleted");