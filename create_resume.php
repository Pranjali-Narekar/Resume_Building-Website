<?php
session_start();
include("database.php");

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}

$user_email = $_SESSION["user"];
$edit_mode = isset($_GET['edit']);

// 🔹 Fetch last resume for edit mode
if($edit_mode){
  $result = mysqli_query($conn, "SELECT * FROM resumes 
  WHERE user_email='$user_email' ORDER BY id DESC LIMIT 1");

  $row = mysqli_fetch_assoc($result);
}

// 🔹 Form submit
if(isset($_POST['submit'])){

  $full_name = trim($_POST['full_name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = $_POST['phone'] ?? '';
  $location = $_POST['location'] ?? '';
  $github = $_POST['github'] ?? '';
  $linkedin = $_POST['linkedin'] ?? '';
  $summary = trim($_POST['summary'] ?? '');
  $skills = trim($_POST['skills'] ?? '');
  $projects = trim($_POST['projects'] ?? '');
  $education = trim($_POST['education'] ?? '');

  // validation
  if($full_name === '' || $email === '' || $summary === '' || $skills === '' || $projects === '' || $education === ''){
      echo "<script>alert('Please fill all required fields');</script>";
  } else {

    // escape
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $summary = mysqli_real_escape_string($conn, $summary);
    $skills = mysqli_real_escape_string($conn, $skills);
    $projects = mysqli_real_escape_string($conn, $projects);
    $education = mysqli_real_escape_string($conn, $education);

    if($edit_mode && isset($row['id'])){
      // 🔥 UPDATE
      $sql = "UPDATE resumes SET 
      full_name='$full_name',
      phone='$phone',
      summary='$summary',
      skills='$skills',
      education='$education',
      projects='$projects',
      updated_at=NOW()
      WHERE id=".$row['id'];

    } else {
      // 🔥 INSERT
      $sql = "INSERT INTO resumes 
      (user_email,full_name,phone,summary,skills,education,projects,created_at)
      VALUES 
      ('$user_email','$full_name','$phone','$summary','$skills','$education','$projects', NOW())";
    }

    mysqli_query($conn,$sql);

    header("Location: preview.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Resume</title>
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    .form-wrap{padding:22px}
    .field{margin:12px 0}
    label{font-weight:700;display:block;margin-bottom:6px}
    input,textarea{
      width:100%;
      padding:10px;
      border:1px solid #e9eef7;
      border-radius:10px;
      outline:none
    }
    textarea{min-height:90px;resize:vertical}

    .two{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:12px
    }

    @media(max-width:900px){
      .two{grid-template-columns:1fr}
    }

    .submit-btn{
      background:#2563eb;
      color:white;
      padding:12px 18px;
      border:none;
      border-radius:10px;
      font-weight:600;
      cursor:pointer;
      margin-top:10px;
    }
  </style>
</head>

<body>

<div class="nav">
  <div class="container nav-inner">
    <h1 class="main-title">RESUME BUILDER</h1>

    <div class="nav-links">
      <a href="dashboard.php" class="top-btn">Dashboard</a>
      <a href="templates.php" class="top-btn">Templates</a>
      <a href="logout.php" class="top-btn logout-btn">Logout</a>
    </div>
  </div>
</div>

<div class="section">
  <div class="container">

    <!-- 🔥 dynamic heading -->
    <h2><?php echo $edit_mode ? "Edit Resume" : "Create Resume"; ?></h2>

    <div class="card form-wrap">

      <form method="POST">

        <div class="two">
          <div class="field">
            <label>Full Name</label>
            <input name="full_name" 
            value="<?php echo $edit_mode ? $row['full_name'] : ''; ?>" required>
          </div>

          <div class="field">
            <label>Email</label>
            <input type="email" name="email" 
            value="<?php echo $edit_mode ? $row['user_email'] : ''; ?>" required>
          </div>
        </div>

        <div class="two">
          <div class="field">
            <label>Phone</label>
            <input name="phone" 
            value="<?php echo $edit_mode ? $row['phone'] : ''; ?>">
          </div>

          <div class="field">
            <label>Location</label>
            <input name="location" placeholder="Nagpur, Maharashtra"
            value="<?php echo $edit_mode ? ($row['location'] ?? '') : ''; ?>">
          </div>
        </div>

        <div class="two">
          <div class="field">
            <label>GitHub Link</label>
            <input name="github" 
            value="<?php echo $edit_mode ? ($row['github'] ?? '') : ''; ?>">
          </div>

          <div class="field">
            <label>LinkedIn Link</label>
            <input name="linkedin" 
            value="<?php echo $edit_mode ? ($row['linkedin'] ?? '') : ''; ?>">
          </div>
        </div>

        <div class="field">
          <label>Professional Summary</label>
          <textarea name="summary" required><?php echo $edit_mode ? $row['summary'] : ''; ?></textarea>
        </div>

        <div class="field">
          <label>Technical / Programming / Soft Skills</label>
          <textarea name="skills" required><?php echo $edit_mode ? $row['skills'] : ''; ?></textarea>
        </div>

        <div class="field">
          <label>Academic Projects</label>
          <textarea name="projects" required><?php echo $edit_mode ? $row['projects'] : ''; ?></textarea>
        </div>

        <div class="field">
          <label>Education</label>
          <textarea name="education" required><?php echo $edit_mode ? $row['education'] : ''; ?></textarea>
        </div>

        <button type="submit" name="submit" class="submit-btn">
          Save & Download
        </button>

      </form>

    </div>

  </div>
</div>

</body>
</html>