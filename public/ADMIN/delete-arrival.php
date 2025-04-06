<?php 

    include('../config/constants.php');

    //Get New Arrival
    $id = $_GET['id'];

    //Delete New Arrival
    $sql = "DELETE FROM new_arrivals WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>New Arrival Deleted Successfully</div>";

            header("location: new-arrival.php");
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete New Arrival. Try Again Later!!</div>";

            header("location: new-arrival.php");
        }


?>