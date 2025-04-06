<?php 
// Include your database connection file
include('config/constants.php');

// Retrieve the username from the session
  if(!isset($_SESSION["user"]))
  {
    header("location: cartlogin.php");
  }
  else
  {
    $username = $_SESSION['user'];
    $sql2 = "SELECT * FROM login_tbl WHERE username = '$username'";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 && mysqli_num_rows($res2) > 0) {
        $row = mysqli_fetch_assoc($res2);
        $user_id = $row['id'];
    }
  }

// Check whether product id is set
if(isset($_GET['Nproduct_id']))
{
    // Get food id and details of selected product
    $Nproduct_id = $_GET['Nproduct_id'];

    $sql2 = "SELECT * FROM new_arrivals WHERE id = '$Nproduct_id'";
    
    $res2 = mysqli_query($conn, $sql2);

    if($res2) {
              while($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $product_title = $row['title'];
                    $product_price = $row['price'];
                    $image_name1 = $row['image_name'];
                    $product_description = $row['description'];
                  }
            }
            else
            {
                //redirect
                header("location: index.php");
            }
      }

      include('Partials-Front/menu.php');
  ?>

    <div id="message">
        <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Display Session Message
                unset($_SESSION['add']);//Remove Session Message
            }
        ?>
    </div>

    <section id="prodetails" class="section-p1">
      <form method="POST" action="">
      <?php 
          $sql = "SELECT * FROM sm_new_arrivals WHERE title = '$Nproduct_id'";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $color1=$rows['color1'];
                        $color2=$rows['color2'];
                        $color3=$rows['color3'];
                        $color4=$rows['color4'];
                        $color5=$rows['color5'];
                        $price=$rows['price'];
                        $description=$rows['description'];
                        $product_details=$rows['product_details'];
                        $colors=$rows['colors'];
                        $material=$rows['material'];
                        $gender=$rows['gender'];
          ?>
      <div class="single-pro-image">
        <?php 
              //Is image available?
              if($image_name1=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/New Arrivals/<?php echo $image_name1; ?>" id="MainImg" width="100%">

            <?php
          }
        ?>
        
      <div class="small-img-group">
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color2=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/New Arrivals/Small Products/<?php echo $color2; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color3=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/New Arrivals/Small Products/<?php echo $color3; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color4=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/New Arrivals/Small Products/<?php echo $color4; ?>" class="small-img" width="100%">
            <?php
          }
        ?>
          </div>
          <div class="small-img-col">
            <?php 
              //Is image available?
              if($color5=="")
              {
                //Image not available
                echo "<div class='error'>Image Not Available</div>";
              }
                else
                  {
                    //Image available
            ?>
                                    
            <img src="Images/New Arrivals/Small Products/<?php echo $color5; ?>" class="small-img" width="100%">

            <?php
          }
        ?>
          </div>
        </div>
      </div>

        <div class="single-pro-details">
          <h6>Home / <?php echo $product_title; ?></h6>
          <h4><?php echo $product_description; ?></h4>
          <h2><?php echo $product_price; ?></h2>
          <select name="size">
            <option>XL</option>
            <option>XXL</option>
            <option>Small</option>
            <option>Large</option>
          </select>
                <input type="hidden" name="title" value="<?php echo $product_title; ?>">
                <input type="hidden" name="image_name" value="<?php echo $image_name1; ?>">
                <input type="hidden" name="price" value="<?php echo $product_price; ?>">
          <input type="number" class="num" name="qty" value="1" required/>
          <input type="submit" name="submit" value="Add To Cart" class="buy"/>
          <a href="na_order.php?na_order_id=<?php echo $id; ?>" class="buy">Buy Now</a>
          <h4>Product Details</h4>
          <span>
            <?php echo $product_details; ?>
            <br><br> <strong>Colors:</strong> <?php echo $colors; ?> <br> <strong>Material:</strong> <?php echo $material; ?> <br> <strong>Gender:</strong> <?php echo $gender; ?>
          </span>
        </div>
        <?php
        }
      }
    }
    ?>
    </form>
    </section>
    <footer class="section-p1">
      <div class="copyright">
        <p>
          <i class="fa-regular fa-copyright"></i> 2024, Abigail Nguli - Online
          Baby Shop
        </p>
      </div>
    </footer>

    <script>
      var MainImg = document.getElementById("MainImg");
      var Smallimg = document.getElementsByClassName("small-img");

      Smallimg[0].onclick = function () {
        MainImg.src = Smallimg[0].src;
      };
      Smallimg[1].onclick = function () {
        MainImg.src = Smallimg[1].src;
      };
      Smallimg[2].onclick = function () {
        MainImg.src = Smallimg[2].src;
      };
      Smallimg[3].onclick = function () {
        MainImg.src = Smallimg[3].src;
      };
    </script>
    <script src="script.js"></script>
  
  </body>
</html>

<?php 
    
    if(isset($_POST['submit']))
    {
        //Get Updated Values
        $title = $_POST['title'];
        $user_id = $user_id;
        $image_name = $_POST['image_name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $qty = $_POST['qty'];
        $total = $price * $qty;

        //Update Cart
        $sql3 = "INSERT INTO cart_tbl SET
            title = '$title',
            image_name = '$image_name',
            price = '$price', 
            size = '$size',
            qty = '$qty', 
            total = '$total'";


        //Prepared statement to prevent SQL injection
          $sql = "INSERT INTO cart_tbl SET title = ?, user_id = ?, image_name = ?, price = ?, size = ?, qty = ?, total = ?";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, "sssissi", $title, $user_id, $image_name, $price, $size, $qty, $total);
          $res = mysqli_stmt_execute($stmt);


          if ($res) {
              $_SESSION["add"] = "<div class='success'>Item successfully added to your cart!</div>";
              header("Location: cart.php");
              exit;
          } else {
              $_SESSION["add"] = "<div class='error'>Failed to add item to the cart. Please try again! Error: " . mysqli_error($conn) . "</div>";
          }
    }
    ob_end_flush();

    ?>

<script>
    setTimeout(function() {
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000);
</script>