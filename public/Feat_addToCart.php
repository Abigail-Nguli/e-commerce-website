<?php 
    include('config/constants.php');

    // Retrieve the username from the session
    if(!isset($_SESSION["user"]))
    {
      header("location: cartlogin.php"); 
    }
    else
    {
      $username = $_SESSION['user'];
      $sql2 = "SELECT * FROM login_tbl WHERE username = '$username'";
      $res2 = mysqli_query($conn, $sql2);

      if ($res2 && mysqli_num_rows($res2) > 0) {
          $row = mysqli_fetch_assoc($res2);
          $user_id = $row['id'];
      }
    }

// Fetch product details
if (isset($_GET['product_id'])) {
    $product_id =  $_GET['product_id'];

    $sql2 = "SELECT * FROM featured_products WHERE id = '$product_id'";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 && mysqli_num_rows($res2) > 0) {
        $row = mysqli_fetch_assoc($res2);
        $product_title = $row['title'];
        $product_price = $row['price'];
        $image_name1 = $row['image_name'];
        $product_description = $row['description'];
    } else {
        // Redirect if product not found
        header("Location: index.php");
        exit;
    }
}

include('Partials-Front/menu.php');
?>


    <div id="message">
        <?php 
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Display session message
            unset($_SESSION['add']); // Remove session message
        }
        ?>
    </div>

    <section id="prodetails" class="section-p1">
        <form method="POST" action="">
        <?php 
          $sql3 = "SELECT * FROM sm_feat_products WHERE title = '$product_id'";

            $res3 = mysqli_query($conn, $sql3);

            if($res3==TRUE){
                $count = mysqli_num_rows($res3);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res3))
                    {
                        //Get Individual Data
                        $color1=$rows['color1'];
                        $color2=$rows['color2'];
                        $color3=$rows['color3'];
                        $color4=$rows['color4'];
                        $color5=$rows['color5'];
                        $price=$rows['price'];
                        $description=$rows['description'];
                        $product_details=$rows['product_details'];
                        $colors=$rows['colors'];
                        $material=$rows['material'];
                        $gender=$rows['gender'];
          ?>  
            <div class="single-pro-image">
                <?php 
                if (!empty($image_name1)) {
                    echo "<img src='Images/Featured Products/$image_name1' id='MainImg' width='100%'>";
                } else {
                    echo "<div class='error'>Image not available</div>";
                }
                ?>

            
        <div class="small-img-group">
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color2=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/Featured Products/Small Products/<?php echo $color2; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color3=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/Featured Products/Small Products/<?php echo $color3; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color4=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/Featured Products/Small Products/<?php echo $color4; ?>" class="small-img" width="100%">
            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color5=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/Featured Products/Small Products/<?php echo $color5; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
        </div>
      </div>

        <div class="single-pro-details">
                <h6>Home / <?php echo htmlspecialchars($product_title); ?></h6>
                <h4><?php echo htmlspecialchars($product_description); ?></h4>
                <h2><?php echo htmlspecialchars($product_price); ?></h2>
                <select name="size">
                    <option>XL</option>
                    <option>XXL</option>
                    <option>Small</option>
                    <option>Large</option>
                </select>
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($product_title); ?>">
                <input type="hidden" name="image_name" value="<?php echo htmlspecialchars($image_name1); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product_price); ?>">
                <input type="number" class="num" name="qty" value="1" required />
                <input type="submit" name="submit" value="Add To Cart" class="buy" />
                <a href="order.php?forder_id=<?php echo $product_id; ?>" class="buy">Buy Now</a>
                <h4>Product Details</h4>
          <span>
            <?php echo $product_details; ?>
            <br><br> <strong>Colors:</strong> <?php echo $colors; ?> <br> <strong>Material:</strong> <?php echo $material; ?> <br> <strong>Gender:</strong> <?php echo $gender; ?>
          </span>
        </div>
        <?php
        }
      }
    }
    ?>
        </form>
    </section>

    <footer class="section-p1">
        <div class="copyright">
            <p><i class="fa-regular fa-copyright"></i> 2024, Abigail Nguli - Online Baby Shop</p>
        </div>
    </footer>
    <?php 
      // Process adding item to the cart when the form is submitted
      if (isset($_POST['submit'])) {
          // Get form values
          $title = $_POST['title'];
          $user_id = $user_id;
          $image_name = $_POST['image_name'];
          $price = $_POST['price'];
          $size = $_POST['size'];
          $qty = $_POST['qty'];
          $total = $price * $qty;

          //Prepared statement to prevent SQL injection
          $sql = "INSERT INTO cart_tbl SET title = ?, user_id = ?, image_name = ?, price = ?, size = ?, qty = ?, total = ?";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, "sssissi", $title, $user_id, $image_name, $price, $size, $qty, $total);
          $res = mysqli_stmt_execute($stmt);


          if ($res) {
              $_SESSION["add"] = "<div class='success'>Item successfully added to your cart!</div>";
              header("Location: cart.php");
              exit;
          } else {
              $_SESSION["add"] = "<div class='error'>Failed to add item to the cart. Please try again! Error: " . mysqli_error($conn) . "</div>";
          }
      }

      ob_end_flush();
    ?>

    <script>
        // Thumbnail image functionality
        var MainImg = document.getElementById("MainImg");
        var Smallimg = document.getElementsByClassName("small-img");

        for (let i = 0; i < Smallimg.length; i++) {
            Smallimg[i].onclick = function () {
                MainImg.src = Smallimg[i].src;
            };
        }

        // Hide message after 5 seconds
        setTimeout(function() {
            var message = document.getElementById('message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>