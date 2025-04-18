<?php 
  include('Partials-Front/menu.php');
?>

    <section id="page-header" class="about-header">
      <h2>#let's_talk</h2>
      <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="contactdetails" class="section-p1">
      <div class="details">
        <span>GET IN TOUCH</span>
        <h2>Visit our shop location or contact us today</h2>
        <h3>Head Office</h3>
        <div class="">
          <li>
            <i class="fa-solid fa-map-pin"></i>
            <p>234 Kenyatta Avenue, Nairobi</p>
          </li>
          <li>
            <i class="fa-solid fa-envelope"></i>
            <p>babyshop@gmail.com</p>
          </li>
          <li>
            <i class="fa-solid fa-phone-volume"></i>
            <p>+254 712 345 678/ +254 119 876 543</p>
          </li>
          <li>
            <i class="fa-solid fa-clock"></i>
            <p>10:00 - 18:00, Mon - Sat</p>
          </li>
        </div>
      </div>
      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8122913524567!2d36.814362074790665!3d-1.286694498701073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10c55202d22b%3A0x9476f14fd49cde4d!2sKenyatta%20Ave%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1728136090145!5m2!1sen!2ske"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </section>

    <section id="form-details">
        <form name="submit-to-google-sheet">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" name="Name" placeholder="Your Name" required />
              <input
                type="email"
                name="Email"
                placeholder="Your Email"
                required
              />
            <!--
              <input type="text" name="Subject" placeholder="Subject">
            -->
            <textarea name="Message" cols="30" rows="10" placeholder="Your Message"></textarea>
            <span id="msg"></span>
            <button type="submit" class="normal">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="Images/Profile.jpeg" alt="" width="80px" height="80px">
                <p><span>Abigail Nguli</span> Marketing Director <br> Phone: +254 712 345 678 <br>Email: abigail@gmail.com</p>
            </div>
            <div>
                <img src="Images/Profile.jpeg" alt="" width="80px" height="80px">
                <p><span>Travis Wanyoike</span> Social Media Manager <br> Phone: +254 756 890 234 <br>Email: travis@gmail.com</p>
            </div>
            <div>
                <img src="Images/Profile.jpeg" alt="" width="80px" height="80px">
                <p><span>Jasmine Muthoni</span> Accountant <br> Phone: +254 709 889 563 <br>Email: jasmine@gmail.com</p>
            </div>
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
      <div class="form">
        <input type="text" name="" id="" placeholder="Your Email Address" />
        <button class="normal">Sign Up</button>
      </div>
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
    <script>
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
