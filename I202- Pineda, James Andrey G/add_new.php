<?php
include "db_conn.php";

if (isset($_POST['submit'])) {
    // Escape input values to prevent SQL errors or SQL injection
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($conn, $_POST['last_name'] ?? '');
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $year       = mysqli_real_escape_string($conn, $_POST['year']);
    $section    = mysqli_real_escape_string($conn, $_POST['section']);

    // Properly formatted INSERT query
    $sql = "INSERT INTO `drei` (`first_name`, `last_name`, `email`, `gender`, `year`, `section`)
            VALUES ('$first_name', '$last_name', '$email', '$gender', '$year', '$section')";

    // Execute query and check the result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=New record created successfully");
        exit(); // Prevent further code execution
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
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
        <h3>Add new user</h3>
        <p class="text-muted">Complete the form below to add a new user</p>
    </div>

    <div class="container d-flex justify-content-center"></div>
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                 <div class="col">
                 <label class="form label">First Name: </label>
                 <input type="text" class="form-control" name="first_name"
                 placeholder="albert">
            </div>

            <div class="col">
                <label class="form label">Last Name: </label>
                <input type="text" class="form-control" name="Last_name"
                 placeholder="Einstein">
            </div>
        </div>

        <div>
        <div class="mb-3">
            <label class="form label">Email: </label>
             <input type="email" class="form-control" name="email"
             placeholder="name@example.com">
             </div>

        <div class="form-group mb-3">
            <label>Gender:</label> &nbsp;
            <input type="radio" class="form-class-input" name="gender" id="male" value="male">
            <label for="male" class="form-input-label"> Male </label>
            &nbsp;
            <input type="radio" class="form-class-input" name="gender" id="female" value="female">
            <label for="female" class="form-input-label"> Female </label>
        </div>
        <div class="mb-3">
        <select name="year"> 
            <option>-Select Year-</option>
            <option>1st Year</option>
            <option>2nd Year</option>
            <option>3rd Year</option>
            <option>4th Year</option>
        </select>
        &nbsp;
        <select name="section">
            <option>-Select Section-</option>
            <option>I201</option>
            <option>I202</option>
            <option>I203</option>
            <option>I204</option>
        </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success" name="submit"> Save </button> 
            <a href="index.php" class="btn btn-danger"> Cancel </a> 
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</body>
</html>
