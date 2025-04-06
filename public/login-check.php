<?php 
    if(!isset($_SESSION["user"]))
    {
        header("location: login.php");
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