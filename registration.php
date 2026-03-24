<?php
require_once "database.php";

$msg = "";

if(isset($_POST["submit"])){

    $fullName = trim($_POST["full_name"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
    $repeat   = $_POST["repeat_password"];

    if($password !== $repeat){
        $msg = "Password does not match";
    } else {

        // email exists check
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email=? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($res) > 0){
            $msg = "Email already exists";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt2 = mysqli_prepare($conn, "INSERT INTO users(full_name,email,password) VALUES(?,?,?)");
            mysqli_stmt_bind_param($stmt2, "sss", $fullName, $email, $hash);

            if(mysqli_stmt_execute($stmt2)){
                header("Location: login.php");
                exit();
            } else {
                $msg = "Registration failed!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container" style="max-width:420px;margin-top:70px;">

<?php if($msg!=""){ echo "<div class='alert alert-danger'>$msg</div>"; } ?>


<div class="register-box">
<form method="post" action="registration.php">
  <input class="form-control mb-3" name="full_name" placeholder="Full Name" required>
  <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

  <div style="position:relative;">
  <input type="password" id="password" placeholder="Enter Password:" name="password" class="form-control">

<span onclick="togglePassword1()" 
style="position:absolute; right:10px; top:8px; cursor:pointer;">
👁
</span>
</div>
<div style="position:relative;">
<input type="password" id="repeat_password" name="repeat_password" placeholder="Repeat Password" required>

<span onclick="togglePassword2()"
style="position:absolute; right:10px; top:8px; cursor:pointer;">
👁
</span>
</div>

  <button class="btn btn-primary w-100" type="submit" name="submit">Register</button>
</form>

<p class="mt-3">Already registered? <a href="login.php">Login</a></p>
</div>

<script>
function togglePassword1() {
  var x = document.getElementById("password");

  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function togglePassword2(){
var x = document.getElementById("repeat_password");

if(x.type === "password"){
x.type = "text";
}else{
x.type = "password";
}
}
</script>
</body>
</html>