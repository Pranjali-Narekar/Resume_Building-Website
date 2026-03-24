<?php
session_start();

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}

include("database.php");

$user_email = $_SESSION['user'];

$sql = "SELECT * FROM resumes 
        WHERE user_email='$user_email' 
        ORDER BY id DESC 
        LIMIT 1";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

function e($s){ return htmlspecialchars($s ?? ""); }

// DATA
$full_name = $row['full_name'] ?? '';
$email     = $row['user_email'] ?? '';
$phone     = $row['phone'] ?? '';
$summary   = $row['summary'] ?? '';
$skills    = $row['skills'] ?? '';
$projects  = $row['projects'] ?? '';
$education = $row['education'] ?? '';

// ATS SCORE
$ats_score = 35;

if(trim($full_name) !== "") $ats_score += 5;
if(trim($email) !== "") $ats_score += 5;
if(trim($phone) !== "") $ats_score += 5;
if(trim($education) !== "") $ats_score += 10;
if(trim($projects) !== "") $ats_score += 10;

$summary_words = str_word_count($summary);
if($summary_words >= 20){
    $ats_score += 10;
}

$skills_count = count(array_filter(explode("\n", $skills)));
if($skills_count >= 5){
    $ats_score += 10;
}

if($ats_score > 95){
    $ats_score = 95;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Resume Preview</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>

body{
  background: linear-gradient(135deg,#c084fc,#818cf8);
  font-family: sans-serif;
}

/* NAV */
.preview-actions{
  padding:15px 25px;
}

.nav-link{
  color:#1d4ed8;
  text-decoration:none;
  font-weight:600;
  margin-right:15px;
}

.nav-link:hover{
  text-decoration:underline;
}

/* ATS BOX */
.ats-box{
  width:70%;
  margin:30px auto;
  text-align:center;
  background: rgba(255,255,255,0.25);
  backdrop-filter: blur(10px);
  padding:25px;
  border-radius:12px;
}

.circle{
  width:120px;
  height:120px;
  margin:20px auto;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
}

.inner{
  width:80px;
  height:80px;
  background:#fff;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:bold;
  color:#4f46e5;
}

/* RESUME */
.paper{
  width:70%;
  margin:20px auto;
  background:#fff;
  padding:30px;
  border-radius:12px;
}

.name{
  font-size:28px;
  font-weight:800;
}

.sec-title{
  font-weight:700;
  margin-top:15px;
}

ul{
  margin-left:20px;
}

/* PRINT FIX */
@media print{
  .no-print{
    display:none !important;
  }

  body{
    background:#fff;
  }

  .paper{
    width:100%;
    margin:0;
    box-shadow:none;
    page-break-inside: avoid;
  }

  @page{
  margin: 10mm;
  }

  body{
  margin:0;
  }

  .paper{
  page-break-inside: avoid;
  break-inside: avoid;
  }
}

</style>
</head>

<body>

<!-- NAV -->
<div class="preview-actions no-print">
<a href="dashboard.php" class="nav-link">Dashboard</a>
<a href="create_resume.php?edit=1" class="nav-link">Edit</a>
<a href="#" onclick="window.print()" class="nav-link">Download Resume</a>
<a href="#" onclick="window.print()" class="nav-link">Print Resume</a>
<a href="logout.php" class="nav-link">Logout</a>
</div>

<!-- ATS SCORE -->
<div class="ats-box no-print">
  <h3>ATS Resume Score</h3>

  <div class="circle" style="background: conic-gradient(#4f46e5 <?php echo $ats_score; ?>%, #ddd 0);">
    <div class="inner"><?php echo $ats_score; ?>%</div>
  </div>

  <p>Improve summary, skills & projects to increase score.</p>
</div>

<!-- RESUME -->
<div class="paper">

<div class="name"><?php echo e($full_name); ?></div>

<p><?php echo e($email); ?></p>
<p><?php echo e($phone); ?></p>

<hr>

<div class="sec-title">Summary</div>
<p><?php echo nl2br(e($summary)); ?></p>

<div class="sec-title">Skills</div>
<ul>
<?php
foreach(explode("\n",$skills) as $s){
  if(trim($s)!=""){
    echo "<li>".e($s)."</li>";
  }
}
?>
</ul>

<div class="sec-title">Projects</div>
<ul>
<?php
foreach(explode("\n",$projects) as $p){
  if(trim($p)!=""){
    echo "<li>".e($p)."</li>";
  }
}
?>
</ul>

<div class="sec-title">Education</div>
<ul>
<?php
foreach(explode("\n",$education) as $e1){
  if(trim($e1)!=""){
    echo "<li>".e($e1)."</li>";
  }
}
?>
</ul>

</div>

</body>
</html>