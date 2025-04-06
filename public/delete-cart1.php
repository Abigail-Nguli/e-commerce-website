<?php 

    include('config/constants.php');

    //Delete Featured Product
    // Fetch product details
    $id =  $_GET['id'];
    $sql = "DELETE FROM cart_tbl WHERE id = '$id'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Cart Item Deleted Successfully</div>";

            header("location: cart.php");
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Cart Item. Try Again Later!!</div>";

            header("location: cart.php");
        }

?>