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
        ?>
    </div>

    <section id="page-header" class="about-header">
      <h2>#About_Us</h2>
      <p>LEARN MORE About Us</p>
    </section>

    <section id="about-head" class="section-p1">
      <img src="Images/Banner 2.jpeg" alt="" />
      <div>
        <h2>Who Are We?</h2>
        <p>
          Welcome to our baby shop! We are passionate about providing
          high-quality, safe, and adorable products for your little ones. Our
          mission is to make parenting easier and more enjoyable by offering a
          wide range of carefully curated items, from clothing and toys to
          nursery essentials. We prioritize safety, comfort, and style, ensuring
          that every product meets the highest standards. Trust us to be your
          partner in this beautiful journey of parenthood, supporting you every
          step of the way.
        </p>
        <br />
        <br />
        <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="" 100%
          >"Discover the cutest and safest baby products at our shop – where
          every item is chosen with love and care!"</marquee
        >
      </div>
    </section>

    <section id="about-app" class="section-p1">
        <h1>Download Our <a href="#">App</a></h1>
        <div class="video">
            <video autoplay muted loop src="Images/App Video.mp4"></video>
        </div>
    </section>

     <section id="feature" class="section-p1">
      <div class="fe-box">
        <img src="Images/Features/F7.jpeg" alt="" />
        <h6>Free Shipping</h6>
      </div>

      <div class="fe-box">
        <img src="Images/Features/F6.jpeg" alt="" />
        <h6>Online Order</h6>
      </div>

      <div class="fe-box">
        <img src="Images/Features/F2.jpeg" alt="" />
        <h6>Save Money</h6>
      </div>

      <div class="fe-box">
        <img src="Images/Features/F4.jpeg" alt="" />
        <h6>Promotions</h6>
      </div>

      <div class="fe-box">
        <img src="Images/Features/F5.jpeg" alt="" />
        <h6>Happy Sell</h6>
      </div>

      <div class="fe-box">
        <img src="Images/Features/F8.jpeg" alt="" />
        <h6>Support</h6>
      </div>
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

            header("Location: about.php");
        }
        else{
            $SESSION['signup'] = "<div class='error'>❌Failed to Sign Up for Newsletters. Try Again Later!!</div>";

            header("Location: about.php");
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