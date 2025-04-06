 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <h1>Manage Small New Arrivals</h1>
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



        <a href="add-sm-new-arrival.php" class="primary-btn">Add New Arrival</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Color1</th>
                <th>Color2</th>
                <th>Color3</th>
                <th>Color4</th>
                <th>Color5</th>
                <th>Product</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>


        <?php 
            $sql = "SELECT * FROM sm_new_arrivals";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id=$rows['id'];
                        $color1=$rows['color1'];
                        $color2=$rows['color2'];
                        $color3=$rows['color3'];
                        $color4=$rows['color4'];
                        $color5=$rows['color5'];
                        $price=$rows['price'];
                        $title=$rows['title'];
                        $description=$rows['description'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>

                            <td>
                                <?php 
                                    if($color1!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/New Arrivals/Small Products/<?php echo $color1; ?>" width="50px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>


                            <td>
                                <?php 
                                    if($color2!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/New Arrivals/Small Products/<?php echo $color2; ?>" width="50px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>

                                                        
                            <td>
                                <?php 
                                    if($color3!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/New Arrivals/Small Products/<?php echo $color3; ?>" width="50px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>


                            <td>
                                <?php 
                                    if($color4!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/New Arrivals/Small Products/<?php echo $color4; ?>" width="50px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>

                            <td>
                                <?php 
                                    if($color5!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/New Arrivals/Small Products/<?php echo $color5; ?>" width="50px"> 
                                            
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
                                <a href="update-sm-new-arrival.php?id=<?php echo $id; ?>" class="secondary-btn"><i class="fa-solid fa-file-pen"></i>Update</a>
                                <a href="delete-sm-new-arrival.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete All New Arrivals?');"><i class="fa-solid fa-trash"></i>Delete</a>
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