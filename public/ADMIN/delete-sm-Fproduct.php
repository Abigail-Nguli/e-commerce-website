<?php  

    include('../config/constants.php');

    //Get Featured Product
    $id = $_GET['id'];

    //Delete Featured Product
    $sql = "DELETE FROM sm_feat_products WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Featured Product Deleted Successfully</div>";

            header("location: sm-featured-products.php");
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Featured Product. Try Again Later!!</div>";

            header("location: sm-featured-products.php");
        }


?>