<?php
include 'connection.php';
if (isset($_GET['deleteid'])) {
    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
    $sql = "DELETE FROM students WHERE ID = $id"; // Targeting only ONE ID
    if (mysqli_query($conn, $sql)) {
        header('location:display.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>