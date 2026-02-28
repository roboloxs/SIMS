<?php include 'connection.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIMS | Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #004aad; --bg: #f0f4f8; }
        body { background: var(--bg); font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        #sidebar { width: 260px; height: 100vh; background: var(--primary); position: fixed; left: -260px; transition: 0.4s; z-index: 1000; }
        #sidebar.active { left: 0; }
        #sidebar .nav-link { color: white; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); text-decoration: none; display: block; }
        #main-content { width: 100%; transition: 0.4s; min-height: 100vh; }
        #main-content.active { margin-left: 260px; width: calc(100% - 260px); }
        .top-nav { background: white; padding: 20px 40px; border-bottom: 3px solid var(--primary); display: flex; justify-content: space-between; align-items: center; }
        .data-card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin: 40px; }
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
    <div class="top-nav">
        <div class="d-flex align-items-center"><span style="font-size:30px; cursor:pointer; color:var(--primary);" onclick="toggleNav()">☰</span><h4 class="ms-3 mb-0 fw-bold">Database</h4></div>
        <form method="GET" class="d-flex">
            <input type="text" name="search" class="form-control rounded-pill px-4" placeholder="Search..." value="<?php echo @$_GET['search']; ?>">
            <button class="btn btn-primary rounded-pill ms-2">Search</button>
            <a href="display.php" class="btn btn-outline-secondary rounded-pill ms-2">Clear</a>
        </form>
    </div>
    <div class="data-card">
        <table class="table table-hover text-center">
            <thead class="table-primary"><tr><th>ID</th><th>NAME</th><th>COURSE</th><th>YEAR</th><th>AGE</th><th>ACTIONS</th></tr></thead>
            <tbody>
                <?php
                $s = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $sql = "SELECT * FROM students WHERE Full_Name LIKE '%$s%' OR Student_ID LIKE '%$s%'";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)) {
                    $unique_db_id = $row['ID']; 
                    echo "<tr>
                        <td>{$row['Student_ID']}</td>
                        <td>{$row['Full_Name']}</td>
                        <td>{$row['Course']}</td>
                        <td>{$row['Year_Level']}</td>
                        <td>{$row['Age']}</td>
                        <td>
                            <a href='update.php?updateid=$unique_db_id' class='btn btn-sm btn-primary'>Edit</a>
                            <a href='delete.php?deleteid=$unique_db_id' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete student?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>function toggleNav() { document.getElementById('sidebar').classList.toggle('active'); document.getElementById('main-content').classList.toggle('active'); }</script>
</body>
</html>