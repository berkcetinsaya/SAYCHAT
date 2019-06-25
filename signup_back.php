<?php
include('db_conn.php');
error_reporting(0);
$error = 0;
if (isset($_POST['signupButton'])) {
    $captcha = $_POST['g-recaptcha-response'];
    if (!$captcha) {
        $error = 1;
    } else {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $username   = $_POST['inputUsername'];
        $email      = $_POST['inputEmail'];
        $password   = md5($_POST['inputPassword']);
        $first_name = $_POST['firstName'];
        $last_name  = $_POST['lastName'];
        $date       = $_POST['Year'] . "-" . $_POST['Month'] . "-" . $_POST['Date'];
        $image      = $_POST['image'];
        $exists     = 0;
        $error      = '';
        $username = stripslashes($username);
        $password = stripslashes($password);
        $first_name = stripslashes( $first_name);
        $last_name = stripslashes( $last_name);
        $email = stripslashes( $email);
        $email = $db->real_escape_string( $email);
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        $first_name = $db->real_escape_string( $first_name);
        $last_name = $db->real_escape_string( $last_name);
        $image = base64_encode(file_get_contents(addslashes($_FILES[ 'inputImage']['tmp_name'])));
        $fields = array('inputUsername', 'inputEmail', 'firstName', 'lastName');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $exists = 4;
        }
        foreach ($fields as $fieldname) { //Loop trough each field
            if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
                $exists = 1;
            }
        }
        $result = $db->query("SELECT username from user WHERE username = '{$username}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 3;
        $result = $db->query("SELECT email from user WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 5;
        if(!getimagesize($_FILES[ 'inputImage']['tmp_name'])){
            $exists = 6;
        }
        if($exists == 0) {
            $sql = "INSERT  INTO `user` (`id`, `username`, `email`, `password`, `fname`, `lname`, `date_of_birth`, `picture`, `type`) 
                            VALUES (NULL, '{$username}', '{$email}', '{$password}', '{$first_name}', '{$last_name}', '{$date}','{$image}' , 2)";
            if ($db->query($sql)) {
                header("location: signin.php");
            } else {
                echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
                exit();
            }
        }
        
        $db->close();
    }
}
?>