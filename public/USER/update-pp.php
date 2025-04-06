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
                    <td><b><?php echo $full_name; ?></b></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <b><?php echo $username; ?></b>
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
                    <td>Select New Image: </td> 
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Profile Photo" class="primary-btn">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit'])){

        //Get Data

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
        {
            // Upload new image and remove old image 
            $image_name = $_FILES['image']['name']; 

            $temp = explode('.', $image_name);
            $ext = end($temp);

            $image_name = "Profile_Photo_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image']['tmp_name']; 
            $destination_path = "../Images/Profile Photos/".$image_name; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-pp.php'); die();
            }

            if($current_image != "") 
            { 
                $remove_path = "../Images/Profile Photos/".$current_image; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-pp.php'); 
                    die(); 
                } 
            }
        }
        else{
            $image_name = $current_image;
        }

        //Save Data
        $sql = "UPDATE login_tbl SET
            image_name = '$image_name'
            WHERE id = '$user_id'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['add'] = "<div class='success'>Profile Photo Updated Successfully</div>";

            header("location: index.php");
        }
        else{
            $SESSION['add'] = "<div class='error'>❌Failed to Add New Profile Photo. Try Again Later!!</div>";

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
