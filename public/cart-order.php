    <?php 
        include('config/constants.php');
        include('Partials-Front/menu.php');

        include('login-check.php');

        $sql2 = "SELECT * FROM cart_tbl WHERE user_id = '$user_id'";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 && mysqli_num_rows($res2) > 0) 
        {
            $row = mysqli_fetch_assoc($res2);
            $title = $row['title'];
            $price = $row['price'];
            $qty = $row['qty'];
            $image_name = $row['image_name'];
            $total = $price * $qty;
        } 
        else 
        {
            // Redirect if product not found
            header("Location: USER/index.php");
            exit;
        }
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
    <!-- Order Form -->
    <div class="order-container">

            <form action="#" method="POST" class="form-order">
                <fieldset>
                    <legend>Customer Details</legend>
                    <div class="customer-details">
                        <div class="top-col">
                            <label for="full-name">Full Name:</label>    
                            <input type="text" name="full-name" placeholder="E.g. Abigail Nguli"required>             
                        </div>
                        <div class="bottom-col">
                            <div class="left-col">
                                <label for="contact">Phone Number:</label>
                                <input type="tel" name="contact" placeholder="E.g. +254 7xxxxxx"required>

                                <label for="email">Email Address:</label>
                                <input type="email" name="email" placeholder="E.g. nguli@gmail.com" required>
                            </div>
                            <div class="right-col">
                                <label for="address">Address:</label>
                                <textarea name="address" rows="6" placeholder="E.g. Town, County" required></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Order Details</legend>
                    <?php
                        $sql = "SELECT * FROM cart_tbl WHERE user_id = '$user_id'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if($count>0)
                            {
                            //Data is Available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $title = $row['title'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $image_name = $row['image_name'];
                                $total = $price * $qty;

                    ?>

                    <div class="order-details">
                        <div class="order-img">
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
                        </div>
                        <div class="product-details">
                            <h4 class="item-order"><?php echo $title; ?></h4>
                            <input type="hidden" name="product" value="<?php echo $title; ?>">
                            <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                            <p class="item-order">KES <?php echo $price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">

                            <p class="item-order">Quantity: <?php echo $qty; ?></p>
                            <input type="hidden" name="qty" value="<?php echo $qty; ?>">

                            <p class="item-order">Total: KES <?php echo $total; ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            else
                {
                  //Data is Not Available 
                  echo "<div class='error'>Products Not Available</div>";
                }
            ?>
                    <div class="thank-you">
                            <div class="left-col">
                                <p class="note">Thank You for Shopping With Us😊</p>
                                <p class="note">Karibu Tena!!</p>
                            </div>
                            <div class="right-col">
                                 <?php 
                                    $sql3 = "SELECT SUM(total) AS Total FROM cart_tbl WHERE user_id = '$user_id'";

                                    $res3 = mysqli_query($conn, $sql3);

                                    $row3 = mysqli_fetch_assoc($res3);

                                    $cart_total = $row3['Total'];
                                    $tax = 0.16 * $cart_total; 
                                    $sum_total = $cart_total + $tax;
                                ?>
                                <p class="total"><strong>Subtotal:</strong>  <?php echo $cart_total; ?></p>
                                <input type="hidden" name="sub_total" value="<?php echo $cart_total; ?>">
                                <p class="total"><strong>Value Added Tax: </strong>  <?php echo $tax; ?></p>
                                <p class="total"><strong>Shipping Fee:</strong>  Free </p>
                                <input type="hidden" name="tax" value="<?php echo $tax; ?>">
                                <p class="total"><strong>Grand Total: </strong>  <?php echo $sum_total; ?></p>
                                <input type="hidden" name="total" value="<?php echo $sum_total; ?>">
                                <input type="submit" name="submit" value="Confirm Order" class="confirm-order">
                            </div>
                        </div>
                </fieldset>
            </form>

            <?php 
                //Check whether submit button is clicked
                if(isset($_POST['submit']))
                {
                    //Get all the customer details from form
                    $order_date = date("Y-m-d h:i:sa");//Order Date $ Time

                    $status = "Ordered"; //Ordered, On delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //  $product = $_POST['product'];
                    // $user_id = $user_id;
                    // $image_name = $_POST['image_name'];
                    // $price = $_POST['price'];
                    // $qty = $_POST['qty'];
                    // $sub_total = $_POST['sub_total'];
                    // $tax = $_POST['tax'];
                    // $total = $_POST['total'];
                    $sql_cart = "SELECT * FROM cart_tbl WHERE user_id = '$user_id'";
                    $res_cart = mysqli_query($conn, $sql_cart);

                    if ($res_cart && mysqli_num_rows($res_cart) > 0) {
                        while ($row = mysqli_fetch_assoc($res_cart)) {
                            $product = $row['title'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $image_name = $row['image_name'];
                            $sub_total = $price * $qty;
                            $tax = $sub_total * 0.16; // Example: 16% tax
                            $total = $sub_total + $tax;


                            //Save Order to Database
                            $sql2 = "INSERT INTO tbl_order (product, user_id, image_name, price, qty, tax, sub_total, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_prepare($conn, $sql2);
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "sisiiiiissssss", $product, $user_id, $image_name, $price, $qty, $tax, $sub_total, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);
                                if (mysqli_stmt_execute($stmt)) {
                                    $order_id = mysqli_insert_id($conn);
                                    $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully</div>";
                                    $_SESSION['order_qty'] = $qty;
                                    $_SESSION['order_size'] = $size;
                                    header("location: receipt.php?order_id=" . $order_id);
                                } else {
                                    error_log("Database error: " . mysqli_error($conn));
                                    $_SESSION['order'] = "<div class='error text-center'>Placing Order Failed</div>";
                                    header("location: cart-order.php");
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                error_log("Prepared statement error: " . mysqli_error($conn));
                                $_SESSION['order'] = "<div class='error text-center'>Placing Order Failed. Prepared statement error.</div>";
                                header("location: cart-order.php");
                            }
                        }
                    }
                }
            ?>

    </div>

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