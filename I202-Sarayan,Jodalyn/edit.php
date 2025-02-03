<?php
include "db_conn.php";
$errors = [];
$first_name = $last_name = $email = $gender = $year = $section = '';
/*added in edit*/
$id= $_GET['id'];

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender']?? '';
    $year = $_POST['year']?? '';
    $section = $_POST['section']?? '';

     /*Validation */
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

    if (empty($gender) || !in_array($gender, ['male', 'female'])) {
        $errors['gender'] = "Please select a gender.";
    }

    if (empty($year)) {
        $errors['year'] = "Year is required.";
    }

    if (empty($section)) {
        $errors['section'] = "Section is required.";
    }

    // If no validation errors, proceed with database insertion
    if (empty($errors)) {
        $sql = "UPDATE `crud` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`gender`='$gender',`year`='$year',`section`='$section' WHERE id=$id";
        $result = mysqli_query( $conn, $sql);

        if($result){
        header( "Location: index.php?msg=Data updated successfully");
        }
        else{
        echo"Failed:" . mysqli_error($conn);
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
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
      
        <title>PHP CRUD Application</title>

    </head>  
    <body>
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:rgba(165, 229, 245, 0.45);">
            PHP Complete CRUD Application
        </nav>

        <!-- First Edited Part --> 
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edit User Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>
            
            <?php
            $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
            $result = mysqli_query( $conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <!-- Form Start -->
            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width: 300px; ">
                    
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name:</label>   
                            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']?>">   
                            <small class="text-danger"><?php echo $errors['first_name'] ?? ''; ?></small>
                        </div>

                        <div class="col">
                            <label class="form-label">Last Name:</label>   
                            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']?>">   
                            <small class="text-danger"><?php echo $errors['last_name'] ?? ''; ?></small>
                        </div>  
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email:</label>   
                        <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>" > 
                        <small class="text-danger"><?php echo $errors['email'] ?? ''; ?></small>    
                    </div> 

                    <!-- Gender -->
                    <div class="form-group" mb-3 required>
                        <label>Gender:</label> &nbsp;
                        <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row['gender']=='male')?"checked":""; ?>>
                        <label for="male" class="form-input-label">Male</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row['gender']=='female')?"checked":""; ?>>
                        <label for="female" class="form-input-label">Female</label>
                        <br>
                        <small class="text-danger"><?php echo $errors['gender'] ?? ''; ?></small>
                    </div>  

                    <!-- Year -->
                    <div class="form-group" mb-3><br>
                        <label for="year">Year:</label> &nbsp;
                        <select id="year" name="year">
                            <option value="">-Select Year-</option>
                            <option value="1"<?php echo ($row['year'] == 1) ? "selected" : ""; ?>>1st Year</option>
                            <option value="2"<?php echo ($row['year'] == 2) ? "selected" : ""; ?>>2nd Year</option>
                            <option value="3"<?php echo ($row['year'] == 3) ? "selected" : ""; ?>>3rd Year</option>
                            <option value="4"<?php echo ($row['year'] == 4) ? "selected" : ""; ?>>4th Year</option>
                        </select>
                        <small class="text-danger"><?php echo $errors['year'] ?? ''; ?></small>       
                    </div>

                     <!-- Section -->
                     <div class="form-group" mb-3><br>
                        <label for="section">Section:</label> &nbsp;
                        <select id="section" name="section">
                            <option value="">-Select Section-</option>
                            <option value="1"<?php echo ($row['section'] == 1) ? "selected" : ""; ?>>1</option>
                            <option value="2"<?php echo ($row['section'] == 2) ? "selected" : ""; ?>>2</option>
                            <option value="3"<?php echo ($row['section'] == 3) ? "selected" : ""; ?>>3</option>
                            <option value="4"<?php echo ($row['section'] == 4) ? "selected" : ""; ?>>4</option>
                        </select><br>
                        <small class="text-danger"><?php echo $errors['section'] ?? ''; ?></small>
                        <br><br>
                    </div>

                    <!-- Save & Cancel Button -->
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