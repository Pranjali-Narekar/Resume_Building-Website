<?php
include("database.php");

$id = $_GET['id'];

$sql = "DELETE FROM resumes WHERE id=$id";
mysqli_query($conn,$sql);

header("Location: view_users.php");
exit();
?>