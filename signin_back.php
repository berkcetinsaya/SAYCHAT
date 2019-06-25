<?php
  session_start();
  include('db_conn.php');
  $error=0;
  if (isset($_POST['signinButton'])) {
    $captcha = $_POST['g-recaptcha-response'];
    if (empty($_POST['inputUsername']) || empty($_POST['inputPassword'])) {
      $error = 3;
    }  
    else if (!$captcha) {
      $error = 2;
    }
    else{
      $username=$_POST['inputUsername'];
      $password=md5($_POST['inputPassword']);
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = $mysqli->real_escape_string($username);
      $password = $mysqli->real_escape_string($password);
      $query = $mysqli->query("select * from user where password='$password' AND username='$username'");
      $rows = mysqli_num_rows($query);
      while($row = $query->fetch_assoc()){
        $first_name     = $row['fname'];
        $last_name      = $row['lname'];
      }
      if ($rows == 1) {
        $_SESSION['login_user']=$username;
        header("location: profile.php");
      }
      else {
        $error = 1;
      }      
        mysqli_free_result($query);
        $mysqli->close();
    }
  }
?>