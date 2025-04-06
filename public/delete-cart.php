<?php 

    include('config/constants.php');

    //Get Featured Product
    if(!isset($_SESSION["user"]))
    {
        header("location: login.php");
    }
    else
    {
        $username = $_SESSION['user'];
        $sql2 = "SELECT * FROM login_tbl WHERE username = '$username'";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 && mysqli_num_rows($res2) > 0) {
            $row = mysqli_fetch_assoc($res2);
            $user_id = $row['id'];
        }
    }

    //Delete Featured Product
    $sql = "DELETE FROM cart_tbl WHERE user_id = '$user_id'";

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