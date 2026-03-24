<?php
include("database.php");

$sql = "SELECT * FROM resumes";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>All Users Resume Data</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
.user-table{
  width:85%;
  margin:auto;
  border-collapse:collapse;
  margin-top:30px;
  background: rgba(253, 242, 242, 0.9);
  backdrop-filter: blur(10px);
  border-radius:10px;
  overflow:hidden;
}

.user-table td {
  white-space: nowrap;      /* sab ek line me rakhega */
  overflow: hidden;
  text-overflow: ellipsis;  /* ... laga dega agar bada ho */
  max-width: 180px;         /* column limit */
}


.user-table ul {
  padding-left: 15px;
  margin: 0;
}

.user-table th,
.user-table td{
  padding:12px;
  text-align:left;
}

.user-table th{
  background: rgba(0,0,0,0.1);
}

.user-table tr:nth-child(even){
  background: rgba(255,255,255,0.1);
}

.delete-btn{
  background:#ef4444;
  color:white;
  padding:6px 12px;
  border-radius:6px;
  text-decoration:none;
}

.edit-btn{
  background:#f59e0b;
  color:white;
  padding:6px 12px;
  border-radius:6px;
  text-decoration:none;
  margin-right:5px;
}
td{
  vertical-align: middle;
}

.action-btns{
  display:flex;
  gap:8px;
}

.action-btns a{
  display:inline-block;
  white-space: nowrap;
}
</style>
</head>

<body>

<h2 style="text-align:center;">User Resume Data</h2>

<table class="user-table">

<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Skills</th>
<th>Education</th>
<th>Projects</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['user_email']; ?></td>
<td><?php echo $row['phone']; ?></td>

<td>
<?php
$skills = explode("\n", $row['skills']);
foreach($skills as $s){
  echo "$s<br>";
}
?>
</td>

<td>
<?php
$edu = explode("\n", $row['education']);
foreach($edu as $e){
  echo "$e<br>";
}
?>
</td>

<td>
<ul>
<?php
$projects = explode("\n", $row['projects']);
foreach($projects as $p){
  echo "<li>$p</li>";
}
?>
</ul>
</td>

<td><?php echo $row['created_at']; ?></td>

<td>
<?php echo (!empty($row['updated_at'])) ? "Updated" : "New"; ?>
</td>

<td>
<a href="create_resume.php?edit=1" class="btn edit-btn">Edit</a>

<a href="delete_resume.php?id=<?php echo $row['id']; ?>" 
   class="delete-btn"
   onclick="return confirm('Delete this resume?')">
   Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>