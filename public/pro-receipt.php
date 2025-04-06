<?php 
    include('config/constants.php');
    include('Partials-Front/menu.php');

    // Check if the user is logged in
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
                        $sql2 = "SELECT * FROM tbl_order WHERE id=$order_id";

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
                  <td>STATUS</td>
                  <td>PRODUCT</td>
                  <td>PRICE</td>
                  <td>QUANTITY</td>
                  <td>SUBTOTAL</td>
                </tr>
              </thead>
              <?php 
                if(isset($_GET['order_id']))
                    {
                    $order_id = $_GET['order_id'];
                    $sql = "SELECT * FROM tbl_order WHERE id=$order_id";//Display latest product first

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
                                $product = $rows["product"];
                                $image_name = $rows["image_name"];
                                $price = $rows["price"];
                                $qty = $rows["qty"];
                                $sub_total = $rows["sub_total"];   
                                $status = $rows["status"];    
                    ?>
              <tbody>
                <tr>
                  <td>
                    <?php 
                            //Is image available?
                            if($image_name==""){
                                //Image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                <img src="Images/Featured Products/<?php echo $image_name; ?>">
                                <?php
                            }
                        ?>
                  </td>
                  <td>
                      <?php 
                          //Delivery Statuses
                          if($status=="Ordered")
                          {
                              echo "<label>$status</label>";
                          }
                          else if($status=="On Delivery")
                          {
                              echo "<label style='color: orange;'>$status</label>";
                          }
                          else if($status=="Delivered")
                          {
                              echo "<label style='color: green;'>$status</label>";
                          }
                          else if($status=="Cancelled")
                          {
                              echo "<label style='color: red;'>$status</label>";
                          }
                      ?>
                      
                  </td>
                  <td> <?php echo $product; ?></td>
                  <td>KES  <?php echo $price; ?></td>
                  <td> <?php echo $qty; ?></td>
                  <td>KES  <?php echo $sub_total; ?></td>
                </tr>
                <?php
                        }
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
                        $sql3 = "SELECT * FROM tbl_order WHERE id=$order_id";

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
      <a href="shop.php"><button class="exit">EXIT</button></a>
    </section>

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