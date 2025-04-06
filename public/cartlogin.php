<?php
    include('config/constants.php');

    if (isset($_POST['submit'])) {
        $username = $_POST["username"];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM login_tbl WHERE username = '$username' AND password = '$password'";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_array($res);
        $user_type = $row['user_type'];

        if($user_type === "USER")
        {
            // User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;

            if (isset($_GET['redirect_product_id'])) 
            {
                $_SESSION['redirect_product_id'] = $_GET['redirect_product_id'];
                $productId = $_SESSION['redirect_product_id'];
                unset($_SESSION['redirect_product_id']); // Remove the product ID from the session

                // Redirect to product_addToCart.php with the stored product ID
                header("Location: Feat_addToCart.php?product_id=" . urlencode($productId));
                exit();

            } 
            elseif (isset($_GET['redirect_Nproduct_id'])) 
            {
                $_SESSION['redirect_Nproduct_id'] = $_GET['redirect_Nproduct_id'];
                $NproductId = $_SESSION['redirect_Nproduct_id'];
                unset($_SESSION['redirect_Nproduct_id']); // Remove the product ID from the session

                // Redirect to NA_addToCart.php with the stored product ID
                header("Location: NA_addToCart.php?Nproduct_id=" . urlencode($NproductId));
                exit();
            } 
        }

        //ENSURE ADMIN HAWEZI ORDER KITU NA RESTRICT SESSION MESSAGE INADISPLAY(ADMIN PERMISSION RESTRICTED)

        elseif($user_type === "ADMIN")
        {
            $_SESSION['restrict'] = "<div class='error'>ADMIN PERMISSION RESTRICTION! Admin Restricted from placing order!</div>";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['login'] = "<div class='error'>Invalid Login Credentials</div>";
            header("Location: cartlogin.php");
        }
    }

    if (isset($_POST['remember'])) {
        setcookie("login_user", $username, time() + (10 * 365 * 24 * 60 * 60));
    } else {
        setcookie("login_user", "", time() - 3600);
    }
?>

<html>
<head>
    <title>Login Form - Toto Baby Shop</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a29196e54d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login-container">
        <form action="#" class="login-form" method="POST">
            <h1 class="login-title">Login</h1>
            <div id="message">
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if (isset($_SESSION['register'])) {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
                ?>
            </div>
            <div class="input-box">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="remember-forgot-box">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember">
                    Remember me
                </label>
                <a href="#">Forgot Password?</a>
            </div>
            <input type="submit" name="submit" value="Login" class="login-btn">
            <p class="register">
                Don't have an account?
                <a href="register.php">Register</a>
            </p>
        </form>
    </div>
    <script>
        setTimeout(function() {
            var message = document.getElementById('message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>