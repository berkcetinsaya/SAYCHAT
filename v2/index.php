<?php
$page_title = "SayChat";
include('signin_back.php');
error_reporting(0);
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno > 0) {
  die('Unable to connect to database [' . $db->connect_error . ']');
}
$result = $db->query("select * from user where username='$_SESSION[login_user]'");
while ($row = $result->fetch_assoc()) {
  $username       = $row['username'];
  $email          = $row['email'];
  $first_name     = $row['fname'];
  $last_name      = $row['lname'];
  $date_of_birth  = $row['date_of_birth'];
  $type           = $row['type'];
  $picture        = $row['picture'];
}

$result->free();
if (isset($_SESSION['login_user'])) {
  header("location: profile.php");
}

include_once "header.php";
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header text-center">SayChat</h3>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div id="head" class="panel-heading">
          <h4><i class="fa fa-fw fa-arrow-circle-o-right"></i>Sign In</h4>
        </div>
        <div class="panel-body">
          <p>If you have already an account, please click below.</p>
          <a href="signin.php" class="btn btn-primary btn-block">Sign In</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div id="head" class="panel-heading">
          <h4><i class="fa fa-fw fa-compass"></i>Contact</h4>
        </div>
        <div class="panel-body">
          <p>If you want to contact us, please click below.</p>
          <a href="contact.php" class="btn btn-primary btn-block">Contact</a>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-offset-4 col-md-4">
      <a class="btn btn-lg btn-primary btn-block" href="signup.php">Sign Up</a>
    </div>
  </div>
  <?php include_once "footer.php"; ?>