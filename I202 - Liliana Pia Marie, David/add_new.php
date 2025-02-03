<?php
include "db_conn.php";
$errors = [];
$first_name = $last_name = $email = $gender = $year = $section = '';

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender']?? '';
    $year = $_POST['year']?? '';
    $section = $_POST['section']?? '';

    /*Validation */ /* This is PHP server side validation when form is submitted */
    if (empty($first_name)) {
        $errors['first_name'] = "First Name is required.";
    } elseif (preg_match('/^\s*$/', $first_name)) {
        $errors['first_name'] = "First Name cannot contain only spaces.";
    }
    if (empty($last_name)) {
        $errors['last_name'] = "Last Name is required.";
    } elseif (preg_match('/^\s*$/', $last_name)) {
        $errors['last_name'] = "Last Name cannot contain only spaces.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address.";
    }
    if (empty($gender) || !in_array($gender, ['male', 'female','other','secret'])) {
        $errors['gender'] = "Please select a gender.";
    }
    if (empty($year)) {
        $errors['year'] = "Year is required.";
    }
    if (empty($section)) {
        $errors['section'] = "Section is required.";
    }
    if (empty($errors)) {
        $sql = "INSERT INTO `crud`(`first_name`, `last_name`, `email`, `gender`, `year`, `section`) 
                VALUES ('$first_name', '$last_name', '$email', '$gender', '$year', '$section')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New Record <b>CREATED</b> Successfully");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>PHP CRUD Application</title>
    </head>  
    <body style="background-color:#adb5bd;">
        <nav class="navbar navbar-dark bg-dark justify-content-center fs-3 mb-5;">
        <span style="color:white;">PHP Complete CRUD Application </span>
        </nav>

        <div class="container">
            <div class="text-center mb-3"><br>
                <h3>Add New User</h3>
                <p class="text-muted">Complete the form below to add a new user</p>
            </div>

            <!-- Form Start -->
            <div class="container d-flex justify-content-center">                
                <form action="" method="post" class="needs-validation <?php echo !empty($errors) ? 'was-validated' : ''; ?>" novalidate style="width:38vw; min-width: 300px;"> 
                    <!--border-->
                    <div class="border border-secondary border-3 p-4 mb-8 rounded" > 
                    
                        <!-- First Name --> 
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">First Name:</label>                              
                                <input type="text" class="form-control <?php echo isset($errors['first_name']) ? 'is-invalid' : ''; ?>" name="first_name" value="<?php echo $_POST['first_name'] ?? ''; ?>" required> 
                                <div class="invalid-feedback"><?php echo $errors['first_name'] ?? 'Please provide a valid first name.'; ?></div>
                            </div>
                        <!-- Last Name -->
                            <div class="col">
                                <label class="form-label">Last Name:</label>                           
                                <input type="text" class="form-control <?php echo isset($errors['last_name']) ? 'is-invalid' : ''; ?>" name="last_name" placeholder="Perry" value="<?php echo $_POST['last_name'] ?? ''; ?>" required>   
                                <div class="invalid-feedback"><?php echo $errors['last_name'] ?? 'Please provide a valid last name.'; ?></div>
                            </div>   
                        </div>

                        <!-- Email --> <!-- tatanong ko sna kung pwede email nlang input type -->
                        <div class="mb-3">
                            <label class="form-label">Email:</label>             
                            <input type="text" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email" placeholder="name@example.com" value="<?php echo $_POST['email'] ?? ''; ?>" required>     
                            <div class="invalid-feedback"><?php echo $errors['email'] ?? 'Please provide a valid email address.'; ?></div>
                        </div> 

                        <!-- Gender -->
                        <div class="form-group mb-3">
                            <label>Gender:</label>&nbsp;                       
                            <input type="radio" class="form-check-input <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" name="gender" id="male" value="male"<?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?> required>
                            <label for="male" class="form-input-label">Male</label>&nbsp;
                            <input type="radio" class="form-check-input <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" name="gender" id="female" value="female"<?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?> required>
                            <label for="female" class="form-input-label">Female</label>&nbsp;
                            <input type="radio" class="form-check-input <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" name="gender" id="other" value="other"<?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'checked' : ''; ?> required>
                            <label for="other" class="form-input-label">Other</label>&nbsp;
                            <input type="radio" class="form-check-input <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" name="gender" id="secret" value="secret"<?php echo (isset($_POST['gender']) && $_POST['gender'] == 'secret') ? 'checked' : ''; ?> required>
                            <label for="secret" class="form-input-label">Prefer not to say</label>
                            <div class="invalid-feedback"><?php echo $errors['gender'] ?? 'Please select a gender.'; ?></div>
                        </div>

                        <!-- Year -->
                        <div class="form-group mb-3">
                            <label for="year">Year:</label> &nbsp;
                            <select class="form-select <?php echo isset($errors['year']) ? 'is-invalid' : ''; ?>" id="year" name="year" required>
                                <option value="">-Select Year-</option>
                                <option value="1"<?php echo (isset($_POST['year']) && $_POST['year'] == '1') ? 'selected' : ''; ?>>1st Year</option>
                                <option value="2"<?php echo (isset($_POST['year']) && $_POST['year'] == '2') ? 'selected' : ''; ?>>2nd Year</option>
                                <option value="3"<?php echo (isset($_POST['year']) && $_POST['year'] == '3') ? 'selected' : ''; ?>>3rd Year</option>
                                <option value="4"<?php echo (isset($_POST['year']) && $_POST['year'] == '4') ? 'selected' : ''; ?>>4th Year</option>
                            </select>
                            <div class="invalid-feedback"><?php echo $errors['year'] ?? 'Please select a year.'; ?></div>
                        </div>

                        <!-- Section -->
                        <div class="form-group mb-3">
                            <label for="section">Section:</label> &nbsp;
                            <select class="form-select <?php echo isset($errors['section']) ? 'is-invalid' : ''; ?>" id="section" name="section" required>
                                <option value="">-Select Section-</option>
                                <option value="1"<?php echo (isset($_POST['section']) && $_POST['section'] == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2"<?php echo (isset($_POST['section']) && $_POST['section'] == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3"<?php echo (isset($_POST['section']) && $_POST['section'] == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4"<?php echo (isset($_POST['section']) && $_POST['section'] == '4') ? 'selected' : ''; ?>>4</option>
                            </select>
                            <div class="invalid-feedback"><?php echo $errors['section'] ?? 'Please select a section.'; ?></div>
                        </div>

                        <!-- Save & Cancel Button -->
                        <div><br>
                            <button type="submit" class="btn btn-success " name="submit">Save</button>
                            <a href="index.php" class="btn btn-danger ">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <!-- Form validation script na maarte name and email--> <!--client side validation, before the form is submitted.-->
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            'use strict';
            const form = document.querySelector('.needs-validation');
            const inputs = form.querySelectorAll('input, select');
            /*Email Validation */
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            /*Validation for all inputs*/
            inputs.forEach(function (input) {
                input.addEventListener('input', function () {
                    if (input.name === 'email') {
                        /*Special validation for email */
                        if (emailRegex.test(input.value.trim())) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                        }
                    } else if (input.name === 'first_name' || input.name === 'last_name') {
                        /* Validate first and last name fields to only allow letters and spaces*/
                        if (/^[a-zA-Z\s]+$/.test(input.value) && input.value.trim() !== '') {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                        }
                    } else {
                        /*General validation */
                        if (input.value.trim() !== '') {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                        }
                    }
                });
            });
            /* cant submit if invalid*/
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
        </script>
    </body>
</html>
