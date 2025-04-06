 <?php 
    include('config/constants.php');


    if(isset($_POST['remember']))
    {
        setcookie("login_user", $username, time() + (10 * 365 * 24 * 60 * 60));
        setcookie("login_pass", $password, time() + (10 * 365 * 24 * 60 * 60));
    }
    else{
        setcookie("login_user", "", time() - 3600);
        setcookie("login_pass", "", time() - 3600);
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
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }

                        if(isset($_SESSION['register']))
                        {
                            echo $_SESSION['register'];
                            unset($_SESSION['register']);
                        }

                         if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];//Display Session Message
                            unset($_SESSION['update']);
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

            <?php
                if (isset($_POST['submit'])) 
                {
                    $username = $_POST["username"];
                    $password = md5($_POST['password']);

                    $sql = "SELECT * FROM login_tbl WHERE username = '$username' AND password = '$password'";

                    $res = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_array($res);

                    if($row["user_type"] == "USER")
                    {
                        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                        $_SESSION['user_type'] = $row['user_type']; 
                        $_SESSION['user'] = $username;
                        header("location: USER/index.php");
                    }
                    elseif($row["user_type"] == "ADMIN")
                    {
                        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                        $_SESSION['user_type'] = $row['user_type']; 
                        $_SESSION['user'] = $username;
                        header("location: ADMIN/admin.php");
                    }
                    else
                    {
                        $_SESSION['login'] = "<div class='error'>Invalid Login Credentials</div>";
                        header("Location: login.php");
                    }
                }
            ?>

        </div>
    </body>
</html>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; 
        } 
    }, 5000); 
     // 5000 milliseconds = 5 seconds
</script>
