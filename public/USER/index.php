 <?php 
    include('menu.php');
 ?>
      
    <section id="home">
      <?php 
          $sql = "SELECT * FROM login_tbl WHERE username = '$username'";

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
                      $full_name = $rows["full_name"];
                      $image_name = $rows["image_name"];
                      $username = $rows["username"];
                      $user_type = $rows["user_type"];
              
      ?>
      <p>Hello <?php echo $full_name ?>👋🏾</p>
      <p>View and Manage your Details Here.</p>
    </section>

  <div class="container"> 
    <section id="details">
      <h2>My Details</h2>
        <div class="img-container">
          <div class="user-img">
            <?php 
              //Is image available?
              if (!empty($image_name)) 
              {
                $safe_image_name = basename($image_name); // Sanitize the filename
                $image_path = "../Images/Profile Photos/" . $safe_image_name;

                if (file_exists($image_path)) {
                    ?>
                    <img src="<?php echo $image_path; ?>" width="100px">
                    <?php
                } else {
                    ?>
                    <img src="../Images/Profile.jpeg" width="100px">
                    <?php
                }
            } 
            else 
            {
                ?>
                <img src="../Images/Profile.jpeg" width="100px">
                <?php
            }
            ?>
          <!--<img src="../Images/Profile.jpeg" alt="" width="100px" />-->
        </div>
        <div class="img-details">
          <a href="update-pp.php?user_id=<?php echo $user_id; ?>" class="details-btn">Upload New Photo</a>
          <p>At least 800 * 800 px recommended.</p>
          <p>JPG or PNG is allowed</p>
        </div>
        <div class="delete">
          <a href="../delete-acc.php?user_id=<?php echo $user_id; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete your account?');"><i class="fa-solid fa-trash"></i>Delete Account</a>
        </div>
        </div>

        <div class="personal-info">
            <div class="top-info">
                <h3>Personal Info</h3>
                <a href="update-acc.php?user_id=<?php echo $user_id; ?>" class="details-btn"><i class="fa-solid fa-file-pen"></i>Edit</a>
            </div>
            <div class="bottom-info">
                <table class="tbl-full">
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>User Type</th>
                    </tr>

                        <tr> 
                            <td><?php echo $full_name; ?></td>

                            <td>
                                <?php echo $username; ?>
                            </td> 
        
                            <td>
                                <?php echo $user_type; ?>
                            </td>     

                            </tr>

                        <?php
                                
                            }
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='12' class='error'>Error Obtaining user details</td></tr>";
                    }
                ?>

                </table>
            </div>
        </div>
    </section>

    <section id="cart-details">
      <h2>Cart</h2>
      <section id="cart" class="section-p1">

      <table width="100%">
        <thead>
          <tr>
            <td>Remove</td>
            <td>Image</td>
            <td>Product</td>
            <td>Price</td>
            <td>Size</td>
            <td>Quantity</td>
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
                        $user_id = $rows["user_id"];
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
                    <a href="../delete-cart1.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete cart item?');"><i class="fa-solid fa-circle-xmark"></i></a>
                </td>
                <td>
                    <?php 
                        //Is image available?
                        if (!empty($image_name) && file_exists("../Images/Featured Products/" . $image_name)) 
                        {
                    ?>

                    <img src="../Images/Featured Products/<?php echo $image_name; ?>">

                    <?php
                        } elseif (!empty($image_name) && file_exists("../Images/New Arrivals/" . $image_name)) {
                            ?>
                            <img src="../Images/New Arrivals/<?php echo $image_name; ?>">
                            <?php
                        } else {
                            echo "<div class='error'>Image Not Available</div>";
                        }
                    ?>
                </td>
                <td>
                    <?php echo $title; ?>
                </td>
                <td><?php echo $price; ?></td>
                <td><?php echo $size; ?></td>
                <td><?php echo $qty; ?></td>
            </tr>
            <?php
                  }
                }
                else
                {
                  echo "<tr><td colspan='12' class='error'>No Items Added To Cart</td></tr>";
                }
            }
            ?>
        </tbody>
      </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <?php   
                    $sql4 = "SELECT SUM(total) AS Total FROM cart_tbl WHERE user_id = '$user_id'";

                    $res4 = mysqli_query($conn, $sql4);

                    $row4 = mysqli_fetch_assoc($res4);

                    $cart_total = $row4['Total'];
                    $tax = 0.16 * $cart_total;
                    $sum_total = $cart_total + $tax;
                ?>
                    <td>
                      <?php echo $cart_total; ?>
                    </td>
                </tr>
                <tr> <td>VAT</td>
                <td><?php echo $tax; ?></td></tr>
                <tr> <td>Shipping</td>
                <td>Free</td></tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong><?php echo $sum_total; ?></strong></td>
                </tr>
            </table>
            <a href="../cart-order.php?user_id=<?php echo $user_id; ?>"><button class="normal">Proceed to checkout</button></a>
        </div>
    </section>
    </section>

    <section id="orders">
      <div class="main-content">
        <div class="wrapper">
        <h2>My Orders</h2>

        <section id="receipt" class="section-p1">
          <div>
            <div class="header section-p1">CUSTOMER RECEIPT</div>
            <?php 
                $sql2 = "SELECT * FROM tbl_order WHERE user_id = '$user_id' LIMIT 1";

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
                    src="../Images/Logo.jpeg"
                    alt="Company Logo"
                    class="logo"
                    width="10%"
                  />
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
                        $sql = "SELECT * FROM tbl_order WHERE user_id = '$user_id' ORDER BY id DESC";

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
                                if (!empty($image_name) && file_exists("../Images/Featured Products/" . $image_name)) {
                                            ?>
                                            <img src="../Images/Featured Products/<?php echo $image_name; ?>">
                                            <?php
                                        } elseif (!empty($image_name) && file_exists("../Images/New Arrivals/" . $image_name)) {
                                            ?>
                                            <img src="../Images/New Arrivals/<?php echo $image_name; ?>">
                                            <?php
                                        } else {
                                            echo "<div class='error'>Image Not Available</div>";
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
                        else
                        {
                          echo "<tr><td colspan='12' class='error'>No Items Ordered</td></tr>";
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </section>
              <div class="subtotal">
                <h3>Orders Total</h3>
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <?php 

                        $sql3 = "SELECT SUM(sub_total) AS Sub_Total FROM tbl_order WHERE user_id = '$user_id'";
                        $sql4 = "SELECT SUM(tax) AS Tax FROM tbl_order WHERE user_id = '$user_id'";
                        $sql5 = "SELECT SUM(total) AS Total FROM tbl_order WHERE user_id = '$user_id'";

                        $res3 = mysqli_query($conn, $sql3);
                        $res4 = mysqli_query($conn, $sql4);
                        $res5 = mysqli_query($conn, $sql5);

                        $row3 = mysqli_fetch_assoc($res3);
                        $row4 = mysqli_fetch_assoc($res4);
                        $row5 = mysqli_fetch_assoc($res5);

                        $sub_total = $row3['Sub_Total'];   
                        $tax = $row4['Tax']; 
                        $total = $row5['Total']; 
                                    
                        ?>
                        <td>
                          <strong><?php echo $sub_total; ?></strong>
                        </td>
                    </tr>
                    <tr> <td>Shipping Fee</td>
                    <td><strong>Free</strong></td></tr>
                    <tr> <td>Value Added Tax</td>
                    <td><strong><?php echo $tax; ?></strong></td></tr>
                    <tr> <td>Orders Total</td>
                    <td><strong><?php echo $total; ?></strong></td></tr>
                </table>
                
            </div>
                  
            </div>
          </div>
          <!--<a href="order-cart-delete"><button class="exit">EXIT</button></a>-->
          </section>
        </div>
      </div>    
    </section>

    <section id="form-details">
      <form name="submit-to-google-sheet">
        <span>LEAVE A MESSAGE</span>
        <h2>We love to hear from you</h2>
        <input type="text" name="Name" placeholder="Your Name" required />
        <input type="email" name="Email" placeholder="Your Email" required />
        <textarea
          name="Message"
          cols="30"
          rows="10"
          placeholder="Your Message"
        ></textarea>
        <span id="msg"></span>
        <button type="submit" class="normal">Submit</button>
      </form>

      <div class="people">
        <div>
          <img src="../Images/Profile.jpeg" alt="" width="80px" height="80px" />
          <p>
            <span>Abigail Nguli</span> Marketing Director <br />
            Phone: +254 712 345 678 <br />Email: abigail@gmail.com
          </p>
        </div>
        <div>
          <img src="../Images/Profile.jpeg" alt="" width="80px" height="80px" />
          <p>
            <span>Travis Wanyoike</span> Social Media Manager <br />
            Phone: +254 756 890 234 <br />Email: travis@gmail.com
          </p>
        </div>
        <div>
          <img src="../Images/Profile.jpeg" alt="" width="80px" height="80px" />
          <p>
            <span>Jasmine Muthoni</span> Accountant <br />
            Phone: +254 709 889 563 <br />Email: jasmine@gmail.com
          </p>
        </div>
      </div>
    </section>
    </div>

    <script src="../script.js"></script>
    <script> 
      // JavaScript to hide message after 5 seconds 
      setTimeout(function() { 
          var message = document.getElementById('message'); 
          if (message) { 
              message.style.display = 'none'; } 
      }, 5000); 
      // 5000 milliseconds = 5 seconds

      const scriptURL =
        "https://script.google.com/macros/s/AKfycbzghUU8f0Tt3obrjXbBQ89_4hIntofAg9i-r1uymAgL_0z13y3p1pkmWMuSlk1xkNHj/exec";
      const form = document.forms["submit-to-google-sheet"];
      const msg = document.getElementById("msg");

      form.addEventListener("submit", (e) => {
        e.preventDefault();
        fetch(scriptURL, { method: "POST", body: new FormData(form) })
          .then((response) => {
            msg.innerHTML = "Message sent successfully😊";
            setTimeout(function () {
              msg.innerHTML = "";
            }, 5000);
            form.reset();
          })
          .catch((error) => console.error("Error!", error.message));
      });
    </script>
  </body>
</html>
