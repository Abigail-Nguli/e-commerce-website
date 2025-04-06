 <?php 
    include('../config/constants.php');
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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css" />
    <script
      src="https://kit.fontawesome.com/a29196e54d.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <section id="header">
      <a href="#"
        ><img src="Images/Logo.jpeg" class="logo" alt="" width="10%"
      /></a>

      <div class="">
        <?php
          $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename
        ?>

        <ul id="navbar">
            <li><a class="<?php if ($currentPage == 'admin.php') echo 'active'; ?>" href="admin.php">Dashboard</a></li>
            <li><a class="<?php if ($currentPage == 'new-arrival.php') echo 'active'; ?>" href="new-arrival.php">New Arrivals</a></li>
            <li><a class="<?php if ($currentPage == 'featured-products.php') echo 'active'; ?>" href="featured-products.php">Featured Products</a></li>
            <li><a class="<?php if ($currentPage == 'sm-featured-products.php') echo 'active'; ?>" href="sm-featured-products.php">Small Featured Products</a></li>
            <li><a class="<?php if ($currentPage == 'sm-new-arrivals.php') echo 'active'; ?>" href="sm-new-arrivals.php">Small New Arrivals</a></li>
            <li><a class="<?php if ($currentPage == 'orders.php') echo 'active'; ?>" href="orders.php">Orders</a></li>
            <li><a class="<?php if ($currentPage == 'users.php') echo 'active'; ?>" href="users.php">Users</a></li>
            <li><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            <a href="#" id="close"><i class="fa-solid fa-indent"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a href="login.php"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-outdent"></i>
      </div>
    </section>