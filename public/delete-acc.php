<?php 

    include('config/constants.php');

    //Get New Arrival
    $user_id = $_GET['user_id'];

    //Delete New Arrival
    $sql = "DELETE FROM login_tbl WHERE id = '$user_id'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='error'>Account Deleted Successfully</div>";

            header("location: index.php");
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Account. Try Again Later!!</div>";

            header("location: ../index.php");
        }


?>