<?php 
    include('config/constants.php');
    include('Partials-Front/menu.php');

    include('login-check.php');
?>

    <div id="message">
        <?php 

            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];//Display Session Message
                unset($_SESSION['order']);//Remove Session Message
            }
            
        ?>
    </div>

    <section id="receipt" class="section-p1">
      <div class="container">
        <div class="header section-p1">CUSTOMER RECEIPT</div>
        <?php 
                    if(isset($_GET['order_id']))
                    {
                        $order_id = $_GET['order_id'];
                        // Retrieve order details using $order_id
                        $sql2 = "SELECT * FROM tbl_order WHERE id = '$order_id'";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==TRUE)
                    {
                        $count2 = mysqli_num_rows($res2);

                        $sn=1;

                            if($count2>0){
                            while($rows=mysqli_fetch_assoc($res2))
                            {
                                //Get Individual Data
                                $customer_name = $rows["customer_name"];
                                $customer_contact = $rows["customer_contact"];
                                $customer_address = $rows["customer_address"];
                    ?>

                    <div class="customer-info">
                      <p>Name: <strong><?php echo $customer_name; ?></strong></p>
                      <p>Contact: <strong><?php echo $customer_contact; ?></strong></p>
                      <p>Address: <strong><?php echo $customer_address; ?></strong></p>
                    </div>
                      <?php
                            }
                          }
                        }
                      }
                      ?>
        <div class="invoice">
          <div class="top">
            <div class="left">
              <p>Receipt</p>
              <hr />
              <p>TOTO ONLINE SHOP</p>
            </div>
            <div class="right">
              <img
                src="Images/Logo.jpeg"
                alt="Company Logo"
                class="logo"
                width="10%"
              />
            </div>
          </div>
          <section id="cart" class="section-p1">
            <table width="100%">
              <thead>
                <tr>
                  <td>IMAGE</td>
                  <td>PRODUCT</td>
                  <td>PRICE</td>
                  <td>QUANTITY</td>
                  <td>SUBTOTAL</td>
                </tr>
              </thead>
              <?php 
                    $sql = "SELECT * FROM cart_tbl WHERE user_id = '$user_id' ORDER BY id DESC";//Display latest product first

                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        $sn=1;

                            if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Get Individual Data
                                $id = $rows["id"];
                                $title = $rows["title"];
                                $image_name = $rows["image_name"];
                                $price = $rows["price"];
                                $size = $rows["size"];  
                                $qty = $rows["qty"];
                                $total = $rows["total"];    
                    ?>
              <tbody>
                <tr>
                  <td>
                    <?php 
                            if (!empty($image_name) && file_exists("Images/Featured Products/" . $image_name)) {
                                        ?>
                                        <img src="Images/Featured Products/<?php echo $image_name; ?>">
                                        <?php
                                    } elseif (!empty($image_name) && file_exists("Images/New Arrivals/" . $image_name)) {
                                        ?>
                                        <img src="Images/New Arrivals/<?php echo $image_name; ?>">
                                        <?php
                                    } else {
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                        ?>
                  </td>
                  <td> <?php echo $title; ?></td>
                  <td>KES  <?php echo $price; ?></td>
                  <td> <?php echo $qty; ?></td>
                  <td>KES  <?php echo $total; ?></td>
                </tr>
                <?php

                      }
                    }
                  }
                  else
                    {
                      echo "<tr><td colspan='12' class='error'>No Items Ordered</td></tr>";
                    }
                ?>
              </tbody>
            </table>
          </section>
          <div class="subtotal">
            <h3>Order Total</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <?php 
                    if(isset($_GET['order_id']))
                    {
                    $order_id = $_GET['order_id'];

                    // Retrieve order details using $order_id
                    $sql3 = "SELECT * FROM tbl_order WHERE id ='$order_id'";

                    $res3 = mysqli_query($conn, $sql3);

                    if($res3==TRUE)
                    {
                        $count3 = mysqli_num_rows($res3);

                        $sn=1;

                            if($count3>0){
                            while($rows=mysqli_fetch_assoc($res3))
                            {
                                //Get Individual Data

                                $total = $rows["total"];    
                                $tax = $rows["tax"];  
                                $sub_total = $rows["sub_total"];    
                                
                    ?>
                    <td>
                      <strong><?php echo $sub_total; ?></strong>
                    </td>
                </tr>
                <tr> <td>Shipping Fee</td>
                <td><strong>Free</strong></td></tr>
                <tr> <td>Value Added Tax</td>
                <td><strong><?php echo $tax; ?></strong></td></tr>
                <tr> <td>Order Total</td>
                <td><strong><?php echo $total; ?></strong></td></tr>
            </table>
            <?php
                            }
                          }
                        }
                      }
            ?>
        </div>
              
        </div>
      </div>
      <a href="delete-cart"><button class="exit">EXIT</button></a>
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

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>