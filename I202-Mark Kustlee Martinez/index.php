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
    <body style="background-color:gray;">
        <nav class="navbar bg-dark justify-content-center fs-3 mb-5;">
        <span style="color:white;">PHP Complete CRUD Application </span>
        </nav> <br>
            <div class="container">
            <?php
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo '<div class="alert alert-light alert-dismissible fade show" role="alert"> 
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?> 
            <a href="add_new.php" class="btn btn-dark mb-3" style="margin:0 95;"> 
                <b>Add New User</b>
            </a>  
            <table class="table table-light table-hover table-striped table-border border-dark text-center" style="width:70vw; margin: 0 auto;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Year</th>
                        <th scope="col">Section</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "db_conn.php";
                        $sql = "Select * FROM `crud`";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row ['id']?></td>
                                    <td><?php echo $row ['first_name']?></td>
                                    <td><?php echo $row ['last_name']?></td>
                                    <td><?php echo $row ['email']?></td>
                                    <td><?php echo $row ['gender']?></td>
                                    <td><?php echo $row ['year']?></td>
                                    <td><?php echo $row ['section']?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id'];?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                        <a href="delete.php?id=<?php echo $row['id'];?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                                    </td>
                                </tr>    
                            <?php
                        }
                    ?>                  
                </tbody>
            </table>
        </div>     
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
