<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Baby Shop</title>
    <link rel="stylesheet" href="./style.css" />
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

      <div class="nav">
        <?php
          $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename
        ?>
        <ul id="navbar">
          <li><a class="<?php if ($currentPage == 'index.php') echo 'active'; ?>" href="index.php">Home</a></li>
          <li><a class="<?php if ($currentPage == 'shop.php') echo 'active'; ?>" href="shop.php">Shop</a></li>
          <li><a class="<?php if ($currentPage == 'about.php') echo 'active'; ?>" href="about.php">About</a></li>
          <li><a class="<?php if ($currentPage == 'contact.php') echo 'active'; ?>" href="contact.php">Contact</a></li>

          <li id="lg-bag">
            <?php 
                if (isset($_SESSION['user_type'])) 
                {
                  $user_type = $_SESSION['user_type'];

                  if ($user_type === 'ADMIN') {
                      $link = 'ADMIN/admin.php';
                  } elseif ($user_type === 'USER') {
                      $link = 'USER/index.php';
                  } else {
                      unset($_SESSION['user']);
                      // Handle cases where usertype is not recognized (optional)
                      $link = 'login.php';
                  }
                } 
                else 
                {
                    // Handle cases where usertype is not set (user not logged in, optional)
                    $link = 'login.php'; 
                }
            ?>
            <a class="<?php if ($currentPage == basename($link)) echo 'active'; ?>" href="<?php echo $link; ?>"><i class="fa-solid fa-user-tie"></i></a>
          </li>
          <a href="#" id="close"><i class="fa-solid fa-indent"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a class="<?php if ($currentPage == basename($link)) echo 'active'; ?>" href="<?php echo $link; ?>"><i class="fa-solid fa-user-tie"></i></a>
        <i id="bar" class="fa-solid fa-outdent"></i>
      </div>
    </section>