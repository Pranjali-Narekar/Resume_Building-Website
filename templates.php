<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Resume Templates</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>

body{
font-family: Arial;
background:#f5f7fb;
margin:0;
}

.navbar{
background:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.logo{
font-size:24px;
font-weight:bold;
color:#2563eb;
}

.nav-links a{
margin-left:20px;
text-decoration:none;
color:#333;
font-weight:500;
}

.container{
width:90%;
max-width:1100px;
margin:auto;
margin-top:40px;
}

.title{
text-align:center;
margin-bottom:30px;
}

.templates{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:25px;
}

.template-card{
background:white;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.08);
padding:20px;
text-align:center;
}

.template-card img{
width:100%;
border-radius:8px;
margin-bottom:15px;
}

.btn{
display:inline-block;
background:#2563eb;
color:white;
padding:10px 16px;
border-radius:8px;
text-decoration:none;
font-weight:600;
}

.btn:hover{
background:#1d4ed8;
}

@media(max-width:900px){
.templates{
grid-template-columns:1fr;
}
}

</style>

</head>

<body>

<div class="navbar">
<div class="logo">ResumeBuilder</div>

<div class="nav-links">
<a href="dashboard.php">Dashboard</a>
<a href="#" onclick="confirmLogout()">Logout</a>
</div>
</div>


<div class="container">

<div class="title">
<h1>Choose Resume Template</h1>
<p>Select a clean professional template</p>
</div>


<div class="templates">

<!-- Template 1 -->
<div class="template-card">
<img src="assets/templates/template 1.png">

<h3>Classic ATS Template</h3>

<p>Simple professional resume for ATS systems.</p>

<a href="create_resume.php?template=1" class="btn">Use Template</a>
</div>


<!-- Template 2 -->
<div class="template-card">
<img src="assets/templates/template 2.png">

<h3>Modern Resume</h3>

<p>Clean modern design with good readability.</p>

<a href="create_resume.php?template=2" class="btn">Use Template</a>
</div>


<!-- Template 3 -->
<div class="template-card">
<img src="assets/templates/template 3.png">

<h3>Minimal Resume</h3>

<p>Minimal layout focused on content.</p>

<a href="create_resume.php?template=3" class="btn">Use Template</a>
</div>


<div class="template-card">
<img src="assets/templates/template 4.png">

<h3>Creative Resume</h3>

<p>Stylish clean template with better visual appeal.</p>

<a href="create_resume.php?template=4" class="btn">Use Template</a>
</div>


<!-- Template 5 -->
<div class="template-card">
<img src="assets/templates/template 5.png">
<h3>Professional Resume</h3>
<p>Professional clean resume design.</p>
<a href="create_resume.php?template=5" class="btn">Use Template</a>
</div>

<!-- Template 6 -->
<div class="template-card">
<img src="assets/templates/template 6.png">
<h3>Corporate Resume</h3>
<p>Corporate ATS friendly resume.</p>
<a href="create_resume.php?template=6" class="btn">Use Template</a>
</div>

<!-- Template 7 -->
<div class="template-card">
<img src="assets/templates/template 7.png">
<h3>Elegant Resume</h3>
<p>Elegant minimal resume template.</p>
<a href="create_resume.php?template=7" class="btn">Use Template</a>
</div>

<!-- Template 8 -->
<div class="template-card">
<img src="assets/templates/template 8.png">
<h3>Creative Resume</h3>
<p>Creative layout for modern resumes.</p>
<a href="create_resume.php?template=8" class="btn">Use Template</a>
</div>

<!-- Template 9 -->
<div class="template-card">
<img src="assets/templates/template 9.png">
<h3>Modern ATS Resume</h3>
<p>ATS optimized modern template.</p>
<a href="create_resume.php?template=9" class="btn">Use Template</a>
</div>

<!-- Template 10 -->
<div class="template-card">
<img src="assets/templates/template 10.png">
<h3>Minimal Resume</h3>
<p>Simple minimal resume design.</p>
<a href="create_resume.php?template=10" class="btn">Use Template</a>
</div>


</div>

</div>

<script>
function confirmLogout() {

    var result = confirm("Are you sure you want to logout?");

    if(result){
        window.location = "logout.php";
    }

}
</script>

</body>
</html>