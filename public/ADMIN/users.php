 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <br>
        <h1>Manage Registered Users</h1>
        <br>

        <div id="message">

            <?php 
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

        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>


        <?php 
            $sql = "SELECT * FROM login_tbl";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $image_name=$rows['image_name'];
                        $username=$rows['username'];
                        $user_type=$rows['user_type'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>

                            <td>
                                <?php 
                                    if($image_name!="")
                                    {
                                        //Display the image
                                        ?>

                                            <img src="../Images/Profile Photos/<?php echo $image_name; ?>" width="100px"> 
                                            
                                        <?php
                                        
                                        
                                    }
                                    else
                                    {
                                        //Display the default image
                                        ?>

                                            <img src="../Images/Profile.jpeg" width="100px"> 
                                            
                                        <?php
                                    }
                                ?>
                            </td>

                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><b><?php echo $user_type; ?></b></td>
                            <td>
                                <a href="update-user.php?id=<?php echo $id; ?>" class="secondary-btn"><i class="fa-solid fa-file-pen"></i>Update</>
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