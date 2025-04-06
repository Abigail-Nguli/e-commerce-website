<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add New Arrival</h1>
        <br>
        <br>

        <div id="message">

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Display Session Message
                    unset($_SESSION['add']);//Remove Session Message
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
        </div>
        <br>
        <br>
        
        
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Product: </td>
                    <td>
                        <select name="product">

                        <?php
                        $sql2 = "SELECT * from new_arrivals";
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2) {
                            while($row = mysqli_fetch_assoc($res2)) {
                                $id = $row['id'];
                                $title = $row['title'];

                            ?>
                
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                            }
                        } else {
                            echo "<option value='0'>No New Arrival Found</option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td>Color 1: </td>
                    <td>
                        <input type="file" name="image1">
                    </td>
                </tr>
                <tr>
                    <td>Color 2: </td>
                    <td>
                        <input type="file" name="image2">
                    </td>
                </tr>
                <tr>
                    <td>Color 3: </td>
                    <td>
                        <input type="file" name="image3">
                    </td>
                </tr>
                <tr>
                    <td>Color 4: </td>
                    <td>
                        <input type="file" name="image4">
                    </td>
                </tr>
                <tr>
                    <td>Color 5: </td>
                    <td>
                        <input type="file" name="image5">
                    </td>
                </tr>                
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Product Description" cols="22" rows="4"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Product Details: </td>
                    <td><textarea name="product_details" placeholder="Product Details" cols="22" rows="4"></textarea></td>
                </tr>
                <tr>
                    <td>Colors: </td>
                    <td><input type="text" name="colors"></td>
                </tr> 
                <tr>
                    <td>Material: </td>
                    <td><input type="text" name="material"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="Male"> Male
                        <input type="radio" name="gender" value="Female"> Female
                        <input type="radio" name="gender" value="Unisex"> Unisex
                    </td>
                 </tr>     
                                         
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Arrivals" class="primary-btn">
                    </td>
                </tr>
            </table>

        </form>
        
    </div>
</div>

<?php include('partials/footer.php')?>


<?php 
    if(isset($_POST['submit'])){

        //Get Data
        $title = $_POST['product'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $product_details = $_POST['product_details'];
        $colors = $_POST['colors'];
        $material = $_POST['material'];

        //For radio input type check whether the button is selected or Unisext
        if(isset($_POST['gender']))
        {
            $gender = $_POST['gender'];
        }
        else{
            $gender = "Unisex";
        }      

        //Check whether image is selected or Unisext and set value for image name
        if(isset($_FILES['image1']['name']))
        {
            //Get the image name, source path and destination path
            $color1 = $_FILES['image1']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $color1);
            $ext = end($temp);

            //Rename the image eg. onesies_123.jpg
            $color1 = "sm_New_Arrival_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image1']['tmp_name'];

            $destination_path = "../Images/New Arrivals/Small Products/".$color1;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or Unisext
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-sm-new-arrival.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $color1 = "";
        }

        if(isset($_FILES['image2']['name']))
        {
            //Get the image name, source path and destination path
            $color2 = $_FILES['image2']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $color2);
            $ext = end($temp);

            //Rename the image eg. Food_Category_123.jpg
            $color2 = "sm_New_Arrival_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image2']['tmp_name'];

            $destination_path = "../Images/New Arrivals/Small Products/".$color2;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or Unisext
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-sm-new-arrival.php');

                //Stop the process
                die();
            }
        }
        else{
            //Don't upload image and set image name value as blank
            $color2 = "";
        }

        if(isset($_FILES['image3']['name']))
        {
            //Get the image name, source path and destination path
            $color3 = $_FILES['image3']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $color3);
            $ext = end($temp);

            //Rename the image eg. Food_Category_123.jpg
            $color3 = "sm_New_Arrival_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image3']['tmp_name'];

            $destination_path = "../Images/New Arrivals/Small Products/".$color3;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or Unisext
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-sm-new-arrival.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $color3 = "";
        }

        if(isset($_FILES['image4']['name']))
        {
            //Get the image name, source path and destination path
            $color4 = $_FILES['image4']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $color4);
            $ext = end($temp);

            //Rename the image eg. Food_Category_123.jpg
            $color1 = "sm_New_Arrival_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image4']['tmp_name'];

            $destination_path = "../Images/New Arrivals/Small Products/".$color4;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or Unisext
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-sm-new-arrival.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $color4 = "";
        }

        if(isset($_FILES['image5']['name']))
        {
            //Get the image name, source path and destination path
            $color5 = $_FILES['image5']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $color5);
            $ext = end($temp);

            //Rename the image eg. Food_Category_123.jpg
            $color5 = "sm_New_Arrival_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image5']['tmp_name'];

            $destination_path = "../Images/New Arrivals/Small Products/".$color5;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or Unisext
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-sm-new-arrival.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $color5 = "";
        }

        //Save Data
        $sql = "INSERT INTO sm_new_arrivals SET
            title = '$title',
            color1 = '$color1',
            color2 = '$color2',
            color3 = '$color3',
            color4 = '$color4',
            color5 = '$color5',
            description = '$description',
            price = '$price',
            product_details = '$product_details',
            colors = '$colors',
            material = '$material',
            gender = '$gender'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['add'] = "<div class='success'>Products Added Successfully</div>";
 
            header("location: sm-new-arrivals.php");
        }
        else{
            $SESSION['add'] = "<div class='error'>❌Failed to Add Products. Try Again Later!!</div>";

            header("location: add-sm-new-arrival.php");
        }
    }
?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'Unisexne'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>