<?php
$page_title = "Sign In";
include('signin_back.php');
if (isset($_SESSION['login_user'])) {
    header("location: profile.php");
}

include_once "header.php";
?>
<div class="container">
    <div class="row">
        <div class="bs-example">
            <form class="form-horizontal" action="" method="post">
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
                    <div class="col-xs-offset-3 col-xs-3">
                        <div class="g-recaptcha" data-sitekey="6LcayRQTAAAAAMQkKbwFBKyYBp755sMyXSfuI9_l"></div><br />
                    </div>
                </div>
                <?php if ($error == 1) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Please check username or password!
                            </div>                        
                        </div >
                    </div>';
                } else if ($error == 2) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Please check captcha.
                            </div>                        
                        </div >
                    </div>';
                }else if ($error == 3) {
                    echo '<div class="form-group">
                        <label class="control-label col-xs-3"></label>
                        <div class="col-xs-9">
                            <div class="alert alert-danger alert-dismissable">
                                Fields can not be empty! 
                            </div>                        
                        </div >
                    </div>';
                }
                ?>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" name="signinButton" class="btn btn-primary" value="Sign In">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include_once "footer.php"; ?>