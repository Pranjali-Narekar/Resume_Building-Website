<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$ats_score = 75; // abhi temporary score
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATS Resume Builder Dashboard</title>
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family: Arial, sans-serif;
    }

    body{
      color:#222;
    }

    .navbar{
      background: rgba(255,255,255,0.3);
      backdrop-filter: blur(6px);
      font-size: 15px;
      font-color: black;
      padding:18px 40px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    .logo{
      font-size:32px;
      font-weight:700;
      color:#12086;
    }

    .nav-links a{
      text-decoration:none;
      margin-left:20px;
      color:#333;
      font-weight:500;
    }

    .container{
      width:90%;
      max-width:1200px;
      margin:30px auto;
    }

    .welcome-box{
      background: rgba(255,255,255,0.3);
      backdrop-filter: blur(6px);
      border-radius:16px;
      padding:25px;
      box-shadow:0 4px 15px rgba(0,0,0,0.06);
      display:flex;
      justify-content:space-between;
      align-items:center;
      flex-wrap:wrap;
      margin-bottom:25px;
    }

    .welcome-box h1{
      font-size:32px;
      margin-bottom:8px;
    }

    .welcome-box p{
      color:#666;
      font-size:16px;
    }

    .btn{
      display:inline-block;
      text-decoration:none;
      background:#2563eb;
      color:white;
      padding:12px 18px;
      border-radius:10px;
      font-weight:600;
      margin-top:10px;
      margin-right:10px;
    }

    .btn-outline{
      background:white;
      color:#2563eb;
      border:1px solid #2563eb;
    }

    .dashboard-grid{
      background: rgba(255,255,255,0.3);
      backdrop-filter: blur(6px);
      display:grid;
      grid-template-columns: 2fr 1fr;
      gap:20px;
    }


    .my-cards{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
}

.card{
border-radius:16px;
padding:22px;
box-shadow:0 4px 15px rgba(0,0,0,0.06);
background: rgba(255,255,255,0.25);
backdrop-filter: blur(10px);
}

.score-card{
border-radius:16px;
padding:25px;
box-shadow:0 4px 15px rgba(0,0,0,0.06);
text-align:center;
background: rgba(255,255,255,0.25);
backdrop-filter: blur(10px);
}

    /*.my-cards{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:20px;
    }

    .card{
      border-radius:16px;
      padding:22px;
      box-shadow:0 4px 15px rgba(0,0,0,0.06);
      background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px);
    }*/

    .card h3{
      margin-bottom:10px;
      font-size:22px;
    }

    .card p{
      color:#666;
      line-height:1.6;
      margin-bottom:15px;
    }

    /*.score-card{
      background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px);
      border-radius:16px;
      padding:25px;
      box-shadow:0 4px 15px rgba(0,0,0,0.06);
      text-align:center;
    }

    .card{
      background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px);
      border-radius:16px;
      padding:22px;
      box-shadow:0 4px 15px rgba(0,0,0,0.1);
    }*/

    .circle-wrap{
      width:180px;
      height:180px;
      margin:20px auto;
      border-radius:50%;
      background:conic-gradient(#2563eb <?php echo $ats_score; ?>%, #e5e7eb 0);
      display:flex;
      align-items:center;
      justify-content:center;
    }

    .circle-inner{
      width:130px;
      height:130px;
      background:#fff;
      border-radius:50%;
      display:flex;
      align-items:center;
      justify-content:center;
      flex-direction:column;
    }

    .circle-inner h2{
      font-size:36px;
      color:#2563eb;
    }

    .circle-inner span{
      font-size:14px;
      color:#666;
    }

    .tip-box{
      margin-top:20px;
      background: rgba(255,255,255,0.35);
      backdrop-filter: blur(6px);
      border-left:4px solid #2563eb;
      padding:15px;
      border-radius:10px;
      color:#333;
      line-height:1.5;
    }

    @media(max-width:1000px){
      .dashboard-grid{
        grid-template-columns:1fr;
      }
      .cards{
        grid-template-columns:1fr; 
      }
    }


    .btn{
    display:inline-block;
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    font-weight:600;
    margin-top:10px;
    margin-right:10px;
    }


    .logout-btn{
    background:#ef4444;
    }

    .logout-btn:hover{
     background:white;
    }
    
  </style>
  
</head>
<body>

  <div class="navbar">
    <div class="logo">ResumeBuilder</div>
    <div class="nav-links">
      <a href="index.php">Home</a>
      <a href="templates.php">Templates</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">

    <div class="welcome-box">
      <div>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["full_name"]); ?> 👋</h1>
        <p><?php echo htmlspecialchars($_SESSION["email"]); ?></p>
      </div>

    <div style="margin-top:10px;">
     <a href="create_resume.php" class="btn">Create Resume</a>
     <a href="templates.php" class="btn">Templates</a>
     <a href="view_users.php" class="btn">View User Data</a>
     <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>
  </div>

    <div class="dashboard-grid">

      <div class="my-cards">
        <div class="card">
          <h3>Create Resume</h3>
          <p>Fill your details like summary, skills, education and projects to generate an ATS-friendly resume.</p>
          <a href="create_resume.php" class="btn">Start</a>
        </div>

        <div class="card">
          <h3>Choose Template</h3>
          <p>Select a professional resume layout that looks clean and works better for ATS systems.</p>
          <a href="templates.php" class="btn">Templates</a>
        </div>

        <div class="card">
          <h3>Preview & Print</h3>
          <p>Preview your final resume and save it as PDF directly from the browser for job applications.</p>
          <a href="create_resume.php" class="btn">Go to Form</a>
        </div>
      </div>

      <div class="score-card">
        <h3>ATS Resume Score</h3>

        <div class="circle-wrap">
          <div class="circle-inner">
            <h2><?php echo $ats_score; ?>%</h2>
            <span>Match Score</span>
          </div>
        </div>

        <div class="tip-box">
          Add strong summary, technical skills, projects and education details to improve ATS score.
        </div>
      </div>

    </div>

  </div>

</body>
</html>