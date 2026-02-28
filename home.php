<?php 
include 'connection.php'; 

$message = ""; // To store a success message

if (isset($_POST['submit'])) {
    $sid = mysqli_real_escape_string($conn, $_POST['studentID']);
    $name = mysqli_real_escape_string($conn, $_POST['fullName']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = mysqli_real_escape_string($conn, $_POST['yearLevel']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    $sql = "INSERT INTO students (Student_ID, Full_Name, Course, Year_Level, Age) 
            VALUES ('$sid', '$name', '$course', '$year', '$age')";
    
    if (mysqli_query($conn, $sql)) {
        $message = "Student Added Successfully!";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIMS | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #004aad; --bg: #f8fbff; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: var(--bg); overflow-x: hidden; }
        #sidebar { width: 260px; height: 100vh; background: var(--primary); position: fixed; left: -260px; transition: 0.4s; z-index: 1000; }
        #sidebar.active { left: 0; }
        #sidebar .nav-link { color: white; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); text-decoration: none; display: block; font-weight: 600; }
        #main-content { width: 100%; transition: 0.4s; min-height: 100vh; display: flex; flex-direction: column; }
        #main-content.active { margin-left: 260px; width: calc(100% - 260px); }
        .top-bar { background: white; padding: 15px 30px; border-bottom: 3px solid var(--primary); display: flex; align-items: center; }
        .glass-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.05); border-top: 10px solid var(--primary); width: 100%; max-width: 800px; margin: auto; }
    </style>
</head>
<body>

<div id="sidebar">
    <div class="p-4 text-white text-center"><h3>MENU</h3></div>
    <a href="home.php" class="nav-link">Add Student</a>
    <a href="display.php" class="nav-link">All Students</a>
    <a href="https://google.com" class="nav-link text-warning" onclick="return confirm('Exit?')">Exit</a>
</div>

<div id="main-content">
    <div class="top-bar">
        <span style="font-size:30px; cursor:pointer; color:var(--primary); margin-right:20px;" onclick="toggleNav()">☰</span>
        <h4 class="m-0 fw-bold text-primary">Student Information System</h4>
    </div>

    <div class="container py-5">
        <?php if($message != ""): ?>
            <div class="alert alert-success alert-dismissible fade show mx-auto" style="max-width: 800px;">
                <strong>Success!</strong> <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="glass-card">
            <h2 class="text-center text-primary fw-bold mb-4">REGISTRATION FORM</h2>
            <form action="home.php" method="POST">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="fw-bold">STUDENT ID</label>
                        <input type="text" name="studentID" class="form-control" placeholder="ID Number" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">FULL NAME</label>
                        <input type="text" name="fullName" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="col-md-12">
                        <label class="fw-bold">COURSE</label>
                        <select name="course" class="form-select" required>
                            <option value="" selected disabled>Select Course...</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Criminology">Criminology</option>
                            <option value="Hotel Management">Hotel Management</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">YEAR LEVEL</label>
                        <select name="yearLevel" class="form-select" required>
                            <option value="" selected disabled>Select Year...</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">AGE</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100 mt-4 py-3 fw-bold">SAVE RECORD</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleNav() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('main-content').classList.toggle('active');
    }
</script>
</body>
</html>