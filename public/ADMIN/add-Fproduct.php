<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Featured Product</h1>
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
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Featured Title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Featured Description" cols="22" rows="4"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Featured" class="primary-btn">
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
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']))
        {
            //Get the image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //Auto rename image
            //Get the extension eg. onesies.jpg
            $temp = explode('.', $image_name);
            $ext = end($temp);

            //Rename the image eg. Food_Category_123.jpg
            $image_name = "Featured_Product_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../Images/Featured Products/".$image_name;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or not
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location: add-Fproduct.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $image_name = "";
        }


        //Save Data
        $sql = "INSERT INTO featured_products SET
            title = '$title',
            image_name = '$image_name',
            description = '$description',
            price = '$price'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['add'] = "<div class='success'>Featured Product Added Successfully</div>";

            header("location: featured-products.php");
        }
        else{
            $SESSION['add'] = "<div class='error'>❌Failed to Add Featured Product. Try Again Later!!</div>";

            header("location: add-Fproduct.php");
        }
    }
?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>