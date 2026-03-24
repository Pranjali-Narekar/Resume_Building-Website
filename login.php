<?php
session_start();
require_once "database.php";

$msg = "";

if(isset($_POST["login"])){

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = mysqli_prepare($conn, "SELECT id, full_name, email, password FROM users WHERE email=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($res);

    if($user){
        if(password_verify($password, $user["password"])){

            $_SESSION["user"] = $email;
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["full_name"] = $user["full_name"];
            $_SESSION["email"] = $user["email"];

            header("Location: dashboard.php");
            exit();

        } else {
            $msg = "Password does not match";
        }
    } else {
        $msg = "Email does not match";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="login-box">
<div class="container" style="max-width:420px;margin-top:90px;">

<?php if($msg!=""){ echo "<div class='alert alert-danger'>$msg</div>"; } ?>

<form method="post" action="login.php">
  <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
<div style="position:relative;">
  <input type="password" id="password" placeholder="Enter Password:" name="password" class="form-control">

<span onclick="togglePassword()" 
style="position:absolute; right:10px; top:8px; cursor:pointer;">
👁
</span>
</div>
  
  <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
</form>

<p class="mt-3">Not registered? <a href="registration.php">Register</a></p>
</div>

<script>
function togglePassword() {
  var x = document.getElementById("password");

  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>