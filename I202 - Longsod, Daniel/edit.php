
<?php
include 'config.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id") or die($conn->error);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $year = intval($_POST['year']);
    $section = trim($_POST['section']);

    $conn->query("UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', gender='$gender', year=$year, section='$section' WHERE id=$id") or die($conn->error);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>First Name:</label><input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br>
        <label>Last Name:</label><input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br>
        <label>Email:</label><input type="text" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male
        <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female
        <input type="radio" name="gender" value="Other" <?php echo ($row['gender'] == 'Other') ? 'checked' : ''; ?>> Other<br>
        <label>Year:</label><input type="number" name="year" value="<?php echo $row['year']; ?>" required><br>
        <label>Section:</label><input type="text" name="section" value="<?php echo $row['section']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
