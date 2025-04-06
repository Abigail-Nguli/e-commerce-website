<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Small New Arrival</h1>
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
                $sql = "SELECT *FROM sm_new_arrivals WHERE id='$id'";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $title = $row["title"];
                        $color1 = $row["color1"];
                        $color2 = $row["color2"];
                        $color3 = $row["color3"];
                        $color4 = $row["color4"];
                        $color5 = $row["color5"];
                        $description = $row["description"];
                        $price = $row["price"];
                        $colors = $row["colors"];
                        $material = $row["material"];
                        $gender = $row["gender"];
                    }
                    else{
                        //Redirect
                        header("location: sm-new-arrivals.php");
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
                    <td>Color 1: </td> 
                    <td> 
                        <?php 
                            if($color1 != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/Small Products/'.$color1.'" width="150px">'; 
                                
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
                <td><input type="file" name="image1"></td>        
                </tr>

                <tr> 
                    <td>Color 2: </td> 
                    <td> 
                        <?php 
                            if($color2 != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/Small Products/'.$color2.'" width="150px">'; 
                                
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
                <td><input type="file" name="image2"></td>        
                </tr>
                
                <tr> 
                    <td>Color 3: </td> 
                    <td> 
                        <?php 
                            if($color3 != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/Small Products/'.$color3.'" width="150px">'; 
                                
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
                <td><input type="file" name="image3"></td>        
                </tr>

                <tr> 
                    <td>Color 4: </td> 
                    <td> 
                        <?php 
                            if($color4 != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/Small Products/'.$color4.'" width="150px">'; 
                                
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
                <td><input type="file" name="image4"></td>        
                </tr>

                <tr> 
                    <td>Color 5: </td> 
                    <td> 
                        <?php 
                            if($color5 != "") 
                            { 
                            
                                echo '<img src="../Images/New Arrivals/Small Products/'.$color5.'" width="150px">'; 
                                
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
                <td><input type="file" name="image5"></td>        
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
                    <td>Colors: </td>
                    <td>
                        <input type="text" name="colors" value="<?php echo $colors; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Material: </td>
                    <td>
                        <input type="text" name="material" value="<?php echo $material; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gender: </td>
                    <td>
                        <select name="gender">
                            <option <?php if($gender=="Male"){echo "selected";} ?> value="Male">Male</option>
                            <option  <?php if($gender=="Female"){echo "selected";} ?> value="Female">Female</option>
                            <option <?php if($gender=="Unisex"){echo "selected";} ?> value="Unisex">Unisex</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image1" value="<?php echo $color1; ?>">
                            <input type="hidden" name="current_image2" value="<?php echo $color2; ?>">
                            <input type="hidden" name="current_image3" value="<?php echo $color3; ?>">
                            <input type="hidden" name="current_image4" value="<?php echo $color4; ?>">
                            <input type="hidden" name="current_image5" value="<?php echo $color5; ?>">
                            <input type="submit" name="submit" value="Update Arrivals" class="secondary-btn">
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
        $current_image1 = $_POST['current_image1'];
        $current_image2 = $_POST['current_image2'];
        $current_image3 = $_POST['current_image3'];
        $current_image4 = $_POST['current_image4'];
        $current_image5 = $_POST['current_image5'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $colors = $_POST['colors'];
        $material = $_POST['material'];
        $gender = $_POST['gender'];

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image1']['name']) && $_FILES['image1']['name'] != "")
        {
            // Upload new image and remove old image 
            $color1 = $_FILES['image1']['name']; 

            $temp = explode('.', $color1);
            $ext = end($temp);

            $color1 = "Sm_New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image1']['tmp_name']; 
            $destination_path = "New Arrivals/Small Products/".$color1; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-sm-new-arrival.php'); die();
            }

            if($current_image1 != "") 
            { 
                $remove_path = "../Images/New Arrivals/Small Products/".$current_image1; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-sm-new-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $color1 = $current_image1;
        }

        if(isset($_FILES['image2']['name']) && $_FILES['image2']['name'] != "")
        {
            // Upload new image and remove old image 
            $color2 = $_FILES['image2']['name']; 

            $temp = explode('.', $color2);
            $ext = end($temp);

            $color2 = "Sm_New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image2']['tmp_name']; 
            $destination_path = "../New Arrivals/Small Products/".$color2; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-sm-new-arrival.php'); die();
            }

            if($current_image2 != "") 
            { 
                $remove_path = "../Images/New Arrivals/Small Products/".$current_image2; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-sm-new-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $color2 = $current_image2;
        }

        if(isset($_FILES['image3']['name']) && $_FILES['image3']['name'] != "")
        {
            // Upload new image and remove old image 
            $color3 = $_FILES['image3']['name']; 

            $temp = explode('.', $color3);
            $ext = end($temp);

            $color3 = "Sm_New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image3']['tmp_name']; 
            $destination_path = "../Images/New Arrivals/Small Products/".$color3; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-sm-new-arrival.php'); die();
            }

            if($current_image3 != "") 
            { 
                $remove_path = "../Images/New Arrivals/Small Products/".$current_image3; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-sm-new-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $color3 = $current_image3;
        }

        if(isset($_FILES['image4']['name']) && $_FILES['image4']['name'] != "")
        {
            // Upload new image and remove old image 
            $color4 = $_FILES['image4']['name']; 

            $temp = explode('.', $color3);
            $ext = end($temp);

            $color4 = "Sm_New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image4']['tmp_name']; 
            $destination_path = "../Images/New Arrivals/Small Products/".$color4; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-sm-new-arrival.php'); die();
            }

            if($current_image4 != "") 
            { 
                $remove_path = "../Images/New Arrivals/Small Products/".$current_image4; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-sm-new-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $color4 = $current_image4;
        }

        if(isset($_FILES['image5']['name']) && $_FILES['image5']['name'] != "")
        {
            // Upload new image and remove old image 
            $color5 = $_FILES['image5']['name']; 

            $temp = explode('.', $color5);
            $ext = end($temp);

            $color5 = "Sm_New_Arrival_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image5']['tmp_name']; 
            $destination_path = "../Images/New Arrivals/Small Products/".$color5; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location: update-sm-new-arrival.php'); die();
            }

            if($current_image5 != "") 
            { 
                $remove_path = "../Images/New Arrivals/Small Products/".$current_image5; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location: update-sm-new-arrival.php'); 
                    die(); 
                } 
            }
        }
        else{
            $color5 = $current_image5;
        }

        //Update Category
        $sql = "UPDATE sm_new_arrivals SET
        title = '$title',
        color1 = '$color1', 
        color2 = '$color2',
        color3 = '$color3',
        color4 = '$color4',
        color5 = '$color5',
        description = '$description',
        price = '$price',
        colors = '$colors',
        material = '$material',
        gender = '$gender'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION["update"] = "<div class='success'>Featured Product Updated Successfully</div>";
            header("location: sm-new-arrivals.php");
            exit;
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update Featured Product. Try Again Later!!</div>";
            header("location: update-sm-new-arrival.php");
            exit;
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