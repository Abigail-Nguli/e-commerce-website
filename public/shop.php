 <?php 
    include('config/constants.php');
    include('Partials-Front/menu.php');
 ?>

    <div id="message">
        <?php 
          if(isset($_SESSION['signup']))
          {
              echo $_SESSION['signup'];
              unset($_SESSION['signup']);
          }

              if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Display Session Message
                unset($_SESSION['add']);//Remove Session Message
            }
        ?>
    </div>

    <section id="page-header">
      <h2>#buynow</h2>
      <p>Save more with coupons & up to 70% off!</p>
    </section>

    <section id="product1" class="section-p1">
      <div class="pro-container">
        <?php 
              //Query to display categories from database
              $sql = "SELECT * FROM featured_products";

              $res = mysqli_query($conn, $sql);

              //Count rows to check whether the featured products is available
              $count = mysqli_num_rows($res);

              if($count>0)
              {
                //Featured is Available
                while($row = mysqli_fetch_assoc($res))
                {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  $description = $row['description'];
                  $price = $row['price'];
                  ?>
                      <?php 
                        //Is Image Available?
                        if($image_name=="")
                        {
                          echo "<div class='error'>Image Not Available</div>";
                        }
                        else{
                          ?>
                          <div class="pro">
                            <img
                              src="Images/Featured Products/<?php echo $image_name; ?>"
                            />
                          <?php
                        }
                      ?>
                      
                    <div class="description">
                    <span><?php echo $title; ?></span>
                    <h5><?php echo $description; ?></h5>
                    <div class="star">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>

                    <h4><?php echo $price; ?></h4>
            </div>

            <?php 
              $product_id = $id; 

              if (isset($_SESSION['user'])) 
              {
                 if (isset($_SESSION['user_type'])) 
                  {
                      $user_type = $_SESSION['user_type'];
                      if ($user_type === 'USER') 
                      {
                        // User is logged in, redirect directly to Feat_addToCart.php
                        echo '<a href="Feat_addToCart.php?product_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
                      } 
                      else
                      {
                        echo '<a href="cartlogin.php?redirect_product_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
                      }
                  }
              }
              else
              {
                echo '<a href="cartlogin.php?redirect_product_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
              }

            ?>

            </div>
            <?php
                }
              }
              else{
                //Featured Products not available
                echo "<div class='error'>No Featured Products😫</div>";
              }

              //Query to display categories from database
              $sql = "SELECT * FROM new_arrivals";

              $res = mysqli_query($conn, $sql);

              //Count rows to check whether the arrival is available
              $count = mysqli_num_rows($res);

              if($count>0)
              {
                //Arrival is Available
                while($row = mysqli_fetch_assoc($res))
                {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  $description = $row['description'];
                  $price = $row['price'];

                        //Is Image Available?
                        if($image_name=="")
                        {
                          echo "<div class='error'>Image Not Available</div>";
                        }
                        else{
                          ?>
                          <div class="pro">
                            <img
                              src="Images/New Arrivals/<?php echo $image_name; ?>"
                            />
                          <?php
                        }
                      ?>
                      
                    <div class="description">
                    <span><?php echo $title; ?></span>
                    <h5><?php echo $description; ?></h5>
                    <div class="star">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>

                    <h4><?php echo $price; ?></h4>
            </div>
            <?php 
                $product_id = $id; 

                if (isset($_SESSION['user'])) 
                {
                  if (isset($_SESSION['user_type'])) 
                  {
                      $user_type = $_SESSION['user_type'];
                      if ($user_type === 'USER') 
                      {
                        // User is logged in, redirect directly to NA_addToCart.php
                        echo '<a href="NA_addToCart.php?Nproduct_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
                      } 
                      else
                      {
                        echo '<a href="cartlogin.php?redirect_Nproduct_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
                      }
                  }
                }
                else
                {
                  echo '<a href="cartlogin.php?redirect_Nproduct_id=' . urlencode($product_id) . '"><i class="fas fa-shopping-cart cart"></i></a>';
                }
              ?>
            </div>
            <?php
                }
              }
              else{
                //Arrivals not available
                echo "<div class='error'>No New Arrivals😫</div>";
              }
            ?>

      </div>
    </section>

    <section id="pagination" class="section-p1">
      <a href="#">1</a>
      <a href="#"><i class="fa-solid fa-right-long"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
      <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>
          Get E-mail updates about our latest shop and
          <span>special offers.</span>
        </p>
      </div>
      <form action="#" method="POST">
        <div class="form">
          <input type="text" name="email" placeholder="Your Email Address" />
          <input type="submit" name="submit" value="Sign Up" class="normal">
      </div>
      </form>
    </section>

    <footer class="section-p1">
      <div class="col col1">
        <img src="Images/Logo.jpeg" alt="" class="logo" />
        <h4>Contact</h4>
        <p><strong>Address:</strong> 234 Kenyatta Avenue, Nairobi</p>
        <p><strong>Phone:</strong> +254 712 345 678/ +254 119 876 543</p>
        <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
        <div class="follow">
          <h4>Follow us</h4>
          <div class="icon">
            <i class="fa-brands fa-x-twitter"></i>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-pinterest"></i>
            <i class="fa-brands fa-youtube"></i>
          </div>
        </div>
      </div>

      <div class="col">
        <h4>About</h4>
        <a href="#">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy POlicy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
      </div>

      <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
      </div>

      <div class="col install">
        <h4>Install App</h4>
        <p>From App Store or Google Play</p>
        <div class="row">
          <img src="Images/App Store.jpeg" alt="" />
          <img src="Images/Google Play.jpeg" alt="" />
        </div>
        <p>Secured Payment Gateways</p>
        <img src="Images/Payment.jpeg" alt="" class="payment" />
      </div>

      <div class="copyright">
        <p>
          <i class="fa-regular fa-copyright"></i> 2024, Abigail Nguli - Online
          Baby Shop
        </p>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>

<?php 
    if(isset($_POST['submit'])){

        //Get Data
        $email = $_POST['email'];

        //Save Data
        $sql = "INSERT INTO newsletters_tbl SET
            email = '$email'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
            $_SESSION['signup'] = "<div class='success'>You have successfully Signed Up for Email Updates😊</div>";

            header("Location: shop.php");
        }
        else{
            $SESSION['signup'] = "<div class='error'>❌Failed to Sign Up for Newsletters. Try Again Later!!</div>";

            header("Location: shop.php");
            exit;
        }
    }
?>


        <script> 
            // JavaScript to hide message after 5 seconds 
            setTimeout(function() 
            { 
                var message = document.getElementById('message'); 
                if (message) { 
                    message.style.display = 'none'; } 
            }, 5000); 
            // 5000 milliseconds = 5 seconds
        </script>