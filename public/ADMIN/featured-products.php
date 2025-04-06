 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <h1>Manage Featured Products</h1>
        <br><br>

        <div id="message">

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Display Session Message
                    unset($_SESSION['add']);//Remove Session Message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Display Session Message
                    unset($_SESSION['delete']);//Remove Session Message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];//Display Session Message
                    unset($_SESSION['update']);//Remove Session Message
                }

                if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Display Session Message
                    unset($_SESSION['remove-failed']);//Remove Session Message
                }
            ?>

        </div>
        <br>
        <br>



        <a href="add-Fproduct.php" class="primary-btn">Add Featured</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>


        <?php 
            $sql = "SELECT * FROM featured_products";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        $description=$rows['description'];
                        $price=$rows['price'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>

                            <td>
                                <?php 
                                    if($image_name!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/Featured Products/<?php echo $image_name; ?>" width="100px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $title; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <a href="update-Fproduct.php?id=<?php echo $id; ?>" class="secondary-btn"><i class="fa-solid fa-file-pen"></i>Update</a>
                                <a href="delete-Fproduct.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete Featured Product?');"><i class="fa-solid fa-trash"></i>Delete</a>
                            </td>
                         </tr>

                        <?php
                    }
                }
            }
        ?>

        </table>
        
    </div>
        </div>

 <?php include('partials/footer.php')?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>