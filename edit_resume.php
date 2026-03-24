<?php
session_start();
include("database.php");

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM resumes WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

  $full_name = $_POST['full_name'];
  $skills = $_POST['skills'];
  $projects = $_POST['projects'];
  $education = $_POST['education'];

  mysqli_query($conn, "UPDATE resumes SET 
  full_name='$full_name',
  skills='$skills',
  projects='$projects',
  education='$education',
  updated_at=NOW()
  WHERE id=$id");

  header("Location: preview.php");
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Edit Resume</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
body{
  background: url('assets/img/bg 2.jpg');
  background-size: cover;
}

.form-wrap{
  padding:25px;
}

input, textarea{
  width:100%;
  padding:10px;
  margin:10px 0;
  border-radius:8px;
  border:1px solid #ddd;
}

.update-btn{
  background:#2563eb;
  color:white;
  padding:10px 20px;
  border:none;
  border-radius:8px;
  cursor:pointer;
}
</style>

</head>
<body>

<div class="section">
<div class="container">
<div class="card form-wrap">

<form method="POST">

<input name="full_name" value="<?php echo $row['full_name']; ?>">

<textarea name="skills"><?php echo $row['skills']; ?></textarea>

<textarea name="projects"><?php echo $row['projects']; ?></textarea>

<textarea name="education"><?php echo $row['education']; ?></textarea>

<button class="update-btn" name="update">Save & Download</button>

</form>

</div>
</div>
</div>

</body>
</html>