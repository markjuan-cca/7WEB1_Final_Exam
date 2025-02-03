
<?php
include 'config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id") or die($conn->error);
    echo "User deleted successfully!";
}

$result = $conn->query("SELECT * FROM users") or die($conn->error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Operations</title>
</head>
<body>
    <h1>CRUD Operations</h1>
    <a href="add_new.php">Add New User</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Year</th>
            <th>Section</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td>
                    <a href="edit.php?edit=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
