<?php
include('config/constants.php');

// Start the session (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('Partials-Front/menu.php');

 include('login-check.php');
?>

    <div id="message">
        <?php
        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
    </div>
    <div class="order-container">
        <form action="#" method="POST" class="form-order" enctype="multipart/form-data">
            <fieldset>
                <legend>Customer Details</legend>
                <div class="customer-details">
                    <div class="top-col">
                        <label for="full-name">Full Name:</label>
                        <input type="text" name="full-name" placeholder="E.g. Abigail Nguli" required>
                    </div>
                    <div class="bottom-col">
                        <div class="left-col">
                            <label for="contact">Phone Number:</label>
                            <input type="tel" name="contact" placeholder="E.g. +254 7xxxxxx" required>
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" placeholder="E.g. nguli@gmail.com" required>
                        </div>
                        <div class="right-col">
                            <label for="address">Address:</label>
                            <textarea name="address" rows="8" placeholder="E.g. Town, County" required></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Order Details</legend>
                <?php
                if (isset($_GET['na_order_id'])) {
                    $na_order_id = $_GET['na_order_id'];
                    $sql = "SELECT * FROM new_arrivals WHERE id=$na_order_id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            ?>
                            <div class="order-details">
                                <div class="order-img">
                                    <?php
                                    if ($image_name == "") {
                                        echo "<div class='error'>Image Not Available</div>";
                                    } else {
                                        ?>
                                        <img src="Images/New Arrivals/<?php echo $image_name; ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="product-details">
                                    <h4 class="item-order"><?php echo $title; ?></h4>
                                    <input type="hidden" name="product" value="<?php echo $title; ?>">
                                    <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                                    <div class="size">
                                        <p class="item-order">KES <?php echo $price; ?></p>
                                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                                        <div>
                                            <p class="item-order">Size: </p>
                                            <select name="size">
                                                <option>XL</option>
                                                <option>XXL</option>
                                                <option>Small</option>
                                                <option>Large</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p class="item-order">Quantity: </p>
                                    <input type="number" name="qty" value="1">
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<div class='error'>Products Not Available</div>";
                    }
                } else {
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
                        if (isset($_POST['submit']) && isset($_POST['price']) && isset($_POST['qty'])) {
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $sub_total = $price * $qty;
                            $tax = 0.16 * $sub_total;
                            $total = $tax + $sub_total;
                            echo '<p class="total"><strong>Subtotal:</strong> ' . $sub_total . '</p>';
                            echo '<p class="total"><strong>Value Added Tax: </strong> ' . $tax . '</p>';
                            echo '<p class="total"><strong>Grand Total: </strong> ' . $total . '</p>';
                        }
                        ?>
                        <p class="total"><strong>Shipping Fee:</strong> Free </p>
                        <input type="submit" name="submit" value="Confirm Order" class="confirm-order">
                    </div>
                </div>
            </fieldset>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $product = $_POST['product'];
            $user_id = $user_id;
            $image_name = $_POST['image_name'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $sub_total = $price * $qty;
            $tax = 0.16 * $sub_total;
            $total = $tax + $sub_total;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order (product, user_id, image_name, price, qty, tax, sub_total, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql2);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sisiiiiissssss", $product, $user_id, $image_name, $price, $qty, $tax, $sub_total, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);
                if (mysqli_stmt_execute($stmt)) {
                    $order_id = mysqli_insert_id($conn);
                    $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully</div>";
                    $_SESSION['order_qty'] = $qty;
                    $_SESSION['order_size'] = $size;
                    header("location: na-pro-receipt.php?order_id=" . $order_id);
                } else {
                    error_log("Database error: " . mysqli_error($conn));
                    $_SESSION['order'] = "<div class='error text-center'>Placing Order Failed</div>";
                    header("location: na_order.php");
                }
                mysqli_stmt_close($stmt);
            } else {
                error_log("Prepared statement error: " . mysqli_error($conn));
                $_SESSION['order'] = "<div class='error text-center'>Placing Order Failed. Prepared statement error.</div>";
                header("location: na_order.php");
            }
        }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>

<script>
    setTimeout(function() {
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000);
</script>