<?php
include "db_conn.php";
$id = $_GET['id'];

// Use correct SQL syntax for DELETE query
$sql = "DELETE FROM `crud` WHERE id = $id";  // Removed '*' and used correct DELETE syntax
$result = mysqli_query($conn, $sql);

// Check if the deletion was successful
if ($result) {
    header("Location: index.php?msg=Record deleted successfully");
    exit();  // Ensure no further code is executed after the redirect
} else {
    echo "Failed: " . mysqli_error($conn);  // Show error message if the query fails
}
?>