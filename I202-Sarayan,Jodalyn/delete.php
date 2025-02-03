<?php
include "db_conn.php";
$id = $_GET['id'];

/*Code for deleting record */
$sql = "DELETE FROM `crud` WHERE id = $id";
$result = mysqli_query($conn,$sql);
/*Reset sa number */
if($result){
    $sql_reset = "ALTER TABLE crud AUTO_INCREMENT = 1";
    mysqli_query($conn, $sql_reset);
    header("Location:index.php?msg= User has been deleted from the database");
}
else{
    echo"Failed" . mysqli_error($conn);
}
?>