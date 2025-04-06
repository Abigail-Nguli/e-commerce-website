<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Registered User</h1>
            <br>
            <br>

            <div id="message">
                <?php 
                
                 if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Display Session Message
                    unset($_SESSION['remove-failed']);//Remove Session Message
                }

                ?>
            </div>

            <?php 
                //Select Featured using ID
                $id = $_GET['id'];

                //Get Details
                $sql = "SELECT *FROM login_tbl WHERE id= '$id'";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $image_name=$row['image_name'];
                        $username=$row['username'];
                        $user_type=$row['user_type'];
                    }
                    else{
                        //Redirect
                        header("location: users.php");
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30"> 
                <tr> 
                    <td>Full Name: </td> 
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td> 
                </tr> 
                <tr> 
                    <td>Current Image: </td> 
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
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>User Type: </td>
                    <td><b>
                        <?php echo $user_type; ?>
                    </b></td>
                </tr>

                <tr>
                    <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                            <input type="submit" name="submit" value="Update User" class="secondary-btn">
                        </td>
                </tr>
            </table>
            </form>
        </div>
    </div>

    <?php 
    
    if(isset($_POST['submit']))
    {
        //Get Updated Values
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $current_image = $_POST['current_image'];
        $username = $_POST['username'];

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
                header('location: update-user.php'); die();
            }

            if($current_image != "") 
            { 
                $remove_path = "../Images/Profile Photos/".$current_image; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-user.php'); 
                    die(); 
                } 
            }
        }
        else
        {
            $image_name = $current_image;
        }

        //Update Category
        $sql = "UPDATE login_tbl SET
        full_name = '$full_name',
        image_name = '$image_name', 
        username = '$username'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION["update"] = "<div class='success'>User Details Updated Successfully</div>";
            header("location: users.php");
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update User Details. Try Again Later!!</div>";
            header("location: update-user.php");
        }
    }
    
    ?>


<?php include('partials/footer.php'); ?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>