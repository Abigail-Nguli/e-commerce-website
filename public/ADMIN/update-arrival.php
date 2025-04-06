<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Arrival</h1>
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
                //Select New Arrival using ID
                $id = $_GET['id'];

                //Get Details
                $sql = "SELECT *FROM new_arrivals WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $title = $row["title"];
                        $image_name = $row["image_name"];
                        $description = $row["description"];
                        $price = $row["price"];
                    }
                    else{
                        //Redirect
                        header("location: new-arrival.php");
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30"> 
                <tr> 
                    <td>Title: </td> 
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td> 
                </tr> 
                <tr> 
                    <td>Current Image: </td> 
                    <td> 
                        <?php 
                            if($image_name != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/'.$image_name.'" width="150px">'; 
                                
                            } 
                            else 
                            { 
                                echo "<div class='error'>Image Not Added</div>"; 
                            } 
                        ?> 
                    </td> 
                </tr> 
                <tr> 
                <td>Select New Image: </td> 
                <td><input type="file" name="image"></td>
                        
            </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                            <input type="submit" name="submit" value="Update Arrival" class="secondary-btn">
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
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
        {
            // Upload new image and remove old image 
            $image_name = $_FILES['image']['name']; 

            $temp = explode('.', $image_name);
            $ext = end($temp);

            $image_name = "New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image']['tmp_name']; 
            $destination_path = "../Images/New Arrivals/".$image_name; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-arrival.php'); die();
            }

            if($current_image != "") 
            { 
                $remove_path = "../Images/New Arrivals/".$current_image; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $image_name = $current_image;
        }

        //Update Category
        $sql = "UPDATE new_arrivals SET
        title = '$title',
        image_name = '$image_name', 
        description = '$description',
        price = '$price'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION["update"] = "<div class='success'>New Arrival Updated Successfully</div>";
            header("location: new-arrival.php");
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update New Arrival. Try Again Later!!</div>";
            header("location: update-arrival.php");
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