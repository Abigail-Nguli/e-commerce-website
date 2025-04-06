<?php 
  include('../config/constants.php');  

    // Check if the user is logged in
    if(!isset($_SESSION["user"]))
    {
        header("location: ../login.php");
    }

     // Retrieve the username from the session
    if(isset($_SESSION["user"]))
    {
      $username = $_SESSION['user'];
      $sql2 = "SELECT * FROM login_tbl WHERE username = '$username'";
      $res2 = mysqli_query($conn, $sql2);

      if ($res2 && mysqli_num_rows($res2) > 0) {
          $row = mysqli_fetch_assoc($res2);
          $user_id = $row['id'];
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
    <script
      src="https://kit.fontawesome.com/a29196e54d.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <?php 

      $sql6 = "SELECT * FROM cart_tbl WHERE user_id = '$user_id'";

      $res6 = mysqli_query($conn, $sql6);

      $count6 = mysqli_num_rows($res6);

      $sql7 = "SELECT * FROM tbl_order WHERE user_id = '$user_id'";

      $res7 = mysqli_query($conn, $sql7);

      $count7 = mysqli_num_rows($res7);
    ?>

      <div class="sidebar">
        <ul id="navbar">
          <?php
            $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename
          ?>
          <li>
            <a href="#home" class="<?php if ($currentPage == '#home') echo 'active'; ?>"
              ><i class="fa-solid fa-house"></i><span>Home</span></a
            >
          </li>
          <li>
            <a class="<?php if ($currentPage == '#details') echo 'active'; ?>" href="#details"
              ><i class="fa-solid fa-user-tie"></i><span>My Details</span></a
            >
          </li>
          <li>
            <a href="#cart-details" class="<?php if ($currentPage == '#cart-details') echo 'active'; ?>"
              ><i class="fa-solid fa-cart-shopping"><div class="count"><?php echo $count6 ?></div></i><span>Cart</span></a
            >
          </li>
          <li>
            <a href="#orders" class="<?php if ($currentPage == '#orders') echo 'active'; ?>"
              ><i class="fa-solid fa-bag-shopping"><div class="all_orders"><?php echo $count7 ?></div></i><span>My Orders</span></a
            >
          </li>
          <li>
            <a href="#form-details" class="<?php if ($currentPage == '#form-details') echo 'active'; ?>"
              ><i class="fa-solid fa-phone-volume"></i
              ><span>Contact Us</span></a
            >
          </li>
          <li>
            <a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
          </li>
        </ul>
      </div>

      <section id="nav">
        <img src="../Images/Logo.jpeg" width="45px">
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