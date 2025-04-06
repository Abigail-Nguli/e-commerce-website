 <?php
    include('menu.php');
?>

    <div class="main-content">
    <div class="wrapper">
        <h1>Update Profile Photo</h1>
        <br>
        <br>

        <div user_id="message">
            <?php 
                 if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Display Session Message
                    unset($_SESSION['remove-failed']);//Remove Session Message
                }
            ?>
        </div>
        <br>
        <br>

        <?php 
            //Select User using ID
            $user_id = $_GET['user_id'];

            //Get Details
            $sql = "SELECT * FROM login_tbl WHERE id = '$user_id'";

            $res = mysqli_query($conn, $sql);

            //Check Query Execution
            if($res==true)
            {
                $count = mysqli_num_rows($res);

                if($count==1){
                    //Get Details
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row["full_name"];
                    $image_name = $row["image_name"];
                    $username = $row["username"];
                    $user_type = $row["user_type"];
                }
                else{
                    //Redirect
                    header("location: index.php");
                }
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><b><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td>User Type: </td>
                    <td>
                        <b><?php echo $user_type; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Current Profile Photo: </td>
                    <td>
                        <?php 
                            if($image_name != "") 
                            { 
                            
                                echo '<img src="../Images/Profile Photos/'.$image_name.'" width="150px">'; 
                                
                            } 
                            else 
                            { 
                               echo '<img src="../Images/Profile.jpeg" width="150px">';
                            } 
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Profile Details" class="primary-btn">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit'])){

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Save Data
        $sql = "UPDATE login_tbl SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = '$user_id'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['update'] = "<div class='success'>Use New Credentials to login!!</div>";
            unset($_SESSION['user']);

            header("location: index.php");
        }
        else{
            $SESSION['update'] = "<div class='error'>❌Failed to Add New Credentials. Try Again Later!!</div>";

            header("location: update-pp.php");
        }
    }
?>

<script> 
    // JavaScript to huser_ide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementByuser_Id('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>
