<?php 
include 'connection.php'; 
$id = $_GET['updateid'];
$id = mysqli_real_escape_string($conn, $id);
$result = mysqli_query($conn, "SELECT * FROM students WHERE ID=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullName']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = mysqli_real_escape_string($conn, $_POST['yearLevel']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    $sql = "UPDATE students SET Full_Name='$name', Course='$course', Year_Level='$year', Age='$age' WHERE ID=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Updated!'); window.location.href='display.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIMS | Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #004aad; --bg: #f8fbff; }
        body { background: var(--bg); font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        #sidebar { width: 260px; height: 100vh; background: var(--primary); position: fixed; left: -260px; transition: 0.4s; }
        #sidebar.active { left: 0; }
        #main-content { width: 100%; transition: 0.4s; min-height: 100vh; }
        #main-content.active { margin-left: 260px; width: calc(100% - 260px); }
        .glass-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-top: 8px solid #ffc107; max-width: 800px; margin: 50px auto; }
    </style>
</head>
<body>
<div id="sidebar">
    <div class="p-4 text-white text-center"><h3>MENU</h3></div>
    <a href="home.php" class="nav-link text-white p-3">Add Student</a>
    <a href="display.php" class="nav-link text-white p-3">All Students</a>
</div>
<div id="main-content">
    <div class="p-3 border-bottom bg-white"><span style="font-size:30px; cursor:pointer;" onclick="toggleNav()">☰</span></div>
    <div class="glass-card">
        <h3 class="text-center fw-bold text-primary mb-4">EDIT STUDENT</h3>
        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6"><label class="fw-bold">ID</label><input type="text" class="form-control" value="<?php echo $row['Student_ID']; ?>" disabled></div>
                <div class="col-md-6"><label class="fw-bold">NAME</label><input type="text" name="fullName" class="form-control" value="<?php echo $row['Full_Name']; ?>" required></div>
                <div class="col-12">
                    <label class="fw-bold">COURSE</label>
                    <select name="course" class="form-select" required>
                        <option <?php if($row['Course']=="Computer Science") echo "selected"; ?>>Computer Science</option>
                        <option <?php if($row['Course']=="Information Technology") echo "selected"; ?>>Information Technology</option>
                        <option <?php if($row['Course']=="Business") echo "selected"; ?>>Business</option>
                        <option <?php if($row['Course']=="Criminology") echo "selected"; ?>>Criminology</option>
                        <option <?php if($row['Course']=="Hotel Management") echo "selected"; ?>>Hotel Management</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">YEAR</label>
                    <select name="yearLevel" class="form-select">
                        <option value="1" <?php if($row['Year_Level']=="1") echo "selected"; ?>>1st Year</option>
                        <option value="2" <?php if($row['Year_Level']=="2") echo "selected"; ?>>2nd Year</option>
                        <option value="3" <?php if($row['Year_Level']=="3") echo "selected"; ?>>3rd Year</option>
                        <option value="4" <?php if($row['Year_Level']=="4") echo "selected"; ?>>4th Year</option>
                    </select>
                </div>
                <div class="col-md-6"><label class="fw-bold">AGE</label><input type="number" name="age" class="form-control" value="<?php echo $row['Age']; ?>" required></div>
            </div>
            <button type="submit" name="update" class="btn btn-warning w-100 mt-4 fw-bold">UPDATE RECORD</button>
        </form>
    </div>
</div>
<script>function toggleNav() { document.getElementById('sidebar').classList.toggle('active'); document.getElementById('main-content').classList.toggle('active'); }</script>
</body>
</html>