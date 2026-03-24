<?php
session_start();
include("database.php");

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION["user"];

$sql = "SELECT * FROM resumes WHERE user_email='$email' ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($result);

if(!$data){
    echo "<h2 style='text-align:center;margin-top:40px;'>No resume found. Please create a resume first.</h2>";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Last Resume</title>
<link rel="stylesheet" href="assets/css/style.css">
<style>
body{
font-family:Arial;
background:#f5f7fb;
padding:40px;
}

.resume{
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
max-width:700px;
margin:auto;
}

h1{
margin-bottom:5px;
}

.section{
margin-top:20px;
}

</style>
</head>

<body>

<div class="resume">

<h1><?php echo $data['full_name'] ?? ''; ?></h1>
<p><?php echo $data['phone']; ?></p>

<div class="section">
<h3>Summary</h3>
<p><?php echo $data['summary']; ?></p>
</div>

<div class="section">
<h3>Skills</h3>
<ul>
<?php
 $skills = explode("\n",$data['skills']);
 foreach($skills as $skill){
 if(trim($skill)!=""){
 echo "<li>$skill</li>";
 }
}?>
</ul>
</div>

<div class="section">
<h3>Education</h3>
<p><?php echo $data['education']; ?></p>
</div>

<div class="section">
<h3>Projects</h3>
<p><?php echo $data['projects']; ?></p>
</div>

<div class="section">
<h3>Projects</h3>
<p><?php echo $data['Date']; ?></p>
</div>

</div>

</body>
</html>