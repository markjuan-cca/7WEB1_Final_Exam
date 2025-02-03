<?php
include "db_conn.php";
$errors = [];
$first_name = $last_name = $email = $gender = $year = $section = '';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("Invalid or missing ID.");
}

if (isset($_POST['submit'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'] ?? '';
    $year = $_POST['year'] ?? '';
    $section = $_POST['section'] ?? '';

    $fields = ['first_name', 'last_name', 'email', 'gender', 'year', 'section'];
    foreach ($fields as $field) {
        $value = $$field ?? '';
        if (empty($value)) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        } elseif ($field === 'first_name' || $field === 'last_name') {
            if (preg_match('/^\s*$/', $value)) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " cannot contain only spaces.";
            }
        } elseif ($field === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email address.";
            }
        } elseif ($field === 'gender' && !in_array($value, ['Male', 'Female'])) {
            $errors['gender'] = "Please select a gender.";
        }
    }
    if (empty($errors)) {
        $sql = "UPDATE `crud` SET `first_name` = ?, `last_name` = ?, `email` = ?, `gender` = ?, `year` = ?, `section` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssisi", $first_name, $last_name, $email, $gender, $year, $section, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?msg=Data Updated Successfully!");
            exit;
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}

$sql = "SELECT * FROM `crud` WHERE id = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Record not found.");
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />     
        <title>PHP CRUD Application</title>
    </head>  
    <body style="background-color:black;">
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:rgba(133, 137, 138, 0.45);">
            <span style="color:white;">PHP Complete CRUD Application</span>
        </nav>

        <div class="container">
            <div class="text-center mb-3">
                <h3 style="color:white;">Edit User Information</h3>
                <p class="text-muted" style="color:white;">Click update after changing any information</p>
            </div>
            
            <?php
            $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
            $result = mysqli_query( $conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:45vw; min-width: 300px; ">        
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" style="color:white;">First Name:</label>   
                            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']?>">   
                            <small class="text-danger"><?php echo $errors['first_name'] ?? ''; ?></small>
                        </div>

                        <div class="col">
                            <label class="form-label" style="color:white;">Last Name:</label>   
                            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']?>">   
                            <small class="text-danger"><?php echo $errors['last_name'] ?? ''; ?></small>
                        </div>  
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="color:white;">Email:</label>   
                        <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>" > 
                        <small class="text-danger"><?php echo $errors['email'] ?? ''; ?></small>    
                    </div> 

                    <div class="form-group mb-3"  required>
                    <input type="radio" class="form-check-input" name="gender" id="Male" value="Male" <?php echo ($row['gender']=='Male')?"checked":""; ?>>
                    <label for="Male" class="form-input-label" style="color:white;">Male</label>&nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="Female" value="Female" <?php echo ($row['gender']=='Female')?"checked":""; ?>>
                    <label for="Female" class="form-input-label" style="color:white;">Female</label>
                        <small class="text-danger"><?php echo $errors['gender'] ?? ''; ?></small>
                    </div>  

                    <div class="form-group mb-3">
                        <label for="year" style="color:white;">Year:</label> &nbsp;
                        <select class="form-select" id="year" name="year">
                            <option value="">-Select Year-</option>
                            <option value="1"<?php echo ($row['year'] == 1) ? "selected" : ""; ?>>1st Year</option>
                            <option value="2"<?php echo ($row['year'] == 2) ? "selected" : ""; ?>>2nd Year</option>
                            <option value="3"<?php echo ($row['year'] == 3) ? "selected" : ""; ?>>3rd Year</option>
                            <option value="4"<?php echo ($row['year'] == 4) ? "selected" : ""; ?>>4th Year</option>
                        </select>
                        <small class="text-danger"><?php echo $errors['year'] ?? ''; ?></small>       
                    </div>

                     <div class="form-group mb-3">
                        <label for="section" style="color:white;">Section:</label> &nbsp;
                        <select class="form-select" id="section" name="section">
                            <option value="">-Select Section-</option>
                            <option value="1"<?php echo ($row['section'] == 1) ? "selected" : ""; ?>>1</option>
                            <option value="2"<?php echo ($row['section'] == 2) ? "selected" : ""; ?>>2</option>
                            <option value="3"<?php echo ($row['section'] == 3) ? "selected" : ""; ?>>3</option>
                            <option value="4"<?php echo ($row['section'] == 4) ? "selected" : ""; ?>>4</option>
                        </select>
                        <small class="text-danger"><?php echo $errors['section'] ?? ''; ?></small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
