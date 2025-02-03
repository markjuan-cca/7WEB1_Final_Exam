<?php
include "db_conn.php";

// Step 1: Retrieve the ID from the GET request and validate it
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is a number
} else {
    die("Invalid or missing ID.");
}

// Step 2: Check if form is submitted
if (isset($_POST['submit'])) {
    // Validate and set POST variables
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name'] ?? '');
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : ''; // Set empty string if not selected
    $year = mysqli_real_escape_string($conn, $_POST['year'] ?? '');
    $section = mysqli_real_escape_string($conn, $_POST['section'] ?? '');

    // Step 3: Validate required fields
    if (empty($first_name) || empty($email) || empty($year) || empty($section)) {
        echo "Please fill in all required fields.";
    } else {
        // Step 4: Update the record
        $sql = "UPDATE `drei` 
                SET `first_name`='$first_name', 
                    `last_name`='$last_name', 
                    `email`='$email', 
                    `gender`='$gender', 
                    `year`='$year', 
                    `section`='$section' 
                WHERE `id`=$id";

        try {
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: index.php?msg=Data updated successfully");
                exit();
            } else {
                echo "Update failed: " . mysqli_error($conn);
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Step 5: Fetch current record for the form
$sql = "SELECT * FROM `drei` WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("No data found for the specified ID.");
}
?>











<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP CRUD application</title>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: yellow;">
        PHP Complete CRUD Application
    </nav>

    <div class="container">
    <div class="text-center mb-4">
        <h3>Edit user  Information </h3>
        <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
$sql = "SELECT * FROM `drei` WHERE id = $id LIMIT 1";  // Use backticks for table name
$result = mysqli_query($conn, $sql);

// Check if query was successful and row exists
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No data found for the specified ID.";
}
?>

<div class="container d-flex justify-content-center">
    <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">First Name: </label>
                <input type="text" class="form-control" name="first_name"
                    value="<?php echo htmlspecialchars($row['first_name']); ?>">
            </div>

            <div class="col">
                <label class="form-label">Last Name: </label>
                <input type="text" class="form-control" name="last_name"
                    value="<?php echo htmlspecialchars($row['last_name']); ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email: </label>
            <input type="email" class="form-control" name="email"
                value="<?php echo htmlspecialchars($row['email']); ?>">
        </div>

        <div class="form-group mb-3">
            <label>Gender:</label> &nbsp;
            <input type="radio" class="form-class-input" name="gender" id="male" value="male" <?php echo ($row['gender'] == 'male') ? "checked" : ""; ?>>
            <label for="male" class="form-input-label">Male</label>
            &nbsp;
            <input type="radio" class="form-class-input" name="gender" id="female" value="female" <?php echo ($row['gender'] == 'female') ? "checked" : ""; ?>>
            <label for="female" class="form-input-label">Female</label>
        </div>

        <div class="mb-3">
            <select name="year" class="form-control">
                <option>-Select Year-</option>
                <option <?php echo ($row['year'] == '1st Year') ? 'selected' : ''; ?>>1st Year</option>
                <option <?php echo ($row['year'] == '2nd Year') ? 'selected' : ''; ?>>2nd Year</option>
                <option <?php echo ($row['year'] == '3rd Year') ? 'selected' : ''; ?>>3rd Year</option>
                <option <?php echo ($row['year'] == '4th Year') ? 'selected' : ''; ?>>4th Year</option>
            </select>

            <select name="section" class="form-control">
                <option>-Select Section-</option>
                <option <?php echo ($row['section'] == 'I201') ? 'selected' : ''; ?>>I201</option>
                <option <?php echo ($row['section'] == 'I202') ? 'selected' : ''; ?>>I202</option>
                <option <?php echo ($row['section'] == 'I203') ? 'selected' : ''; ?>>I203</option>
                <option <?php echo ($row['section'] == 'I204') ? 'selected' : ''; ?>>I204</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success" name="submit"> Update</button>
            <a href="index.php" class="btn btn-danger"> Cancel </a>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</body>
</html>
