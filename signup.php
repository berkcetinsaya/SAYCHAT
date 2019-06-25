<?php
include('db_conn.php');
$page_title = "Sign Up";
include('signup_back.php');
error_reporting(0);

if (isset($_SESSION['login_user'])) {
    header("location: profile.php");
}
error_reporting(0);
include_once "header.php";
?>
<div class="container">
    <div class="row">
        <h3 class="page-header"> Sign Up</h3>
        <div class="bs-example">
            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-xs-3" for="inputUsername">Username:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3" for="inputPassword">Password:</label>
                    <div class="col-xs-9">
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3" for="inputEmail">Email:</label>
                    <div class="col-xs-9">
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3" for="firstName">First Name:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3" for="lastName">Last Name:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Date of Birth:</label>
                    <div class="col-xs-3">
                        <select class="form-control" name="Month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                if ($i == date("m"))
                                    echo "<option selected>$i</option>";
                                else
                                    echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <select class="form-control" name="Date">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                if ($i == date("d"))
                                    echo "<option selected>$i</option>";
                                else
                                    echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <select class="form-control" name="Year">
                            <?php

                            for ($i = date("Y"); $i >= 1900; $i--) {
                                if ($i == date("Y"))
                                    echo "<option selected>$i</option>";
                                else
                                    echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3" for="inputImage">Image:</label>
                    <div class="col-xs-9">
                        <input type="file" class="form-control" name="inputImage" id="inputImage">
                        <p>Max: 2MB</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-3">
                        <div class="g-recaptcha" data-sitekey="YOURKEY"></div>
                    </div>
                </div>
                <?php if ($error == 1) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Please check captcha.
                            </div>                        
                        </div >
                    </div>';
                } else if ($exists == 1) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Fields can not be empty! 
                            </div>                        
                        </div >
                    </div>';
                } else if ($exists == 3) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Username already exists! 
                            </div>                        
                        </div >
                    </div>';
                } else if ($exists == 4) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Email is invalid! 
                            </div>                        
                        </div >
                    </div>';
                } else if ($exists == 5) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Email already exists! 
                            </div>                        
                        </div >
                    </div>';
                } else if ($exists == 6) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Please select an image max 2MB! 
                            </div>                        
                        </div >
                    </div>';
                }
                ?>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" name="signupButton" class="btn btn-primary" value="Sign Up">
                        <input style="background-color:brown;" type="reset" class="btn btn-primary" value="Reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include_once "footer.php"; ?>