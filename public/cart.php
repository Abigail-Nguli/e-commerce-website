 <?php 
    include('config/constants.php');
    include('Partials-Front/menu.php');

    include('login-check.php');
 ?>

    <section id="page-header" class="about-header">
      <h2>#You loved these</h2>
      <p>Order Now!</p>
    </section>

    <div id="message">
        <?php 
            if(isset($_SESSION['login']))
            {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
            }

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
        ?>
    </div>

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
                    <a href="delete-cart1.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete cart item?');"><i class="fa-solid fa-circle-xmark"></i></a>
                </td>
                <td>
                    <?php 
                            //Is image available?
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
              }
              else
                {
                  echo "<tr><td colspan='12' class='error'>No Items Added To Cart</td></tr>";
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
                    $sql4 = "SELECT SUM(total) AS Total FROM cart_tbl";

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
            <a href="cart-order.php"><button class="normal">Proceed to checkout</button></a>
        </div>
    </section>

    <footer class="section-p1">

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