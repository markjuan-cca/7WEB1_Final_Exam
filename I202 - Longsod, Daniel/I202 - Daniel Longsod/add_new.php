
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $year = intval($_POST['year']);
    $section = trim($_POST['section']);

    if (!empty($first_name) && !empty($last_name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, gender, year, section) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $first_name, $last_name, $email, $gender, $year, $section);
        $stmt->execute();
        header("Location: index.php");
    } else {
        echo "Please fill out all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
</head>
<body>
    <h1>Add New User</h1>
    <form method="POST" action="add_new.php">
        <label>First Name:</label><input type="text" name="first_name" required><br>
        <label>Last Name:</label><input type="text" name="last_name" required><br>
        <label>Email:</label><input type="text" name="email" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other<br>
        <label>Year:</label><input type="number" name="year" required><br>
        <label>Section:</label><input type="text" name="section" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
